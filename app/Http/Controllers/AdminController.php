<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->orderBy($sort, $order)
          ->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    public function updateStatus(Request $request, User $user)
{
    $request->validate([
        'status' => 'required|in:active,inactive',
    ]);

    $user->update(['status' => $request->status]);

    return redirect()->route('admin.users.index')->with('success', 'User status updated successfully.');
}
public function destroyBulk(Request $request)
{
    $userIds = $request->input('user_ids', []);

    User::whereIn('id', $userIds)->delete();

    return redirect()->route('admin.users.index')->with('success', 'Selected users deleted successfully.');
}

public function updateBulkStatus(Request $request)
{
    $request->validate([
        'status' => 'required|in:active,inactive',
        'user_ids' => 'required|array',
    ]);

    $status = $request->status;
    $userIds = $request->user_ids;

    User::whereIn('id', $userIds)->update(['status' => $status]);

    return redirect()->route('admin.users.index')->with('success', 'Selected users updated successfully.');
}

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

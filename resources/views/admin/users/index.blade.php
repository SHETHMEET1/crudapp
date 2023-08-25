@extends('layouts.admin')

@section('content')
    <h2>Users List</h2>

    <form method="POST" action="{{ route('admin.users.bulkStatusUpdate') }}">
        @csrf

        <div class="form-group">
            <label for="bulkStatus">Bulk Status Update:</label>
            <select name="status" id="bulkStatus" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update Selected</button>
    </form>
    @foreach ($users as $user)
    <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}">
        @csrf
        @method('PUT')

        <select name="status" onchange="this.form.submit()">
            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </form>
@endforeach

    {{ $users->links() }}
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Mail\VerificationEmail;


    
class CustomAuthController extends Controller
{
    public function registration()
    {
        return view('registration');
    }
       
 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Create and save the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'verification_token' => sha1($request->input('email')),
            'verification_expires_at' => Carbon::now()->addMinutes(5),
        ]);
    
        // Send verification email
        Mail::to($user->email)->send(new VerificationEmail($user));
    
        return redirect()->route('home')->with('success', 'Registration successful. Please check your email for verification.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    //
    public function resend(Request $request)
{
    $user = User::where('email', $request->email)->whereNull('verified')->first();

    if ($user) {
        // Update the verification token and expiry
        $user->update([
            'verification_token' => sha1($user->email),
            'verification_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Resend verification email
        Mail::to($user->email)->send(new VerificationEmail($user));

        return redirect()->back()->with('success', 'Verification link sent again. Please check your email.');
    }

    return redirect()->back()->with('error', 'No pending verification found for this email.');
}
}

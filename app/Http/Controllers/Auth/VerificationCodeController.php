<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Support\Str;

class VerificationCodeController extends Controller
{
    /**
     * Send the verification code via email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendVerificationCode(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Generate a verification code
        $verificationCode = Str::random(6);

        // Update the user's verification code
        $user->verification_code = $verificationCode;
        $user->save();

        // Send the verification code via email
        Mail::to($user->email)->send(new EmailVerification($verificationCode));

        return redirect()->back()->with('success', 'Verification code sent successfully. Check your email.');
    }

    /**
     * Handle verification code submission and validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleVerification(Request $request)
    {
        // Validate the request data
        $request->validate([
            'verification_code' => 'required|string|size:6', // Adjust size according to your verification code length
        ]);

        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the provided verification code matches the one stored in the user's record
        if ($user && $user->verification_code === $request->verification_code) {
            // Mark the email as verified (optional)
            $user->email_verified_at = now();
            $user->save();

            // Redirect to the dashboard or any desired destination upon successful verification
            return redirect()->route('dashboard')->with('success', 'Email verified successfully.');
        }

        // If verification fails, redirect back with an error message
        return redirect()->back()->withErrors(['verification_code' => 'Invalid verification code. Please try again.']);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Models\User;

class VerificationCodeController extends Controller
{
    /**
     * Show the verification code entry form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showVerificationForm()
    {
        return view('auth.verify_code');
    }

    /**
     * Handle verification code submission and validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleVerification(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6', // Adjust size according to your verification code length
        ]);

        $user = Auth::user();

        if ($user->verification_code === $request->verification_code) {
            // Verification successful, update the user's email_verified_at column
            $user->email_verified_at = now();
            $user->save();

            // Redirect to the dashboard or any other desired destination
            return redirect()->route('dashboard')->with('success', 'Email verified successfully.');
        }

        // If verification fails, redirect back with an error message
        return redirect()->back()->withErrors(['verification_code' => 'Invalid verification code. Please try again.']);
    }
}

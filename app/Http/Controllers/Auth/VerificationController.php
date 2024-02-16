<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{


    public function verify(Request $request)
    {
        // Find the user by ID
        $user = User::find($request->route('id'));

        // Check if the user exists and if the provided hash matches
        if (!$user || !hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            // If verification fails, redirect with an error message
            return redirect('/sign-in')->withErrors(['verification_error' => 'Invalid verification link']);
        }

        // Check if the user's email is already verified
        if ($user->hasVerifiedEmail()) {
            // If already verified, redirect with a message
            return redirect('/sign-in')->with('message', 'Email already verified');
        }

        // Mark the user's email as verified
        $user->markEmailAsVerified();

        // Fire the event to log the verification
        event(new Verified($user));

        // Redirect to a success page or any desired location
        return redirect('/sign-in')->with('message', 'Email verified successfully');
    }

    public function show(Request $request)
    {
        return view('auth.verify-email');
    }
}

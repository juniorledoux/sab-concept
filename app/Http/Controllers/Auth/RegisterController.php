<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;



class RegisterController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send verification code email
        $verificationCode = Str::random(6);
        $user->verification_code = $verificationCode;
        $user->save();
        // Send the verification code via email
        // Assuming you have an EmailVerification Mailable class
        // You can adjust this according to your implementation
        Mail::to($user->email)->send(new EmailVerification($verificationCode));

        return redirect()->route('verification.form')->with('email', $user->email);
    }
}

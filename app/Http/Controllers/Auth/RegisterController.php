<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\VerifyEmailNotification;

use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric|digits:12||unique:users',
            'password' => 'required|min:7|max:255',
            'terms' => 'accepted',
            'societe' => 'required|max:255',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone number is required',
            'societe.required' => 'Entreprise is required',
            'password.required' => 'Password is required',
            'terms.accepted' => 'You must accept the terms and conditions'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'societe' => $request->societe,
        ]);


        Auth::login($user);


        // Send verification email
        $user->notify(new VerifyEmailNotification());

        // Redirect the user to the verification notice page
        return redirect()->route('verification-notice')->with('status', 'Please verify your email address by clicking the verification link sent to your email.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmailNotification;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where(['is_admin' => false])->get();
        return view('management.users-management', compact('users'));
    }

    public function add(Request $request)
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


        // Send verification email
        $user->notify(new VerifyEmailNotification());

        // Redirect the user to the verification notice page
        return redirect()->back()->with('status', 'Please verify your email address by clicking the verification link sent to your email.');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('management.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'societe' => 'required|max:255',
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'location' => 'max:255',
            'phone' => 'required|numeric|digits:12|unique:users,phone,'.$id,
            'about' => 'max:255',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone number is required',
            'societe.required' => 'Entreprise is required',
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
            'about' => $request->about,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('status', 'The user account of ' . $user->name . ' have been deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmailNotification;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = User::find(auth()->user()->id)->contacts()->paginate(10);
        // dd($contacts);
        return view('contacts.index', compact('contacts'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'phone' => 'required|numeric|digits:12||unique:contacts',

        ], [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone number is required',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id'=>auth()->user()->id,
        ]);


        // Redirect the user to the verification notice page
        return redirect()->back()->with('status', 'New contact added');
    }
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|min:3|max:255',
            'phone' => 'required|numeric|digits:12|unique:contacts,phone,' . $id,
        ], [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone number is required',
        ]);

        $contact = Contact::find($id);

        $contact->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Contact updated successfully.');
    }
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->back()->with('status', 'The contact of ' . $contact->name . ' have been deleted successfully!');
    }
}

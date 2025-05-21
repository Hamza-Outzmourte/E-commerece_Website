<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create([
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Votre message a été envoyé !');
    }
}

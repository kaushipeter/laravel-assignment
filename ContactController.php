<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        $name = auth()->check() ? auth()->user()->name : 'Guest';
        $userId = auth()->id();

        Message::create([
            'user_id' => $userId,
            'name' => $name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function myMessages()
    {
        $messages = Message::where('user_id', auth()->id())->latest('received_date')->get();
        return view('contact.my-messages', compact('messages'));
    }
}

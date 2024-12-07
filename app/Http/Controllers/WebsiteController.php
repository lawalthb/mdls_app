<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('pages.website.home');
    }

    public function about()
    {
        return view('pages.website.about');
    }

    public function contact()
    {
        return view('pages.website.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        // Add your email sending logic here

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}

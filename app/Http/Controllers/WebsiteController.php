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

    public function events()
    {
        $images = [
            'IMG-20241127-WA0031.jpg', 'IMG-20241127-WA0032.jpg', 'IMG-20241127-WA0033.jpg',
            'IMG-20241127-WA0034.jpg', 'IMG-20241127-WA0035.jpg', 'IMG-20241127-WA0036.jpg',
            'IMG-20241127-WA0037.jpg', 'IMG-20241127-WA0038.jpg', 'IMG-20241127-WA0039.jpg',
            'IMG-20241127-WA0041.jpg', 'IMG-20241127-WA0043.jpg', 'IMG-20241127-WA0044.jpg',
            'IMG-20241127-WA0045.jpg', 'IMG-20241127-WA0046.jpg', 'IMG-20241127-WA0047.jpg',
            'IMG-20241127-WA0048.jpg', 'IMG-20241127-WA0050.jpg', 'IMG-20241127-WA0051.jpg',
            'IMG-20241127-WA0053.jpg', 'IMG-20241127-WA0054.jpg', 'IMG-20241127-WA0055.jpg',
            'IMG-20241127-WA0056.jpg'
        ];
        return view('pages.website.events', compact('images'));
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

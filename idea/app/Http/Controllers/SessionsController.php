<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($attributes)) {
            return back()
                ->withErrors([
                    'email' => 'Your provided credentials could not be verified.',
                    'password' => 'Your provided credentials could not be verified.',
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'Welcome back!');
    }
}

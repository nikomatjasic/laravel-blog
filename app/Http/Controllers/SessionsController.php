<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Come back soon!');
    }

    /**
     * Authenticate the user.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }
        session()->regenerate();

        return redirect('/')->with('success', 'Welcome back!');
    }

    public function create()
    {
        return view('sessions.create');
    }
}

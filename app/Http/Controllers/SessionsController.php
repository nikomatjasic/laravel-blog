<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionsRequest;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Come back soon!');
    }

    public function store(StoreSessionsRequest $request)
    {
        $attributes = $request->validated();
        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.',
                'password' => 'Password incorrect.'
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

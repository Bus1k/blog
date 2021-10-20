<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $input = request()->validate([
            'email'    => ['required','email'],
            'password' => ['required']
        ]);

        if(!auth()->attempt($input)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();
        return redirect(route('home'))
            ->with('success', 'Welcome back '.auth()->user()->username.'!');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect(route('home'))->with('success', 'You have been logged out.');
    }
}

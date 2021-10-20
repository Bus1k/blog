<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function destroy()
    {
        auth()->logout();
        return redirect(route('home'))->with('success', 'You have been logged out.');
    }
}

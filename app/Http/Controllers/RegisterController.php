<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $input = request()->validate([
            'username' => ['required', 'string', 'min:5', 'max:255', Rule::unique(User::class, 'username')],
            'name'     => ['required', 'string', 'min:5', 'max:255'],
            'email'    => ['required', 'email', 'min:3', 'max:255', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', 'min:7'],
        ]);

        $input['pasword'] = Hash::make($input['password']);

        $user = User::create($input);
        auth()->login($user);

        return redirect(route('home'))
            ->with('success', 'Your account has been created.');
    }
}

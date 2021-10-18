<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            'username' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique(User::class, 'username')
            ],
            'name'     => ['required', 'string', 'min:5', 'max:255'],
            'email'    => ['required', 'email', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'min:7'],
        ]);

        User::create([
            'username' => $input['username'],
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

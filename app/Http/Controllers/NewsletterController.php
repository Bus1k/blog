<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;

class NewsletterController extends Controller
{

    public function store(Newsletter $newsletter)
    {
        request()->validate([
            'email' => ['required', 'email'],
        ]);

        try
        {
            $newsletter->subscribe(request('email'));

        } catch(\Exception $e) {
            return redirect('/')
                ->with('error', 'Wrong email for our newsletter list');
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }

}

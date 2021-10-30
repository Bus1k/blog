<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;

class NewsletterController extends Controller
{

    public function store()
    {
        request()->validate([
            'email' => ['required', 'email'],
        ]);

        try
        {
            $newsletter = new Newsletter();
            $newsletter->subscribe(request('email'));

        } catch(\Exception $e) {
            return redirect('/')
                ->with('error', 'Wrong email for our newsletter list');
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate([
           'body' => ['required', 'min:5']
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'body'    => request('body')
        ]);

        return back()
            ->with('success', 'Your comment has been added.');
    }
}

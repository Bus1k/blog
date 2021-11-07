<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(9)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $input = request()->validate([
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'thumbnail'   => ['required', 'image'],
            'excerpt'     => ['required', 'string', 'min:5', 'max:255'],
            'body'        => ['required', 'string', 'min:30', 'max:255'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $input['slug']      = Str::kebab($input['title']);
        $input['user_id']   = auth()->id();
        $input['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($input);

        return redirect('/');
    }

    public function dashboard()
    {
        return view('posts.dashboard', [
            'posts' => Post::all()
        ]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post'       => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Post $post)
    {
        $input = request()->validate([
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'thumbnail'   => ['image'],
            'excerpt'     => ['required', 'string', 'min:5', 'max:255'],
            'body'        => ['required', 'string', 'min:30', 'max:255'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $input['slug'] = Str::kebab($input['title']);

        if(isset($input['thumbnail'])) {
            $input['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($input);

        return redirect(route('dashboard-post'))
            ->with('success', 'Post Updated.');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect(route('dashboard-post'))
            ->with('success', 'Post Deleted.');
    }

}

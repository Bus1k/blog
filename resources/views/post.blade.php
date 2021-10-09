<h1>{{ $post->title }}</h1>

<p>
    By Busik in

    <a href="/categories/{{ $post->category->slug }}">
         {{ $post->category->name }}
    </a>
</p>

<p>{{ $post->body }}</p>


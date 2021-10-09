<x-layout>

    @foreach($posts as $post)
        <article>

            <h1>
                <a href="/post/{{ $post->slug }}">
                    {{ $post->title }}
                </a>
            </h1>

            <div>
                <p>{{ $post->excerpt }}</p>
            </div>

        </article>
    @endforeach
</x-layout>

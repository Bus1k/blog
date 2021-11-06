@props(['heading'])

<section class="py-8 max-w-3xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-500' : '' }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('create-post') }}" class="{{ request()->routeIs('create-post') ? 'text-blue-500' : '' }}">Create Post</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>

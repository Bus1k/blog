<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>Laravel From Scratch Blog</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-sm font-bold uppecase flex">Welcome, {{ auth()->user()->name }}
                                <x-svg-icon name="down-arrow" class="pointer-events-none" style="right: 12px;"/>
                            </button>
                        </x-slot>

                        <x-dropdown-item href="{{ route('dashboard-post') }}" :active="request()->routeIs('dashboard-post')">Dashboard</x-dropdown-item>
                        <x-dropdown-item href="{{ route('create-post') }}" :active="request()->routeIs('create-post')">Create Post</x-dropdown-item>
                        <x-dropdown-item href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">Logout</x-dropdown-item>
                    </x-dropdown>


                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                        @csrf
                        <input type="hidden" value="logout" name="logout">
                    </form>
                @else
                    <a href="{{ route('register') }}" class="text-xs font-bold uppercase">Register</a>
                    <a href="{{ route('login') }}" class="ml-4 text-xs font-bold uppercase">Log In</a>
                @endauth

                <a href="#footer" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>

        {{ $slot }}

        <footer id="footer" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="{{ route('newsletter') }}" class="lg:flex text-sm">
                        @csrf

                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" name="email" type="text" placeholder="Your email address"
                                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

                            @if(session()->has('error'))
                                <span class="text-xs text-red-500">{{ session('error') }}</span>
                            @endif
                        </div>

                        <button type="submit"
                                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>

    <x-flash />

    </body>
</html>

<!doctype html>
<head>
    <title>Laravel From Scratch Blog</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    @php
      use Illuminate\Support\Js;
    @endphp
    <script>
        window.Laravel = window.Laravel || {};
        window.Laravel.userFollowers = {{ Js::from($userFollowers ?? []) }};
        window.Laravel.userFollowing = {{ Js::from($userFollowing ?? []) }};
    </script>

    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
</head>
<body style="font-family: 'Poppins', sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
               <div class="text-2xl">Agile<strong>Blog</strong></div>
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @guest
                <a href="/login" class="text-xs font-bold uppercase text-blue-500 mr-3">Login</a>
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
            @endguest
            @auth
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="text-xs font-bold uppercase">Welcome back, {{ auth()->user()->name }}.
                        </button>
                    </x-slot>

                    @if(auth()->user()->can('admin'))
                        @can('admin')
                            <x-dropdown-item
                                href="/admin/posts"
                                :active="request()->is('/admin/posts')"
                            >
                                All posts
                            </x-dropdown-item>

                            <x-dropdown-item
                                href="/admin/posts/create"
                                :active="request()->is('/admin/posts/create')"
                            >
                                New post
                            </x-dropdown-item>
                        @endif
                    @endcan
                    <x-dropdown-item href="#"
                                     x-data="{}"
                                     @click.prevent="document.querySelector('#logout-form').submit()"
                    >
                        Logout
                    </x-dropdown-item>
                    <form method="POST" action="/logout" id="logout-form" class="hidden">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </x-dropdown>

            @endguest

            <a href="#newsletter"
               class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase‰ py-3 px-5">
                Subscribe for Updates
            </a>
        </div>
    </nav>
    {{ $slot  }}
    <footer id="newsletter"
            class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="/newsletter" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <input id="email" name="email" type="text" placeholder="Your email address"
                               class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none"
                               value=" {{ old('email') }}">
                    </div>

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>

                    @error('email')
                    <label class="text-red-500 text-xs"> {{ $message }} </label>
                    @enderror
                </form>
            </div>
        </div>
    </footer>
</section>

@auth
    <div id="notifications_container">
        <x-notification-box />
    </div>
@endauth
<x-flash></x-flash>
<x-script></x-script>
</body>

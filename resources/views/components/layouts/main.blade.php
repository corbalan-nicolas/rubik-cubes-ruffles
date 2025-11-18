<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ url('/images/brand/favicon-white.svg') }}" sizes="any" type="image/svg+xml" media="(prefers-color-scheme: light)">
    <link rel="icon" href="{{ url('/images/brand/favicon-dark.svg') }}" sizes="any" type="image/svg+xml" media="(prefers-color-scheme: dark)">

    @if(isset($title))
        <title>{{ $title }} ¬ Qubo</title>
    @else
        <title>Qubo</title>
    @endif

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('css/blogs.css') }}">

    {{-- Tailwindcss --}}
    @vite('resources/css/app.css')
</head>
<body>
    <a class="skip-link" href="#main">Skip to main content</a>

    <div id="app">
        <header class="bg-neutral-lighter">
            <div class="max-w-[1680px] grid grid-cols-[3fr_6fr_3fr] justify-between items-center py-2 px-4">
                <div class="flex justify-start">
                    <a class="logo-container" href="{{ route('raffles.index') }}">
                        <img class="logo" src="{{ url('/images/brand/logotype.svg') }}" alt="Qubo's logotype">
                    </a>
                </div>
                <nav aria-label="main">
                    <ul class="flex justify-center">
                        <li>
                            <x-nav-link class="border-y-6 border-transparent [.active]:border-t-text [.active]:bg-neutral-light" route="raffles.index">
                                Home
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="border-y-6 border-transparent [.active]:border-t-text [.active]:bg-neutral-light" route="blogs.index">
                                Blogs
                            </x-nav-link>
                        </li>
                    </ul>
                </nav>

                <div class="flex justify-end gap-2 items-center">
                    @auth
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button class="btn">Logout</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('dashboard.index') }}">Dashboard</a>
                    @else
                        <x-nav-link class="border-y-6 border-transparent [.active]:border-t-text [.active]:bg-neutral-light" class="btn" route="auth.login.show">Login</x-nav-link>
                        <x-nav-link class="border-y-6 border-transparent [.active]:border-t-text [.active]:bg-neutral-light" class="btn btn-primary" route="auth.register.show">Register</x-nav-link>
                    @endauth
                </div>
            </div>
        </header>
        <main id="main">
            {{$slot}}
        </main>
    </div>
</body>
</html>

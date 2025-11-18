<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ url('/images/brand/favicon-white.svg') }}" sizes="any" type="image/svg+xml" media="(prefers-color-scheme: light)">
    <link rel="icon" href="{{ url('/images/brand/favicon-dark.svg') }}" sizes="any" type="image/svg+xml" media="(prefers-color-scheme: dark)">

    @if(isset($title))
        <title>{{ $title }} ¬ Dashboard Qubo</title>
    @else
        <title>Qubo</title>
    @endif

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('css/blogs.css') }}">

    {{-- Tailwindcss --}}
    @vite('resources/css/app.css')
</head>
<body>
<h1 class="sr-only">Dashboard Qubo</h1>
<a class="skip-link" href="#main">Skip to main content</a>

<div id="root-modal"></div>

<div id="app" class="max-w-[1680px] mx-auto min-h-dvh bg-neutral grid grid-cols-[minmax(auto,15rem)_5fr] border">
    <header class="bg-neutral-lighter py-4 px-2 flex flex-col">
        <a class="logo-container mb-12" href="{{ route('dashboard.index') }}">
            <img class="logo" src="{{ url('/images/brand/logotype.svg') }}" alt="Qubo's logotype">
        </a>
        <nav class="grow" aria-label="main">
            <ul class="flex flex-col gap-2">

                <li class="nav-li">
                    <x-nav-link
                        class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                        route="dashboard.index"
                    >
                        <x-icons.home />
                        Home
                    </x-nav-link>
                </li>

                <li class="nav-li">
                    <x-nav-link
                        class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                        route="dashboard.my-profile.show"
                    >
                        <x-icons.user />
                        My Profile
                    </x-nav-link>
                </li>

                @if(auth()->user()->role_id >= 2)
                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="dashboard.blogs"
                        >
                            <x-icons.blog />
                            My Blogs
                        </x-nav-link>
                    </li>
                @endif

                @if(auth()->user()->role_id >= 3)
                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="dashboard.my-raffles"
                        >
                            <x-icons.raffle />
                            My raffles
                        </x-nav-link>
                    </li>
                @endif

                @if(auth()->user()->role_id >= 4)
                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="dashboard.blogs.publish_requests"
                        >
                            <x-icons.request />
                            Publish Requests
                        </x-nav-link>
                    </li>
                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="dashboard.all-users"
                        >
                            <x-icons.users />
                            All users
                        </x-nav-link>
                    </li>
                @endif

                <li class="nav-li">
                    <x-nav-link route="raffles.index">Exit</x-nav-link>
                </li>
            </ul>
        </nav>


        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            <button>
                <x-icons.logout />
                Logout
            </button>
        </form>
    </header>
    <main id="main" class="p-4">
        {{$slot}}
    </main>
</div>
</body>
</html>

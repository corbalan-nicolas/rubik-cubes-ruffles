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

    {{-- Tailwindcss --}}
    @vite('resources/css/app.css')
</head>
<body>
<a class="skip-link" href="#main">Skip to main content</a>

<div id="root-modal"></div>

<div id="app" class="max-w-[1680px] mx-auto min-h-dvh bg-neutral grid max-md:grid-cols-[auto_1fr] md:grid-cols-[minmax(auto,15rem)_5fr]">

    <header class="bg-neutral-lighter h-dvh sticky top-0">
        <div class="py-4 px-2 flex flex-col h-full">
            <a class="logo-container mb-12" href="{{ route('dashboard.index') }}">
                {{-- Collapse logo --}}
                <img class="md:hidden h-12" src="{{ url('/images/brand/qubo-isotype-theme-white.svg') }}" alt="Qubo's logo">
                {{-- Expanded logo --}}
                <img class="max-md:hidden logo" src="{{ url('/images/brand/logotype.svg') }}" alt="Qubo's logotype">
            </a>

            <nav class="grow" aria-label="main">
                <ul class="flex flex-col gap-2">

                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="dashboard.index"
                        >
                            <x-icons.home />
                            <span class="max-md:hidden">Home</span>
                        </x-nav-link>
                    </li>

                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="dashboard.user-profile.show"
                            :params="['id' => auth()->user()->id]"
                            :activeCondition="request()->route()->parameter('id') == auth()->user()->id"
                        >
                            <x-icons.user />
                            <span class="max-md:hidden">My Profile</span>
                        </x-nav-link>
                    </li>

                    <li class="nav-li">
                        <x-nav-link
                            class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                            route="checkout"
                        >
                            <x-icons.ticket />
                            <span class="max-md:hidden">Buy Tickets</span>
                        </x-nav-link>
                    </li>

                    @if(auth()->user()->role_id >= 2)
                        <li class="nav-li">
                            <x-nav-link
                                class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                                route="dashboard.blogs"
                            >
                                <x-icons.blog />
                                <span class="max-md:hidden">My Blogs</span>
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
                                <span class="max-md:hidden">My Raffles</span>
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
                                <span class="max-md:hidden">Publish Requests</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-li">
                            <x-nav-link
                                class="border-l-6 border-transparent [.active]:bg-neutral-light [.active]:border-text"
                                route="dashboard.all-users"
                            >
                                <x-icons.users />
                                <span class="max-md:hidden">All Users</span>
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
                <button
                    class="border-l-6 border-transparent flex gap-2"
                >
                    <x-icons.logout />
                    <span class="max-md:hidden">Logout</span>
                </button>
            </form>
        </div>
    </header>
    <main id="main" class="p-4">
        {{$slot}}
    </main>

    <x-toast-notifications />
</div>
</body>
</html>

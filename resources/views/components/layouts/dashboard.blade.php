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
    <link rel="stylesheet" href="{{ url('css/dashboard-layout.css') }}">
    <link rel="stylesheet" href="{{ url('css/blogs.css') }}">
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">

</head>
<body>
<h1 class="sr-only">Dashboard Qubo</h1>
<a class="skip-link" href="#main">Skip to main content</a>

<div id="root-modal"></div>

<div id="app">
    <header>
        <a class="logo-container" href="{{ route('dashboard.index') }}">
            <img class="logo" src="{{ url('/images/brand/logotype.svg') }}" alt="Qubo's logotype">
        </a>
        <nav aria-label="main">
            <ul class="nav-list">
                <li class="nav-li">
                    <x-nav-link route="dashboard.index">
                        <x-icons.home />
                        Home
                    </x-nav-link>
                </li>

                @if(auth()->user()->role_id >= 2)
                    <li class="nav-li">
                        <x-nav-link route="dashboard.blogs">
                            <x-icons.blog />
                            My Blogs
                        </x-nav-link>
                    </li>
                @endif

                @if(auth()->user()->role_id >= 3)
                    <li class="nav-li">
                        <x-nav-link route="dashboard.index">
                            <x-icons.ruffle />
                            My Ruffles
                        </x-nav-link>
                    </li>
                @endif

                @if(auth()->user()->role_id >= 4)
                    <li class="nav-li">
                        <x-nav-link route="dashboard.blogs.publish_requests">
                            <x-icons.request />
                            Publish Requests
                        </x-nav-link>
                    </li>
                @endif

                @if(auth()->user()->role_id >= 5)
                    {{--<li class="nav-li">
                        <x-nav-link route="dashboard.index">
                            <x-icons.users />
                            Users
                        </x-nav-link>
                    </li>--}}
                @endif

                <li class="nav-li">
                    <x-nav-link route="ruffles.index">Exit</x-nav-link>
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
    <main id="main">
        {{$slot}}
    </main>
</div>
</body>
</html>

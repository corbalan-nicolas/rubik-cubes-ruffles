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
    <link rel="stylesheet" href="{{ url('css/main-layout.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to main content</a>

    <div id="app">
        <header>
            <div class="header container">
                <div>
                    <a class="logo-container" href="{{ route('ruffles.index') }}">
                        <img class="logo" src="{{ url('/images/brand/logotype.svg') }}" alt="Qubo's logotype">
                    </a>
                </div>
                <nav aria-label="main">
                    <ul>
                        <li>
                            <x-nav-link route="ruffles.index">
                                Home
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link route="blogs.index">
                                Blogs
                            </x-nav-link>
                        </li>
                    </ul>
                </nav>

                <div class="auth-buttons">
                    @auth
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button class="btn">Logout</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('dashboard.index') }}">Dashboard</a>
                    @else
                        <x-nav-link class="btn" route="auth.login.show">Login</x-nav-link>
                        <x-nav-link class="btn btn-primary" route="auth.register.show">Register</x-nav-link>
                    @endauth
                </div>
            </div>
        </header>
        <main id="main" class="container-sm">
            {{$slot}}
        </main>
    </div>
</body>
</html>

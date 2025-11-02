<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($title))
        <title>{{ $title }} ¬ Dashboard Qubo</title>
    @else
        <title>Qubo</title>
    @endif

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
<a class="skip-link" href="#main">Skip to main content</a>

<div id="root-modal"></div>

<header>
    <nav aria-label="main">
        <ul>
            <li><a href="{{ route('dashboard.index') }}">Home</a></li>

            @if(auth()->user()->role_id >= 2)
                <li><a href="{{ route('dashboard.blogs') }}">My Blogs</a></li>
            @endif

            @if(auth()->user()->role_id >= 3)
                <li><a href="{{ route('dashboard.index') }}">My Ruffles</a></li>
            @endif

            @if(auth()->user()->role_id >= 4)
                <li><a href="{{ route('dashboard.blogs.publish_requests') }}">Publish Requests</a></li>
            @endif

            @if(auth()->user()->role_id >= 5)
                <li><a href="{{ route('dashboard.index') }}">Users</a></li>
            @endif

            <li><a href="{{ route('ruffles.index') }}">Exit</a></li>
            <li>
                <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <button>Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<main id="main">
    {{$slot}}
</main>
</body>
</html>

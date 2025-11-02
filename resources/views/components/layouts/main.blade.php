<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($title))
        <title>{{ $title }} ¬ Qubo</title>
    @else
        <title>Qubo</title>
    @endif

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to main content</a>

    <header>
        <nav aria-label="main">
            <ul>
                <li><a href="{{ route('ruffles.index') }}">Home</a></li>
                <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                @auth
                    <li>
                        <button
                            id="btn-user-options"
                            aria-controls="user-options"
                        >Open / close user options</button>

                        <ul aria-expanded="false" id="user-options">
                            <li><a href="{{ route('dashboard.index') }}">{{ auth()->user()->display_name }}</a></li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="post">
                                    @csrf
                                    <button>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('auth.login.show') }}">Login</a></li>
                    <li><a href="{{ route('auth.register.show') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>
    <main id="main">
        {{$slot}}
    </main>

    @auth
        <script defer>
            const $btn = document.querySelector('#btn-user-options')
            const $ul = document.querySelector('#user-options')

            $btn.addEventListener('click', () => {
                $ul.ariaExpanded = $ul.ariaExpanded === 'true' ? 'false' : 'true'
            })
        </script>
    @endauth
</body>
</html>

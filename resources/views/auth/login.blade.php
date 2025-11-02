<x-layouts.main>
    <x-slot:title>Login</x-slot:title>

    <h1>Login</h1>
    <form action="{{ route('auth.login') }}" method="post">
        @csrf

        <p>You don't have an account? <a href="{{ route('auth.register.show') }}">Register</a></p>

        <div>
            <label for="email">Gmail <span>*</span></label>
            <input
                id="email"
                type="text"
                name="email"
                value="{{ old('email') }}"
                autofocus
            >
            @error('email')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="password">Password <span>*</span></label>
            <input
                id="password"
                type="password"
                name="password"
            >
            @error('password')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <button>Login</button>
    </form>
</x-layouts.main>

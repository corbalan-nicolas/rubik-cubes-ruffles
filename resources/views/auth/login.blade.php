<x-layouts.main>
    <x-slot:title>Login</x-slot:title>

    <div class="container-sm">
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
                    @error('email')
                    aria-invalid="true"
                    aria-errormessage="email-error"
                    @enderror
                >
                @error('email')
                <small id="email-error">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="password">Password <span>*</span></label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    @error('password')
                    aria-invalid="true"
                    aria-errormessage="password-error"
                    @enderror
                >
                @error('password')
                <small id="password-error">{{ $message }}</small>
                @enderror
            </div>

            <button>Login</button>
        </form>
    </div>
</x-layouts.main>

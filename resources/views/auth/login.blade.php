<x-layouts.main>
    <x-slot:title>Login</x-slot:title>

    <div class="container-sm">
        <h1 class="text-6xl my-6">Login</h1>

        <x-feedback-message />

        <form action="{{ route('auth.login') }}" method="post">
            @csrf

            <p>You don't have an account? <a href="{{ route('auth.register.show') }}">Register</a></p>

            <div class="mb-4">
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

            <div class="mb-4">
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

            <button class="btn btn-primary">Login</button>
        </form>
    </div>
</x-layouts.main>

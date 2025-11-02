<x-layouts.main>
    <x-slot:title>Register</x-slot:title>

    <h1>Register</h1>
    <form action="{{ route('auth.register') }}" method="post">
        @csrf

        <p>Have an account already? <a href="{{ route('auth.login.show') }}">Login</a></p>

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

        <div>
            <label for="confirm_password">Confirm confirm_password <span>*</span></label>
            <input
                id="confirm_password"
                type="password"
                name="confirm_password"
            >
            @error('confirm_password')
            <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" name="terms">
                Accept whatever you have to accept every time you create a new account
            </label>
        </div>

        <button>Register</button>
    </form>
</x-layouts.main>

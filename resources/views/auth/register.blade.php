<x-layouts.main>
    <x-slot:title>Register</x-slot:title>

    <div class="container-sm">
        <h1 class="text-6xl my-6">Register</h1>

        <x-feedback-message />

        <form action="{{ route('auth.register') }}" method="post">
            @csrf

            <p>Have an account already? <a class="link" href="{{ route('auth.login.show') }}">Login</a></p>

            <div class="mb-4">
                <label for="name">Full name <span>*</span></label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    autofocus
                    @error('name')
                    aria-invalid="true"
                    aria-errormessage="name-error"
                    @enderror
                >
                @error('name')
                <small id="name-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email">Gmail <span>*</span></label>
                <input
                    id="email"
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
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

            <div class="mb-4">
                <label for="confirm_password">Confirm confirm_password <span>*</span></label>
                <input
                    id="confirm_password"
                    type="password"
                    name="confirm_password"
                    @error('confirm_password')
                    aria-invalid="true"
                    aria-errormessage="confirm_password-error"
                    @enderror
                >
                @error('confirm_password')
                <small id="confirm_password-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label>
                    <input
                        type="checkbox"
                        name="terms"
                        @checked(old('terms'))
                        @error('terms')
                        aria-invalid="true"
                        aria-errormessage="terms-error"
                        @enderror
                    >
                    Accept terms and conditions <a href="#">Legit link to terms and conditions</a>
                </label>
                @error('terms')
                <small id="terms-error" class="block">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</x-layouts.main>

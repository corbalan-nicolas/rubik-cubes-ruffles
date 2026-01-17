<x-layouts.dashboard>
    <x-slot:title>Edit my profile</x-slot:title>

    <h1 class="text-6xl mb-4">Edit My Profile</h1>

    <form action="{{ route('auth.edit') }}" method="post">
        @csrf
        <section>
            <h2 class="text-3xl">Profile information</h2>

            <div class="mb-4">
                <label for="name">Full name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', auth()->user()->name) }}"
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
                <label for="display_name">Display name</label>
                <input
                    id="display_name"
                    type="text"
                    name="display_name"
                    value="{{ old('display_name', auth()->user()->display_name) }}"
                    @error('display_name')
                    aria-invalid="true"
                    aria-errormessage="display_name-error"
                    @enderror
                >
                @error('display_name')
                <small id="display_name-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="text"
                    name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    @error('email')
                    aria-invalid="true"
                    aria-errormessage="email-error"
                    @enderror
                >
                @error('email')
                <small id="email-error">{{ $message }}</small>
                @enderror
            </div>
        </section>

        <section>
            <h2 class="text-3xl">Access Credentials</h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="mb-4">
                    <label for="current_password">Current password</label>
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        value="{{ old('current_password', auth()->user()->current_password) }}"
                        @error('current_password')
                        aria-invalid="true"
                        aria-errormessage="current_password-error"
                        @enderror
                    >
                    @error('current_password')
                    <small id="current_password-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="new_password">New password</label>
                    <input
                        id="new_password"
                        type="password"
                        name="new_password"
                        value="{{ old('new_password', auth()->user()->new_password) }}"
                        @error('new_password')
                        aria-invalid="true"
                        aria-errormessage="new_password-error"
                        @enderror
                    >
                    @error('new_password')
                    <small id="new_password-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="confirm_new_password">Confirm new password</label>
                    <input
                        id="confirm_new_password"
                        type="password"
                        name="confirm_new_password"
                        value="{{ old('confirm_new_password', auth()->user()->confirm_new_password) }}"
                        @error('confirm_new_password')
                        aria-invalid="true"
                        aria-errormessage="confirm_new_password-error"
                        @enderror
                    >
                    @error('confirm_new_password')
                    <small id="confirm_new_password-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </section>

        <button class="btn btn-primary">Save changes</button>
    </form>
</x-layouts.dashboard>

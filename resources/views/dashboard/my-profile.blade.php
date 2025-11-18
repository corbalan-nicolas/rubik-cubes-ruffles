<x-layouts.dashboard>
    <x-slot:title>My profile</x-slot:title>

    <h1>My profile</h1>

    <x-user-profile :user="auth()->user()" />
</x-layouts.dashboard>

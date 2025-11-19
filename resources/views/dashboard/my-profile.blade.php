<x-layouts.dashboard>
    <x-slot:title>My profile</x-slot:title>

    <h2 class="sr-only">My profile</h2>

    <x-user-profile :user="auth()->user()" />
</x-layouts.dashboard>

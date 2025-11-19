<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection $users
 */
?>

<x-layouts.dashboard>
    <x-slot:title>All users</x-slot:title>

    <h2 class="text-6xl mb-4">List of users</h2>
    {{-- If you're here, that means there's at least 1 user 🤷‍ ️--}}
    <ul>
        @foreach($users as $user)
            <li>
                <a href="{{ route('dashboard.user-profile.show', ['id' => $user->id]) }}">
                    {{ $user->display_name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layouts.dashboard>

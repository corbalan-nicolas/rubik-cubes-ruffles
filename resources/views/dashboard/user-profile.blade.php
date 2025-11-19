<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $user
 */
?>

<x-layouts.dashboard>
    <x-slot:title>{{ $user->display_name }}</x-slot:title>

    <h2 class="sr-only">User profile</h2>

    <x-user-profile :user="$user" />
</x-layouts.dashboard>

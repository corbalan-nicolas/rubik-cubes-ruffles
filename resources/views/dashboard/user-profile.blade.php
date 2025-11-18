<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $user
 */
?>

<x-layouts.dashboard>
    <x-slot:title>{{ $user->display_name }}</x-slot:title>

    <h1>{{ $user->display_name }}</h1>

    <x-user-profile :user="$user" />
</x-layouts.dashboard>

<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $user
 * @var \Illuminate\Database\Eloquent\Collection $history
 * @var Number $totalPaid
 */
?>

<x-layouts.dashboard>
    <x-slot:title>{{ $user->display_name }}</x-slot:title>

    <h1 class="sr-only">User profile</h1>

    <x-user-profile :user="$user" :history="$history" :totalPaid="$totalPaid" />
</x-layouts.dashboard>

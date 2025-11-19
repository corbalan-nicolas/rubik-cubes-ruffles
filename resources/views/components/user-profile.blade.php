<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $user
 */
?>

<section class="pt-60 pb-4 px-4 mx-[-1rem] mt-[-1rem] bg-neutral-light border-b-black/10 border-b">
    <p class="font-sm font-light pb-2">{{ ucfirst($user->role->role) }} · {{ $user->name }} · {{ $user->email }}</p>
    <p class="text-6xl font-h">{{ $user->display_name }}</p>
</section>

<section class="py-2">
    <h3 class="text-2xl">More information</h3>

    <div>
        Total of tickets bought:
        {{ $user->tickets()->count() }}
    </div>
</section>

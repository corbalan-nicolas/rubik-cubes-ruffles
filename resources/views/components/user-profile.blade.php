<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $user
 * @var \Illuminate\Database\Eloquent\Collection $history
 * @var $totalPaid
 * @var $totalOfTicketsBought
 */
?>

<section class="pt-60 pb-4 px-4 mx-[-1rem] mt-[-1rem] bg-neutral-light border-b-black/10 border-b">
    <h2 class="sr-only">Main information</h2>
    @if(auth()->user()->id === $user->id)
    <p class="font-sm font-light pb-2">{{ ucfirst($user->role->role) }} · {{ $user->name }} · {{ $user->email }} · <a href="{{ route('auth.edit.show') }}">Edit profile</a></p>
    @else
    <p class="font-sm font-light pb-2">{{ ucfirst($user->role->role) }} · {{ $user->name }} · {{ $user->email }}</p>
    @endif
    <p class="max-md: text-4xl md:text-6xl font-h">{{ $user->display_name }}</p>
</section>

<section class="py-2">
    <h2 class="text-2xl">Summary</h2>

    <article>
        <h3>Total of tickets bought</h3>
        {{ $totalOfTicketsBought }}
    </article>
    <article>
        <h3>Money spent</h3>
        {{ $totalPaid }}
    </article>
</section>

<section>
    <h2 class="text-2xl">History of tickets bought</h2>

    @forelse($history as $payment)
        <div @class([
            "flex items-center gap-4 py-2",
            "border-b border-black/20" => !$loop->last
        ])>
            <span class="flex gap-1 items-center text-2xl font-medium">
                {{ 'x'. count($payment['tickets']) }}
                <x-icons.ticket />
            </span>

            <div class="grow flex flex-col items-start justify-center">
                <span>{{ $payment['tickets'][0]['raffle']['title'] }}</span>

                <span class="text-sm text-black/40 hover:text-black transition">{{ explode(' ', $payment['created_at'])[0] }}</span>
            </div>

            <span class="font-bold text-lg">{{ '$USD ' . $payment['amount'] }}</span>
        </div>
    @empty
        <p>You haven't bought any ticket yet</p>
    @endforelse
</section>

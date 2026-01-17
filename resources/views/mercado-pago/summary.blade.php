<?php
/**
 * @var \MercadoPago\Client\Preference\PreferenceClient $preference
 * @var \Illuminate\Database\Eloquent\Model $raffle
 * @var String $MPPublicKey MercadoPago public key
 */
?>

<x-layouts.dashboard>
    <h1 class="text-6xl mb-4">Checkout > Summary</h1>

    <div class="lg:flex gap-4 border">
        <div class="grow">
            <p class="text-2xl font-semibold">Name: {{ auth()->user()->name }}</p>
            <p class="mb-4">Email: {{ auth()->user()->email }}</p>

            {{-- You're about to buy "x" ticket(s) for "raffle->title" raffle sponsored by "sponsor>display_name" --}}
            <p>
                You're about to buy <span class="font-bold">{{ $preference->items[0]->quantity }} ticket{{ $preference->items[0]->quantity > 1 ? 's' : ''}}</span> for
                "<span class="font-bold">{{ $raffle->title }}</span>" raffle sponsored by <span class="font-bold">{{ $raffle->sponsor->display_name }}</span>
            </p>
        </div>

        <div class="flex flex-col justify-end h-full">
            <span class="text-end">
                Total:
                ${{ $preference->items[0]->unit_price * $preference->items[0]->quantity }}
            </span>
            <div id="mercdaopago_payment_button"></div>
        </div>
    </div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('{!! $MPPublicKey !!}')

        mp.bricks().create('wallet', 'mercdaopago_payment_button', {
            initialization: {
                preferenceId: '{!! $preference->id !!}'
            }
        })
    </script>
</x-layouts.dashboard>

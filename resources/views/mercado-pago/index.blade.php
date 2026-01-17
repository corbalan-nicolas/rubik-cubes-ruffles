<?php
/**
 * @var \MercadoPago\Client\Preference\PreferenceClient $preference
 * @var String $MPPublicKey MercadoPago public key
 */
?>

<x-layouts.dashboard>
    <h1 class="text-6xl mb-4">Checkout</h1>

    <form action="{{ route('checkout.summary') }}" method="get">
        <div class="mb-4">
            <label for="quantity">Quantity of Tickets (1 USD each) <span>*</span></label>
            <input
                id="quantity"
                type="text"
                name="quantity"
                value="{{ old('quantity', 1) }}"
                autofocus
                @error('quantity')
                aria-invalid="true"
                aria-errormessage="quantity-error"
                @enderror
            >
            @error('quantity')
            <small id="quantity-error">{{ $message }}</small>
            @enderror

            <p>&#128712; Each ticket you buy increments your chance of being a winner</p>
        </div>

        <button class="btn btn-primary">Next</button>
    </form>
</x-layouts.dashboard>

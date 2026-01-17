<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function index()
    {
        return view('mercado-pago.index');
    }

    public function summary(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        try {
            MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

            $preferenceFactory = new PreferenceClient();
            $preference = $preferenceFactory->create([
                'items' => [
                    [
                        'title' => 'Tickets',
                        'unit_price' => 1500,
                        'quantity' => intval($request->input('quantity'))
                    ]
                ],
                'back_urls' => [
                    //'success' => route('checkout.success'),
                    'success' => 'https://ramon-oversteady-pseudofeverishly.ngrok-free.dev/checkout/success',
                    'failure' => route('checkout.failure'),
                ],
                'auto_return' => 'approved'
            ]);

            return view('mercado-pago.summary', [
                'preference' => $preference,
                'raffle' => Raffle::currentRaffle(),
                'MPPublicKey' => config('mercadopago.public_key'),
            ]);
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            echo $e->getApiResponse()->getContent()['message'];
        } catch (\Throwable $th) {
            throw $th;
        }

        return false;
    }

    public function success(Request $request)
    {
        dd($request->input());
    }

    public function failure(Request $request)
    {
        dd($request->input());
    }

    public function verify_payment(Request $request)
    {
        Log::info('[MercadoPagoController verify_payment()]');

        if ($request->boolean('payment-successful')) {
            Log::info('Payment successful', [$request->input()]);

            // Guardo toda la información del pago, intuyo...
        } else {
            Log::info('Payment failed', [$request->input()]);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyMercadoPagoPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::debug('----------------------------------------------------------------------------');
        Log::debug('[VerifyMercadoPagoPayment] Middleware');

        $data = $request->input();
        $receivedSignature = $request->header('x-signature');
        $receivedRequestId = $request->header('x-request-id');

        Log::info('Data: ', [$data]);
        Log::info('Signature Received: ' . $receivedSignature);
        Log::info('Request ID Received: ' . $receivedRequestId);

        $signature = array_map(fn ($param) => explode('=', $param)[1], explode(',', $receivedSignature));

        $validationKey = "id:$data[id];request-id:$receivedRequestId;ts:$signature[0];";

        Log::info('Signature: ', [$signature]);
        Log::info('Validation Key: '. $validationKey);

        $hashedKey = hash_hmac('sha256', $validationKey, config('mercadopago.notification_secret_key'));

        Log::info('Hashed Key: '. $hashedKey);

        $request->merge(['payment-successful' => $signature[1] === $hashedKey]);

        Log::debug('----------------------------------------------------------------------------');
        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	public function checkout()
	{
		\Stripe\Stripe::setApiKey('sk_test_51HPDInKqixIUBKnLyyvlOPNG8uKoH1PgAtonkpPRNXMSHSXfrM04JW40ySBHwkGWyq9wsasDTkii9i2PVrOM7anE00lDGsrLFe');

		$amount = 100;
		$amount *= 100;
		$amount = (int) $amount;

		$paymentIntent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'USD',
			'payment_method_types' => ['card'],
		]);
		$intent = $paymentIntent->client_secret;

		return view('checkout.credit-card', [
			'intent' => $intent
		]);
	}

	public function paymentdone()
	{
		return redirect('/checkout-success');
	}
}

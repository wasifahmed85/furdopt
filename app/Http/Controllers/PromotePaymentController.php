<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\PetPromotionSuccessMail;
use App\Mail\FailedPaymentEmail;
use App\Models\PromotePayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PromotePaymentController extends Controller
{
    /**
     * Handle the checkout process for pet promotion.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|string',
            'payment_method' => 'required|in:stripe,paypal',
            'amount' => 'required|numeric|min:5.99',
        ]);

        try {
            $decryptedPetId = Crypt::decryptString($request->pet_id);
            $pet = Pet::findOrFail($decryptedPetId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'Invalid pet ID provided.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Pet not found.');
        }


        $promotionAmount = (float)$request->amount;
        $promotionName = 'Promote ' . $pet->name;

        // Store promotion details in session for success callbacks
        session()->put('promotion_pet_id', $pet->id);
        session()->put('promotion_amount', $promotionAmount);
        session()->put('promotion_name', $promotionName);

        if ($request->payment_method === 'stripe') {
            \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));

            $lineItems = [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $promotionName,
                        'description' => 'Promote your pet for increased visibility.',
                    ],
                    'unit_amount' => $promotionAmount * 100, // Stripe expects amount in cents
                ],
                'quantity' => 1,
            ]];

            try {
                $response = \Stripe\Checkout\Session::create([
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => route('f.promote.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('f.promote.stripe.cancel'),
                ]);
                return redirect($response->url);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                return redirect()->route('f.promote.stripe.cancel')->with('error', 'Stripe error: ' . $e->getMessage());
            }
        } elseif ($request->payment_method === 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            try {
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('f.promote.paypal.success'),
                        "cancel_url" => route('f.promote.paypal.cancel')
                    ],
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => "USD",
                                "value" => number_format($promotionAmount, 2, '.', ''), // PayPal expects string for value
                            ],
                            "description" => $promotionName,
                        ]
                    ]
                ]);

                if (isset($response['id']) && $response['id'] != null) {
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            return redirect()->away($link['href']);
                        }
                    }
                    return redirect()->route('f.promote.paypal.cancel')->with('error', 'PayPal approval link not found.');
                } else {
                    return redirect()->route('f.promote.paypal.cancel')->with('error', $response['message'] ?? 'Something went wrong with PayPal.');
                }
            } catch (\Exception $e) {
                return redirect()->route('f.promote.paypal.cancel')->with('error', 'PayPal error: ' . $e->getMessage());
            }
        }
        return abort(400, 'Unsupported payment method.');
    }

    /**
     * Handle successful Stripe payment for pet promotion.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successStripe(Request $request)
    {
        $user = Auth::user();
        $petId = session()->get('promotion_pet_id');
        $promotionAmount = session()->get('promotion_amount');

        if (!$user || !$petId || !$promotionAmount) {
            return redirect()->route('f.promote.stripe.cancel')->with('error', 'Payment session expired or invalid.');
        }

        try {
            $pet = Pet::findOrFail($petId);
            \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));
            $response = \Stripe\Checkout\Session::retrieve($request->session_id);

            if ($response->payment_status == 'paid') {
                PromotePayment::create([
                    'user_id' => $user->id,
                    'transaction_id' => $response->id,
                    'amount' => $promotionAmount,
                    'currency' => strtoupper($response->currency),
                    'status' => 'COMPLETED',
                    'payment_gateway' => 'Stripe',
                    'description' => 'Pet Promotion for ' . $pet->name,
                    'pet_id' => $pet->id, 
                ]);

                // Send email to user
                Mail::to($user->email)->send(new PetPromotionSuccessMail($pet, $promotionAmount));

                // Send email to admin
                // HIGHLIGHT START
                Mail::to(config('mail.from.address'))->send(new PetPromotionSuccessMail($pet, $promotionAmount));
                // HIGHLIGHT END
                
                session()->forget(['promotion_pet_id', 'promotion_amount', 'promotion_name']);
                return to_route('f.petlisting')->with('success', 'Pet promotion successful!');
            } else {
                // Payment not successful according to Stripe
                Mail::to($user->email)->send(new FailedPaymentEmail($pet));
                return redirect()->route('f.promote.stripe.cancel')->with('error', 'Stripe payment was not successful.');
            }
        } catch (\Exception $e) {
            Mail::to($user->email)->send(new FailedPaymentEmail($pet ?? null));
            return redirect()->route('f.promote.stripe.cancel')->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    /**
     * Handle Stripe payment cancellation for pet promotion.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelStripe()
    {
        session()->forget(['promotion_pet_id', 'promotion_amount', 'promotion_name']);
        return redirect()->route('f.petlisting')->with('error', 'Stripe payment cancelled for pet promotion.');
    }

    /**
     * Handle successful PayPal payment for pet promotion.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successPaypal(Request $request)
    {
        $user = Auth::user();
        $petId = session()->get('promotion_pet_id');
        $promotionAmount = session()->get('promotion_amount');

        if (!$user || !$petId || !$promotionAmount) {
            return redirect()->route('f.promote.paypal.cancel')->with('error', 'Payment session expired or invalid.');
        }

        try {
            $pet = Pet::findOrFail($petId);
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {

                PromotePayment::create([
                    'user_id' => $user->id,
                    'transaction_id' => $response['id'],
                    'amount' => $promotionAmount,
                    'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'] ?? 'USD',
                    'status' => 'COMPLETED',
                    'payment_gateway' => 'Paypal',
                    'description' => 'Pet Promotion for ' . $pet->name,
                    'pet_id' => $pet->id,
                ]);

                // Send email to user
                Mail::to($user->email)->send(new PetPromotionSuccessMail($pet, $promotionAmount));

                // Send email to admin
                // HIGHLIGHT START
                Mail::to(config('mail.from.address'))->send(new PetPromotionSuccessMail($pet, $promotionAmount));
                // HIGHLIGHT END

                session()->forget(['promotion_pet_id', 'promotion_amount', 'promotion_name']);
                return to_route('f.petlisting')->with('success', 'Pet promotion successful!');
            } else {
                // Payment not successful according to PayPal
                Mail::to($user->email)->send(new FailedPaymentEmail($pet));
                return redirect()->route('f.promote.paypal.cancel')->with('error', $response['message'] ?? 'PayPal payment was not successful.');
            }
        } catch (\Exception $e) {
            Mail::to($user->email)->send(new FailedPaymentEmail($pet ?? null));
            return redirect()->route('f.promote.paypal.cancel')->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    /**
     * Handle PayPal payment cancellation for pet promotion.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelPaypal()
    {
        session()->forget(['promotion_pet_id', 'promotion_amount', 'promotion_name']);
        return redirect()->route('f.petlisting')->with('error', 'PayPal payment cancelled for pet promotion.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FailedPaymentEmail;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // return $request->all();

        $plan = SubscriptionPlan::findorfail($request->plan_id);

        session()->put('plan_id', $request->plan_id);

        if ($request->payment_method === 'stripe') {

            \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));
            // $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $lineItems = [];




            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                    'unit_amount' => $plan->price * 100,
                ],
                'quantity' => 1,
            ];



            // $response = $stripe->checkout->sessions->create([
            $response =  \Stripe\Checkout\Session::create([

                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);

            return redirect($response->url);
        } elseif ($request->payment_method === 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.payment.success'),
                    "cancel_url" => route('paypal.payment.cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $plan->price,
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        // session()->put('product_name', $request->product_name);
                        // session()->put('quantity', $request->quantity);
                        return redirect()->away($link['href']);
                    }
                }
                 Mail::to($user->email)->send(new FailedPaymentEmail($plan));
                return redirect()

                    ->route('cancel.payment')

                    ->with('error', 'Something went wrong.');
            } else {

                return redirect()

                    ->route('create.payment')

                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        } else {
            return "casho on delivery";
        }
    }

    public function cancelStripe()

    {

        return redirect()

            ->route('f.subscription');

            
    }

    public function paymentSuccessPaypal(Request $request)

    {

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);

        $user = Auth::user();
        $planId = session()->get('plan_id');
        $plan = SubscriptionPlan::findorfail($planId);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $orderCreate = Payment::create([
                'user_id' =>  $user->id,
                'transaction_id' => $response->id,
                'amount' => $plan->price,
                'currency' => $response->currency,
                'subscription_plan_id' => session()->get('plan_id'),
                'status' => $response->status,
                'payment_gateway' => 'Paypal',

            ]);

            $user->update([
                'spotlight' => $user->spotlight + $plan->spotlight,
            ]);

            $subscriptions = Subscription::where('user_id',  $user->id)->first();

            if ($subscriptions) {
                $subscriptions->update([
                    'subscription_plan_id' => $plan->id,
                    'end_date' => $plan->duration_type === 'day'
                        ? \Carbon\Carbon::parse($subscriptions->end_date)->addDays($plan->duration)
                        : \Carbon\Carbon::parse($subscriptions->end_date)->addMonths($plan->duration),
                    // 'end_date' => \Carbon\Carbon::parse($subscriptions->end_date)->addMonths($plan->duration),
                ]);
            } else {
                Subscription::create([
                    'user_id' => $user->id,
                    'subscription_plan_id' => $plan->id,
                    'start_date' => now(),
                    'end_date' => $plan->type === 'day'
                        ? now()->addDays($plan->duration)
                        : now()->addMonths($plan->duration),
                ]);
            }
 Mail::to($user->email)->send(new PaymentSuccessMail($plan));
            return redirect()

                ->route('paypal')

                ->with('success', 'Transaction complete.');
        } else {
             Mail::to($user->email)->send(new FailedPaymentEmail($plan));

            return redirect()

                ->route('paypal')

                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successStripe(Request $request)
    {
        $user = Auth::user();
        $planId = session()->get('plan_id');
        $plan = SubscriptionPlan::findorfail($planId);

        if (isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //dd($response);

            $orderCreate = Payment::create([
                'user_id' =>  $user->id,
                'transaction_id' => $response->id,
                'amount' => $plan->price,
                'currency' => $response->currency,
                'subscription_plan_id' => session()->get('plan_id'),
                'status' => $response->status,
                'payment_gateway' => 'Stripe',

            ]);

            $user->update([
                'spotlight' => $user->spotlight + $plan->spotlight,
            ]);

            $subscriptions = Subscription::where('user_id',  $user->id)->first();

            // if ($subscriptions) {
            //     $subscriptions->update([
            //         'subscription_plan_id' => $plan->id,
            //         'end_date' => \Carbon\Carbon::parse($subscriptions->end_date)->addMonths($plan->duration),
            //     ]);
            // } else {
            //     Subscription::create([
            //         'user_id' => $user->id,
            //         'subscription_plan_id' => $plan->id,
            //         'start_date' => now(),
            //         'end_date' => now()->addMonths($plan->duration),
            //     ]);
            // }

            if ($subscriptions) {
                $subscriptions->update([
                    'subscription_plan_id' => $plan->id,
                    'end_date' => $plan->duration_type === 'day'
                        ? \Carbon\Carbon::parse($subscriptions->end_date)->addDays($plan->duration)
                        : \Carbon\Carbon::parse($subscriptions->end_date)->addMonths($plan->duration),
                    // 'end_date' => \Carbon\Carbon::parse($subscriptions->end_date)->addMonths($plan->duration),
                ]);
            } else {
                Subscription::create([
                    'user_id' => $user->id,
                    'subscription_plan_id' => $plan->id,
                    'start_date' => now(),
                    'end_date' => $plan->type === 'day'
                        ? now()->addDays($plan->duration)
                        : now()->addMonths($plan->duration),
                ]);
            }

 Mail::to($user->email)->send(new PaymentSuccessMail($plan));
            
            session()->forget('plan_id');


            // return to_route('f.dashboard');
            return to_route('f.subscription');
        } else {
             Mail::to($user->email)->send(new FailedPaymentEmail($plan));
            return redirect()->route('stripe.cancel');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Invoice;

use Stripe\Stripe as StripeGateway;

class StripeController extends Controller
{
    //

    public function initiatePayment(Request $request){
    StripeGateway::setApiKey(env('STRIPE_SECRET_KEY'));  //

    try {
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount*100, // Multiply as & when required
            'currency' => 'cad',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        // $invoice = Invoice::find($request->invoice_id);
        // $invoice->payment_id = $request->$paymentIntent->id;
        // $invoice->save();
        // Save the $paymentIntent->id to identify this payment later

    } catch (Exception $e) {
        // throw error
    }

    return [
        'token' => (string) Str::uuid(),
        'client_secret' => $paymentIntent->client_secret
    ];
}

public function completePayment(Request $request)
{
    // $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

    // // Use the payment intent ID stored when initiating payment
    // $paymentDetail = $stripe->paymentIntents->retrieve($request->payment_id);

    // if ($paymentDetail->status != 'succeeded') {
    //     // throw error
    //     return response()->json(["payment status"=>$paymentDetail->status]);

    // }

    // $invoice = Invoice::find($request->invoice_id);
    // $invoice->payment_id = $request->payment_id;
    // $invoice->payment_status = 'Paid';
    // $invoice->save();
    return inertia('Payment/PaymentSuccess');


    // Complete the payment
}
}

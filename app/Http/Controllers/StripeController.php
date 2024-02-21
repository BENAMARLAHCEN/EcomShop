<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
        ]);

        $user = Auth::user();

        $cart = $user->cart;

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $lineItems = [];
        foreach ($cart->cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->name
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        session()->put('address', $request->address);
        session()->put('quantity', 4);
        session()->put('session_id', $session->id);

        return redirect($session->url);
    }
   


    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException();
            }
            $customer = \Stripe\Customer::retrieve($session->customer);

            
            OrderController::Order(session()->get('address'));

            $obj = new Payment;
            $obj->payment_id = $sessionId;
            $obj->numero_serie = $session->description;
            $obj->quantity = session()->get('quantity');
            $obj->amount = >amount->value;
            $obj->currency = >amount->currency;
            $obj->payment_status = "Completed";
            $obj->payment_method = "Mollie";
            $obj->user_id = 3;

            $obj->save();

            session()->forget('quantity');
            session()->forget('address');

            return view('product.checkout-success', compact('customer'));
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

    }


    public function cancel()
    {
        echo "Payment is cancelled.";
    }
}

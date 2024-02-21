<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function mollie(Request $request)
    {
        // $products_quantites = array_combine($request->produits, $request->qte);
        $request->validate([
            'address' => 'required|string',
        ]);

        $user = Auth::user();

        $cart = $user->cart;

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cart->cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $totalAmount = number_format($totalAmount, 2, '.', '');
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "USD",
                "value" => $totalAmount,
            ],
            "description" => "product_name",
            "redirectUrl" => route('success'),
        ]);

        //dd($payment);

        session()->put('paymentId', $payment->id);
        session()->put('quantity', 3);
        session()->put('address', $request->address);
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {
        $paymentId = session()->get('paymentId');
        //dd($paymentId);
        $payment = Mollie::api()->payments->get($paymentId);
        //dd($payment);
        if ($payment->isPaid()) {

            OrderController::Order(session()->get('address'));

            $obj = new Payment();
            $obj->payment_id = $paymentId;
            $obj->numero_serie = $payment->description;
            $obj->quantity = session()->get('quantity');
            $obj->amount = $payment->amount->value;
            $obj->currency = $payment->amount->currency;
            $obj->payment_status = "Completed";
            $obj->payment_method = "Mollie";
            $obj->user_id = Auth::id();

            $obj->save();

            session()->forget('paymentId');
            session()->forget('quantity');
            session()->forget('address');

            return redirect('/')->with('success', 'your order is completed');
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        echo "Payment is cancelled.";
    }
}

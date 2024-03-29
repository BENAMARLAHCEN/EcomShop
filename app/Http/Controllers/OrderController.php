<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.palce');
    }

    public function show()
    {

        $user = Auth::user();
        $orders = $user->orders()->latest()->get(); 
        return view('order.index', compact('orders'));
    }



    public static function Order($address)
    {
        $user = Auth::user();

        $cart = $user->cart;

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cart->cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
        $totalAmount = number_format($totalAmount, 2,'.','');

        $order = new Order([
            'user_id' => $user->id,
            'address' => $address,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        $order->save();

        foreach ($cart->cartItems as $cartItem) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
            $orderItem->save();
        }

        $cart->cartItems()->delete();
    }
}

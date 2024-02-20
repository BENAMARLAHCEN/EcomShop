<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        $cartItem = $cart->cartItems()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cart->cartItems()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $cart->cartItems()->where('product_id', $request->product_id)->delete();
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function updateCartItemQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $cart->cartItems()->where('product_id', $request->product_id)
                ->update(['quantity' => $request->quantity]);
        }

        return redirect()->back()->with('success', 'Cart item quantity updated successfully.');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cartItems = [];
        } else {
            $cartItems = $cart->cartItems()->with('product')->get();
        }

        return view('cart.show', compact('cartItems'));
    }

    public function clearCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $cart->cartItems()->delete();
        }

        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
}

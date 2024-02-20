@extends('layout.app')

@section('content')
<div class="bg-gray-100 h-screen py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    @if ($cartItems->isEmpty())
                        <p class="text-gray-500">Your cart is empty.</p>
                    @else
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left font-semibold">Product</th>
                                    <th class="text-left font-semibold">Price</th>
                                    <th class="text-left font-semibold">Quantity</th>
                                    <th class="text-left font-semibold">Total</th>
                                    <th class="text-left font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cartItem)
                                    <tr>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img class="h-16 w-16 mr-4" src="/storage/{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }} image">
                                                <span class="font-semibold">{{ $cartItem->product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4">{{ $cartItem->product->price }}</td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $cartItem->product_id }}">
                                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="w-16 border rounded-md py-1 px-2">
                                                    <button type="submit" class="ml-2 bg-blue-500 text-white py-1 px-4 rounded-md">Update</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="py-4">{{ $cartItem->product->price * $cartItem->quantity }}</td>
                                        <td class="py-4">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cartItem->product_id }}">
                                                <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded-md">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ $cartItems->sum(function ($cartItem) { return $cartItem->product->price * $cartItem->quantity; }) }}</span>
                    </div>
                    <!-- Add more summary details as needed -->
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">${{ $cartItems->sum(function ($cartItem) { return $cartItem->product->price * $cartItem->quantity; }) }}</span>
                    </div>
                    <a href="{{route('orders.index')}}" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

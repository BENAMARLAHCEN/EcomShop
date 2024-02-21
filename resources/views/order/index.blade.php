@extends('layout.app')

@section('content')
<div class="bg-gray-100  py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">My Orders</h1>
        @foreach ($orders as $order)
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <h2 class="text-lg font-semibold mb-2">Order ID: {{ $order->id }}</h2>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left font-semibold">Product</th>
                            <th class="text-left font-semibold">Price</th>
                            <th class="text-left font-semibold">Quantity</th>
                            <th class="text-left font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItem as $orderItem)
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4" src="/storage/{{ $orderItem->product->image }}" alt="{{ $orderItem->product->name }} image">
                                        <span class="font-semibold">{{ $orderItem->product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4">${{ $orderItem->price }}</td>
                                <td class="py-4">{{ $orderItem->quantity }}</td>
                                <td class="py-4">${{ $orderItem->price * $orderItem->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr class="my-4">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Order Total:</span>
                    <span class="font-semibold">${{ $order->total_amount }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Order Status:</span>
                    <span class="font-semibold">{{ $order->status }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
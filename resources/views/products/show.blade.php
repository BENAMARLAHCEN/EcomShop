@extends('layout.app')

@section('content')
    <main class="my-8">
        <div class="container mx-auto px-6">
            <div class="md:flex md:items-center">
                <div class="w-full h-64 md:w-1/2 lg:h-96">
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="/storage/{{$product->image}}"
                        alt="{{ $product->name }}">
                </div>
                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-700 uppercase text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-700 text-lg ">{{ $product->description }}</p>
                    <span class="text-gray-500 mt-3">${{ $product->price }}</span>
                    <hr class="my-3">
                    <form action="{{ route('cart.add') }}" method="POST">
                        <div class="mt-2">
                            <label class="text-gray-700 text-sm" for="count">Count:</label>
                            <div class="flex items-center mt-1">
                                <input type="number" name="quantity" value="1" min="1"
                                    class="w-16 border rounded-md py-1 px-2">
                            </div>
                        </div>

                        <div class="flex items-center mt-6">

                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Add
                                to Cart</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">More Products</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    <!-- Product suggestions -->
                </div>
            </div>
        </div>
    </main>
@endsection

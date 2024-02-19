@extends('layout.app')

@section('content')
    <section class="py-20 bg-gray-50 font-poppins dark:bg-gray-800 ">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <!-- Filter options for vegetables and fruits can go here -->
            
            <div class="flex flex-wrap items-center ">
                @foreach($products as $product)
                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                    <div class="border border-gray-300 dark:border-gray-700">
                        <div class="relative bg-gray-200">
                            <a href="#" class="">
                                {{-- <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto "> --}}
                            </a>
                        </div>
                        <div class="p-3 ">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <h3 class="text-xl font-medium dark:text-gray-400">
                                    {{ $product->name }}
                                </h3>
                                <!-- Rating stars can go here -->
                            </div>
                            <p class="text-lg ">
                                {{-- <span class="text-green-600 dark:text-green-600">${{ $product->price }}</span> --}}
                            </p>
                        </div>
                        <div class="flex justify-between p-4 border-t border-gray-300 dark:border-gray-700">
                            <!-- Action buttons like favorite, add to cart, view can go here -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Pagination can go here -->
        </div>
    </section>
@endsection

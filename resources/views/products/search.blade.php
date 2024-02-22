@extends('layout.app')

@section('content')
    <div class="bg-white">
        <div x-data="{ open: false }" @keydown.window.escape="open = false">
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">Vegetables & Fruits</h1>
                    <div class="flex items-center">
                        <div id="search-bar" class="w-120 bg-white rounded-md shadow-lg z-10">

                            <div class="flex items-center justify-center p-2">
                                <input type="text" name='q' placeholder="Search here" id="search"
                                    class="w-full rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent">
                                <button type="submit"
                                    class="bg-gray-800 text-white rounded-md px-4 py-1 ml-2 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                                    Search
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                <section aria-labelledby="products-heading" class="pt-6 pb-24">
                    <h2 id="products-heading" class="sr-only">Vegetables & Fruits</h2>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">

                        <div class="hidden lg:block">
                            <h3 class="mb-3">Categories:</h3>

                            <ul role="list"
                                class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
                                @if (!empty($categories))
                                    @foreach ($categories as $category)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" attr-name="{{ $category->name }}"
                                                class="custom-control-input category_checkbox" id="{{ $category->id }}">
                                            <label class="custom-control-label"
                                                for="{{ $category->id }}">{{ ucfirst($category->name) }}</label>
                                        </div>
                                    @endforeach
                                @endif

                            </ul>
                            
                        </div>

                        <div class="lg:col-span-3">
                            @if (request()->input())
                                <h6>{{ $products->total() }} result of your search "{{ request()->q }}"</h6>
                            @endif
                            <div id="placeSearchResult"
                                class="grid grid-cols-6 sm:grid-cols-5 md:grid-cols-3 lg:grid-cols-3 gap-4">

                                @foreach ($products as $product)
                                    <div class="p-1">
                                        <x-product-card :product="$product"></x-product-card>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function search() {

            var keyword = document.getElementById('search').value;

            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            var xhr = new XMLHttpRequest();

            xhr.open('GET', '/search?keyword=' + keyword, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var data = JSON.parse(xhr.responseText);
                    console.log(data);
                    table_post_row(data.products);

                } else {
                    console.error('Request failed with status', xhr.status);
                }
            };

            xhr.onerror = function() {
                console.error('Request failed');
            };

            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('search');
            searchInput.addEventListener('keyup', function(event) {



                search();

            });
        });


        function table_post_row(products) {
            let htmlView = '';
            if (products.length <= 0) {
                htmlView += `<tr><td colspan="4"> 0 result </td></tr>`;
            } else {
                products.forEach(product => {
                    htmlView += `
                <div class="w-full h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="/products/${product.name}">
                        <img class="p-8 rounded-t-lg" src="/storage/${product.image}" alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="/products/${product.name}">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">${product.name}</h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5" id="productRating">
                            <!-- Insert rating stars dynamically -->
                            <!-- This part can be filled based on your product data -->
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">$${product.price}</span>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="${product.id}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            `;
                });
            }
            document.querySelector('#placeSearchResult').innerHTML = htmlView;
        }
    </script>



    <script>
        $(document).ready(function() {
            $(document).on('click', '.category_checkbox', function() {

                var ids = [];

                var counter = 0;
                $('#catFilters').empty();
                $('.category_checkbox').each(function() {
                    if ($(this).is(":checked")) {
                        ids.push($(this).attr('id'));
                        counter++;
                    }
                });

                if (counter == 0) {
                    console.log('No Data Found');
                    fetchCauseAgainstCategory('');
                } else {
                    fetchCauseAgainstCategory(ids);
                }
            });
        });

    
        function fetchCauseAgainstCategory(id) {
    $.ajax({
        type: 'GET',
        url: '/search/' + id,
        headers: {
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        dataType: 'json', 
        success: function(response) {
            console.log(response);

            if (response.length == 0) {
                console.log('No Data Found');
            } else {
                table_post_row(response.products);
            }
        }
    });
}

    </script>
@endsection

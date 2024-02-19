@extends('layout.app')

@section('content')

<div class="bg-gray-100 dark:bg-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                    <img class="w-full h-full object-cover" src="https://via.placeholder.com/600x400.png?text=Orange" alt="Orange Image">
                </div>
                <div class="flex -mx-2 mb-4">
                    <div class="w-1/2 px-2">
                        <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-full font-bold">Add to Cart</button>
                    </div>
                    <div class="w-1/2 px-2">
                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full font-bold">Add to Wishlist</button>
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Organic Legumes Mix</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                    Enjoy the goodness of our organic legumes mix. Packed with essential nutrients and proteins, it's perfect for your healthy lifestyle.
                </p>
                <div class="flex mb-4">
                    <div class="mr-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Price:</span>
                        <span class="text-gray-600 dark:text-gray-300">$29.99</span>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                        <span class="text-gray-600 dark:text-gray-300">In Stock</span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Select Quantity:</span>
                    <div class="flex items-center mt-2">
                        <button id="decrementBtn" class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-l-lg font-bold mr-1 hover:bg-gray-400 dark:hover:bg-gray-600">-</button>
                        <input id="quantityInput" type="text" value="1" class="w-12 text-center border border-gray-400 rounded-none py-2" readonly>
                        <button id="incrementBtn" class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-r-lg font-bold ml-1 hover:bg-gray-400 dark:hover:bg-gray-600">+</button>
                    </div>
                </div>
                
                <div class="mb-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Rating:</span>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-400">&#9733;</span>
                        <span class="text-yellow-400">&#9733;</span>
                        <span class="text-yellow-400">&#9733;</span>
                        <span class="text-yellow-400">&#9733;</span>
                        <span class="text-gray-400">&#9733;</span>
                    </div>
                </div>
                
                <div>
                    <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                        Our organic legumes mix is a blend of various nutritious legumes, including lentils, chickpeas, and beans. Whether you're making soups, salads, or side dishes, our legumes mix adds a healthy and delicious touch to your meals. Rich in fiber, vitamins, and minerals, it's a must-have for any health-conscious individual.
                    </p>
                </div>
                <div class="mt-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Additional Information:</span>
                    <ul class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                        <li>Weight: 500g</li>
                        <li>Origin: Organic farms</li>
                        <li>Storage: Keep in a cool, dry place</li>
                        <li>Expiration Date: DD/MM/YYYY</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<div class="bg-gray-100 dark:bg-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Related Product Card -->
            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg overflow-hidden">
                <img class="w-full h-40 object-cover" src="https://via.placeholder.com/300x200.png?text=Related+Product+1" alt="Related Product 1">
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 dark:text-white">Related Product 1</h3>
                    <p class="text-gray-600 dark:text-gray-300">$19.99</p>
                    <button class="mt-2 w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-full font-bold">Add to Cart</button>
                </div>
            </div>
            <!-- Add more related product cards here -->
        </div>
    </div>
</div>

<script>
    // Get elements
    const decrementBtn = document.getElementById('decrementBtn');
    const incrementBtn = document.getElementById('incrementBtn');
    const quantityInput = document.getElementById('quantityInput');

    // Add event listeners
    decrementBtn.addEventListener('click', decrement);
    incrementBtn.addEventListener('click', increment);

    // Functions
    function decrement() {
        const currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }

    function increment() {
        const currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    }
</script>

@endsection

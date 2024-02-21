<header
    class="text-slate-700 relative flex max-w-screen-xl flex-col overflow-hidden px-4 py-4 lg:mx-auto lg:flex-row lg:items-center">
    <a href="/" class="flex items-center whitespace-nowrap text-2xl font-black">
        <span class="mr-2 w-9">
            <img src="/storage/images/ecomshop.png" alt="logo" />
        </span>
        EcomShop
    </a>
    <input type="checkbox" class="peer hidden" id="navbar-open" achecked />
    <label class="absolute top-5 right-5 cursor-pointer lg:hidden" for="navbar-open">
        <span class="sr-only">Toggle Navigation</span>
        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </label>
    <nav aria-label="Header Navigation"
        class="peer-checked:pt-8 peer-checked:max-h-60 flex max-h-0 w-full flex-col items-center overflow-hidden transition-all lg:ml-24 lg:max-h-full lg:flex-row">
        <ul class="flex w-full flex-col items-center space-y-2 lg:flex-row lg:justify-center lg:space-y-0">
            <li class="lg:mr-12"><a
                    class="rounded text-gray-700 transition focus:outline-none focus:ring-1 focus:ring-blue-700 focus:ring-offset-2"
                    href="/">Home</a></li>
            <li class="lg:mr-12"><a
                    class="rounded text-gray-700 transition focus:outline-none focus:ring-1 focus:ring-blue-700 focus:ring-offset-2"
                    href="filter">Our Products</a></li>
            <li class="lg:mr-12"><a
                    class="rounded text-gray-700 transition focus:outline-none focus:ring-1 focus:ring-blue-700 focus:ring-offset-2"
                    href="contact">Contact</a></li>
            <li class="lg:mr-12"><a
                    class="rounded text-gray-700 transition focus:outline-none focus:ring-1 focus:ring-blue-700 focus:ring-offset-2"
                    href="#">FAQ</a></li>
        </ul>
        <hr class="mt-4 w-full lg:hidden" />
        <div class="my-4 flex items-center space-x-6 space-y-2 lg:my-0 lg:ml-auto lg:space-x-8 lg:space-y-0">
            @auth
                <a href="/cart" class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </a>
                <form action="{{route('logout')}}" method="post">
                  @csrf
                  <button class="px-3  py-3 text-sm font-medium flex items-center space-x-2 hover:bg-slate-400">
                    <span>
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
                    </span>
                    <span> Logout </span>
                  </button>
                </form>
            @else
                <a href="/login" title=""
                    class="whitespace-nowrap rounded font-medium transition-all duration-200 focus:outline-none focus:ring-1 focus:ring-blue-700 focus:ring-offset-2 hover:text-opacity-50">
                    Log in </a>
                <a href="/register" title=""
                    class="whitespace-nowrap rounded-xl bg-blue-700 px-5 py-3 font-medium text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2 hover:bg-blue-600">Get
                    free trial</a>
            @endauth

        </div>
    </nav>
</header>

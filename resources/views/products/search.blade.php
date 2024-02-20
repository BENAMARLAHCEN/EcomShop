@extends('layout.app')

@section('content')
    <div class="bg-white">
        <div x-data="{ open: false }" @keydown.window.escape="open = false">
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">Vegetables & Fruits</h1>
                    <div class="flex items-center">
                        <div id="search-bar" class="w-120 bg-white rounded-md shadow-lg z-10">

                            <form class="flex items-center justify-center p-2">
                                <input type="text" name='q' placeholder="Search here" id="search"
                                    class="w-full rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent">
                                <button type="submit"
                                    class="bg-gray-800 text-white rounded-md px-4 py-1 ml-2 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                                    Search
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
                <section aria-labelledby="products-heading" class="pt-6 pb-24">
                    <h2 id="products-heading" class="sr-only">Vegetables & Fruits</h2>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <form class="hidden lg:block">
                            <ul role="list" class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
                                
                                {{-- @foreach($categories as $category)
                                    <li>
                                        <a href="#" x-on:click="filterByCategory('{{ $category->name }}')">{{ $category->name }}</a>
                                    </li>
                                @endforeach --}}
                            </ul>
                            <div x-data="{ open: false }" class="border-b border-gray-200 py-6">
                                <h3 class="-my-3 flow-root">
                                    <button type="button" x-description="Expand/collapse section button" class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                        aria-controls="filter-section-0" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                                        <span class="font-medium text-gray-900">Category</span>
                                        <span class="ml-6 flex items-center">
                                            <svg class="h-5 w-5" x-description="Expand icon, show/hide based on section open state. Heroicon name: mini/plus" x-show="!(open)" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z">
                                                </path>
                                            </svg>
                                            <svg class="h-5 w-5" x-description="Collapse icon, show/hide based on section open state. Heroicon name: mini/minus" x-show="open" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </h3>
                                <div class="pt-6" x-description="Filter section, show/hide based on section state." id="filter-section-0" x-show="open">
                                    <div class="space-y-4">
                                        
                                        <div class="flex items-center" x-for="(item, index) in filteredItems" :key="index">
                                            <input :id="'filter-section-0-' + index" :name="item.name" :value="item.value" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label :for="'filter-section-0-' + index" class="ml-3 text-sm text-gray-600" x-text="item.label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <div class="lg:col-span-3">
                            @if(request()->input())
                            <h6>{{ $products->total()}} result of your search "{{request()->q}}"</h6>
                        @endif
                            <div class="grid grid-cols-6 sm:grid-cols-5 md:grid-cols-3 lg:grid-cols-3 gap-4">
                               
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $('#search').on('keyup', function(){
            search();
        });
        search();
        function search(){
             var keyword = $('#search').val();
             $.post('products.search',
              {
                 _token: $('meta[name="csrf-token"]').attr('content'),
                 keyword:keyword
               },
               function(data){
                table_post_row(data);
                  console.log(data);
               });
        }
        // table row with ajax
        function table_post_row(res){
        let htmlView = '';
        if(res.products.length <= 0){
            htmlView+= `
               <tr>
                  <td colspan="4">No data.</td>
              </tr>`;
        }
        for(let i = 0; i < res.products.length; i++){
            htmlView += `
                <tr>
                   <td>`+ (i+1) +`</td>
                      <td>`+res.products[i].name+`</td>
                       <td>`+res.products[i].phone+`</td>
                </tr>`;
        }
             $('tbody').html(htmlView);
        }
        </script>    
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('products.search',compact('products','categories')); 
    }

    public function search(Request $request)
{
    $products = Product::query();

    if ($request->keyword) {
        $products->where('name', 'LIKE', '%' . $request->keyword . '%');
    }

    if ($request->category) {
        $products->whereIn('category_id', $request->category);
    }

    $filteredProducts = $products->get();

    return response()->json(['products' => $filteredProducts]);
}
}

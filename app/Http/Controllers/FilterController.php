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
        $products = Product::all();
        if($request->keyword !=''){
            $products = Product::where('name','LIKE','%'.$request->keyword.'%')->get();
        }
        return response()->json([
            'products' => $products
        ]);

        // $products = Product::where('name', 'like', "%$query%")
        //         ->paginate(6);
        //         return view('products.search')->with('products', $products);
    }

}

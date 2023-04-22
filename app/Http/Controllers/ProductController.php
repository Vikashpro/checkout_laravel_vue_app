<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        return inertia('Product/Index',['products'=>Product::where('checkout_page','course')->get()]);
    }
    public function all_products()
    {
        return inertia('Product/AllProducts', ['products'=>Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        
    }
    public function product_checkout(){
        $products = Product::where('checkout_page','product')->get();
        $products = $products->map(function ($product) {
            $product->quantity = 0;
            $product->pr = 0; // or any other value you want to set
            return $product;
        });
        
        
        return inertia('Product/ProductCheckout',['products'=>$products]);

    }
    public function getProducts(){
        return response()->json(['products'=>Product::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->checkout_page = $request->checkout_page;
        $product->save();

        return inertia('Product/AllProducts', ['products'=>Product::all()])->with('success','Product created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

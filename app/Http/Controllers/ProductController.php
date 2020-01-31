<?php

namespace App\Http\Controllers;

use App\Product;
use App\Attribute;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Auth;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::join('categories', 'categories.id', '=', 'products.productCategories')
                            ->join('productvariations','productvariations.productId','=','products.id')
                            ->select('products.*', 'categories.name','productvariations.*')
                            ->where('products.sellerId',Auth::user()->id)
                            ->get();
        // print_r($products);
        // die();
        return view('seller.all_product',['products'=>$products]);
    }
    
    public function addNew()
    {
        $categories=Category::get();
        return view('seller.add_product',['categories'=>$categories]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Product::insert([
            'productTitle'=>$request->title,
            'productShortDescreption'=>$request->short_descreption,
            'productDescreption'=>$request->descreption,
            'productVariations'=>NULL,
            'productCategories'=>$request->category,
            'sellerId'=>Auth::user()->id
        ]);
        return redirect()->back()->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

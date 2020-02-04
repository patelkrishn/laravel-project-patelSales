<?php

namespace App\Http\Controllers;

use App\Product;
use App\Attribute;
use App\Category;
use App\ProductVariation;
use Illuminate\Http\Request;
use DB;
use Auth;
class ProductController extends Controller
{
    protected $notificationsCount;
    public function __construct()
    {
        
    }
    public function notifications()
    {
        $notifications=app('App\Http\Controllers\NotificationController')->getSellerNotifications(Auth::user()->id);
        $this->notificationsCount=app('App\Http\Controllers\NotificationController')->getSellerNotificationCount(Auth::user()->id);
        return $notifications;
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
        return view('seller.all_product',['products'=>$products,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
    }
    
    public function addNew()
    {
        $categories=Category::get();
        return view('seller.add_product',['categories'=>$categories,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
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
    public function edit(Request $request)
    {
        $products=ProductVariation::join('products','productvariations.productId','=','products.id')
                                    ->join('categories','categories.id','=','products.productCategories')
                                    ->where('productvariations.id',$request->id)
                                    ->first();
        $categories=Category::get();
        // dd($products);
        return view('seller.productsDetails',['id'=>$request->id,'categories'=>$categories,'products'=>$products,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
    }

    public function editProduct(Request $request,$id)
    {
        $products=ProductVariation::join('products','productvariations.productId','=','products.id')
                                    ->join('categories','categories.id','=','products.productCategories')
                                    ->where('productvariations.id',$id)
                                    ->first();
        $proId=ProductVariation::join('products','productvariations.productId','=','products.id')
                                    ->join('categories','categories.id','=','products.productCategories')
                                    ->select('products.id')
                                    ->where('productvariations.id',$id)
                                    ->first();
        $categories=Category::get();
        $productId=$proId->id;
        $colorAttributes=Attribute::join('products','attributes.productId','=','products.id')
                                        ->select('attributes.*')
                                        ->where(['products.id'=>$productId,'attributes.type'=>'color'])
                                        ->get();
        $sizeAttributes=Attribute::join('products','attributes.productId','=','products.id')
                                        ->select('attributes.*')
                                        ->where(['products.id'=>$productId,'attributes.type'=>'size'])
                                        ->get();
        // dd($products);
        return view('seller.productsDetails',['id'=>$id,'productId'=>$productId,'sizeAttributes'=>$sizeAttributes,'colorAttributes'=>$colorAttributes,'categories'=>$categories,'products'=>$products,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
    }
    public function updateProduct(Request $request,$id)
    {
        // dd($id);
        Product::where('id',$request->productId)->update([
            'productTitle'=>$request->productTitle,
            'productShortDescreption'=>$request->productShortDescreption,
            'productDescreption'=>$request->productDescreption,
            'productCategories'=>$request->productCategories,
        ]);
        if ($request->sale_price == 0 || $request->sale_price == NULL ) {
            $onsale=0;
        }else {
            $onsale=1;
        }
        if ($request->quantity == 0) {
            $stockStatus=0;
        }else{
            $stockStatus=1;
        }
        ProductVariation::where('id',$id)->update([
                        'productId'=>$request->productId,
                        // 'productImage'=>$path,
                        'size'=>$request->size,
                        'color'=>$request->color,
                        'productPrice'=>$request->price,
                        'salePrice'=>$request->sale_price,
                        'productCoupenCode'=>$request->coupen_code,
                        'discountAmount'=>$request->discount_amount,
                        'onsale'=>$onsale,
                        'sku'=>$request->sku,
                        'stockQuantity'=>$request->quantity,
                        'stockStatus'=>$stockStatus,
                        'totalSales'=>0
        ]);
        return redirect()->back()->with('success', 'Product update successfully');
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

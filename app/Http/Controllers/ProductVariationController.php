<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductVariation;
use App\Product;
use App\Attribute;
use Auth;

class ProductVariationController extends Controller
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
        $products=Product::where('sellerId',Auth::user()->id)->get();
        return view('seller.variations',['products'=>$products,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
    }
    
    /**
     * this function is use for get attribute data for product variations page.
     * this function return data using Ajax.
     */
    public function getAttributeForVariations(Request $request)
    {
        $colors=Attribute::where(['type'=>'color','productId'=>$request->id])->get();
        $sizes=Attribute::where(['type'=>'size','productId'=>$request->id])->get();
        $output="<div class='row'><div class='col-md-4'>";
        $output.='
            <div class="form-group">
                <label>Choose color attribute</label>
                <select class="form-control" name="color">
                    <option value="">Select...</option>';
                    foreach ($colors as $color)
                    {
                        $output.='<option value="'.$color->name.'">'.$color->name.'</option>';
                    }
        $output.='  </select>
            </div>
            </div>
        ';
        $output.='
        <div class="col-md-4">
            <div class="form-group">
                <label>Choose size attribute</label>
                <select class="form-control" name="size">
                    <option value="">Select...</option>';
                    foreach ($sizes as $size)
                    {
                        $output.='<option value="'.$size->name.'">'.$size->name.'</option>';
                    }
        $output.='  </select>
            </div>
            </div>
            </div>
        ';
        echo $output;
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
            $request->validate([
                'price' => 'required',
                'productId'=>'required',
                'image'=>'required|image|mimes:jpeg,gif,bmp,png',
                'sku'=>'required',
                'quantity'=>'required',
            ]);
            if ($request->hasFile('image')) {
                $image=$request->file('image');
                $new_name = Auth::user()->id.'_'.time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $path='images/'.$new_name;
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
                $insertId=ProductVariation::insertGetId(
                    [
                        'productId'=>$request->productId,
                        'productImage'=>$path,
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
                    ]
                );
                Product::where('id',$request->productId)->update(['productVariations'=>$insertId]);
                return redirect()->back()->with('success', 'Product variations set successfully');
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function show($productVariation)
    {
        $products=Product::join('categories', 'categories.id', '=', 'products.productCategories')
                            ->join('productvariations','productvariations.productId','=','products.id')
                            ->select('products.*', 'categories.name','productvariations.*')
                            ->where(['products.sellerId'=>Auth::user()->id,'productvariations.id'=>$productVariation])
                            ->first();
        $output="
            <div class='row'>
                <div class='col-md-5'>
                <img src='".asset($products->productImage)."' class='img-thumbnail' style='height:250px;width:350px;'>
                </div>
                <div class='col-md-5'>
                        <h3>".$products->productTitle."</h3>";
                        if ($products->onsale==1) {
                            $total_discount=$products->productPrice-$products->salePrice;
                            $discount_percentage=100-(($products->salePrice*100)/$products->productPrice);
        $output.="      
                        <h6 style='color:green'>Extra ₹".$total_discount." discount</h6>
                        <div class='row'>
                                <h4 style='color:black'><strong>&#8377;".$products->salePrice." </strong></h4>
                            <div class='col-md-3 pull-left mt-1'>
                                <strike>&#8377;".$products->productPrice."</strike>
                            </div>
                            <div class='col-md-3 pull-left mt-1'>
                            <h6 style='color:green'><strong>".round($discount_percentage,2)."% off </strong></h6>
                            </div>
                        </div>
                        
                ";
                        }else {
        $output.="      <div style='color:green'><h4><strong>".$products->productPrice." &#8377;</strong></h4></div>";
                        }
        
        $output.="
                </div>
            </div>
        ";
        echo $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariation $productVariation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariation $productVariation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVariation  $productVariation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariation $productVariation)
    {
        //
    }
}

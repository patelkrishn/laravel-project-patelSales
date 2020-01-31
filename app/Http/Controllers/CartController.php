<?php

namespace App\Http\Controllers;

use App\Cart;
use Auth;
use Illuminate\Http\Request;
use Image;
use App\ProductVariation;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartSum=Cart::where(['userId'=>Auth::user()->id,'status'=>1])->sum('totalAmount');
        $data=Cart::join('productvariations','productvariations.id','=','carts.productVariationsId')
                    ->join('products','products.id','=','productvariations.productId')
                    ->select('products.*','productvariations.*','carts.*')
                    ->where(['userId'=>Auth::user()->id,'status'=>1])
                    ->get();
                    // foreach ($data as $item ) {
                    //     // open and resize an image file
                    //     $img = Image::make($item->productImage)->resize(100, 150);

                    //     // save file as jpg with medium quality
                    //    return  $img->response('png');;
                    // }
                        //dd($data);
        return view('user.cart',['data'=>$data,'cartSum'=>$cartSum]);
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
        Cart::updateOrInsert(
            ['userId'=>Auth::user()->id,'productVariationsId'=>$request->productId,'status'=>1],
            [
                'quantity'=>$request->quantity,
                'totalAmount'=>($request->quantity*$request->productPrice),
                'payableAmount'=>($request->quantity*$request->productPrice),
            ]
        );
        return redirect()->back()->with('success','Product added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $digit=0;
        foreach ($request->qty as $item) {
            $payAmount=$request->qty[$digit]*$request->price[$digit];
            $qty=$request->qty[$digit];
            $cartId=$request->cartId[$digit];
            $price=$request->price[$digit];
            if ($qty==0) {
                Cart::where('id',$cartId)->delete();
            } else {
                Cart::where('id',$cartId)->update([
                    'quantity'=>$qty,
                    'totalAmount'=>$payAmount,
                    'payableAmount'=>$payAmount
                ]);
            }
            
            $digit=$digit+1;
        }
        return redirect()->back()->with('success','Cart updated successfully');
    }

    public function removeDiscount(Request $request,$id)
    {
        Cart::where('id',$id)->update([
            'coupenCode'=>NULL,
            'discountAmount'=>NULL,
            'payableAmount'=>$request->amount
        ]);
        return redirect()->back()->with('success','Discount removed successfully');

    }
    public function coupen(Request $request)
    {
        $check=Cart::where(['userId'=>Auth::user()->id,['coupenCode','!=',NULL]])->count();
        if ($check==0) {
            $productVariations=ProductVariation::where('productCoupenCode',$request->coupenCode)->first();
            $cartData=Cart::where(['productVariationsId'=>$productVariations['id'],'userId'=>Auth::user()->id])->first();
            $paypayableAmount=$cartData['payableAmount']-$productVariations['discountAmount'];
            if ($productVariations==NULL) {
                return redirect()->back()->with('error','You entered coupen code is invalid !!');
            }else{
                Cart::where('id',$cartData['id'])->update([
                    'coupenCode'=>$productVariations['productCoupenCode'],
                    'discountAmount'=>$productVariations['discountAmount'],
                    'payableAmount'=>$paypayableAmount
                ]);
                return redirect()->back()->with('success','Your coupen code is successfully applied');
            }
        }
        else {
            return redirect()->back()->with('error','You already applied coupen code!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\Payment;
use App\Address;
use App\Cart;
use App\Order;
use App\ProductVariation;
use Illuminate\Http\Request;
use Image;
use PaytmWallet;
use App\Http\Controllers\NotificationController;

class PaymentController extends Controller
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
        $addresses=Address::where('userId',Auth::user()->id)->first();
        $cartData=Cart::join('productvariations','productvariations.id','=','carts.productVariationsId')
                        ->join('products','products.id','=','productvariations.productId')
                        ->select('carts.*','productvariations.*','products.*')
                        ->where(['userId'=>Auth::user()->id,'status'=>1])
                        ->get();
        $totalAmount=Cart::where(['userId'=>Auth::user()->id,'status'=>1])->sum('totalAmount');                        
        $discountAmount=Cart::where(['userId'=>Auth::user()->id,'status'=>1,['discountAmount','!=','0']])->first();                        
        $payableAmount=Cart::where(['userId'=>Auth::user()->id,'status'=>1])->sum('payableAmount');   
        return view('user.checkout',['address'=>$addresses,'cartData'=>$cartData,'totalAmount'=>$totalAmount,'discountAmount'=>$discountAmount,'payableAmount'=>$payableAmount]);
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
        if ($request->selector=='cod') {
            $this->dumpCartToPayment('COD','');
            return redirect('/order')->with('success','Order placed');
        }elseif($request->selector=='pwp') {
            $order=rand(11111,999999);
            $payableAmount=$request->payableAmount;
            $this->callPaytmGateway($order,$payableAmount);
        }else {
            return redirect()->back()->with('warning','Please select payment method');
        }
    }
    public function dumpCartToPayment($mode,$referance)
    {
        $cartData=Cart::join('productvariations','productvariations.id','=','carts.productVariationsId')
                        ->join('products','products.id','=','productvariations.productId')
                        ->select('products.*','productvariations.*','carts.*')
                        ->where(['userId'=>Auth::user()->id,'status'=>1])
                        ->get();    
        foreach ($cartData as $item ) {
            $productVariationsId=$item->productVariationsId;
            $stockQuantity=$item->stockQuantity-$item->quantity;
            $totalSales=$item->totalSales+$item->quantity;
            if ($stockQuantity==0) {
                $stockStatus=0;
            }else{
                $stockStatus=1;
            }
            ProductVariation::where('id',$productVariationsId)->update([
                'stockQuantity'=>$stockQuantity,
                'totalSales'=>$totalSales,
                'stockStatus'=>$stockStatus
            ]);
            $paymentId=Payment::insertGetId([
                'userId'=>$item->userId,
                'sellerId'=>$item->sellerId,
                'cartId'=>$item->id,
                'amount'=>$item->payableAmount,
                'paymentMode'=>$mode,
                'referanceNo'=>$referance
            ]);
            app('App\Http\Controllers\NotificationController')->create(
                $title="You have a new order",
                $content="You have a new order of ".$item->productTitle,
                $status=1,
                $userId=NULL,
                $sellerId=$item->sellerId,
            );
            Order::create([
                'cartId'=>$item->id,
                'paymentId'=>$paymentId,
                'userId'=>$item->userId,
                'productVariationsId'=>$item->productVariationsId,
                'quantity'=>$item->quantity,
                'totalAmount'=>$item->totalAmount,
                'coupenCode'=>$item->coupenCode,
                'discountAmount'=>$item->discountAmount,
                'payableAmount'=>$item->payableAmount,
                'status'=>'PENDING'
            ]);
            Cart::where(['userId'=>Auth::user()->id,'status'=>1])->update(['status'=>0]);
        }
    }

    public function callPaytmGateway($order,$amount)
    {
        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $order,
          'user' => Auth::user()->id,
          'mobile_number' => Auth::user()->mobile,
          'email' => Auth::user()->email,
          'amount' => $amount,
          'callback_url' => asset('/payment/paytmRsponse')
        ]);
        return $payment->receive();
    }
    public function paytmResponse()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        
        if($transaction->isSuccessful()){
            $this->dumpCartToPayment('PWP','');
            return redirect('/order')->with('success','Order placed');
        }else if($transaction->isFailed()){
            return redirect()->back()->with('error','Payment Fails'.$transaction->getResponseMessage());
        }else if($transaction->isOpen()){
          //Transaction Open/Processing
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

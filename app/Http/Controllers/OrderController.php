<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\ProductVariations;
use App\Product;
use App\Cart;
use App\Payment;
use Auth;

class OrderController extends Controller
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
        $orders=Order::join('carts','carts.id','=','orders.cartId')
                       ->join('payments','payments.cartId','=','orders.cartId')
                       ->join('addresses','addresses.userId','=','orders.userId')
                       ->select('orders.*','addresses.name')
                       ->where('payments.sellerId',Auth::user()->id)
                       ->orderBy('orders.id','desc')
                       ->get();
        // dd($orders);
        return view('seller.order',['orders'=>$orders,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $address=Order::join('addresses','addresses.userId','=','orders.userId')
                     ->select('orders.*','addresses.*')
                     ->where('orders.userId',$order->userId)
                     ->first();
        $orders=Order::join('productvariations','productvariations.id','=','orders.productVariationsId')
                      ->join('products','productvariations.productId','=','products.id')
                      ->join('payments','payments.id','=','orders.paymentId')
                      ->select('products.productTitle','orders.*','productvariations.*','payments.paymentMode')
                      ->where('orders.id',$order->id)
                      ->first();
                    //   dd($orders);
        $this->htmlView($address,$orders,$order->id);
    }

    public function htmlView($address,$orders,$id)
    {
        $output='
        <div class="modal-header">
              <h4 class="modal-title"><b>#'.$id.'</b></h4>';
              if($orders['status']=='PENDING'){
        $output.='<button type="button" class="btn btn-info disabled ml-3">'.$orders['status'].'</button>';
              }elseif($orders['status']=='COMPLETED'){
        $output.='<button type="button" class="btn btn-primary disabled ml-3">'.$orders['status'].'</button>';
              }elseif($orders['status']=='HOLD'){
        $output.='<button type="button" class="btn btn-warning disabled ml-3">'.$orders['status'].'</button>';
              }elseif($orders['status']=='SHIPED'){
                $output.='<button type="button" class="btn btn-success disabled ml-3">'.$orders['status'].'</button>';
              }else{
        $output.='<button type="button" class="btn btn-danger disabled ml-3">'.$orders['status'].'</button>';
              }
        $output.=' <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div style="font-weight: 600;font-size: 16px;">Shiping Details</div>
              <h6>'.$address['name'].'</br>
              '.$address['street'].'</br>
              '.$address['landmark'].'</br>
              '.$address['city'].' '.$address['pincode'].'</br>
              '.$address['state'].'</h6></br>
              <div style="font-weight: 600;font-size: 16px;">Mobile</div> 
              <a href="tel:'.$address['mobile'].'"><u>'.$address['mobile'].'</u></a></br></br>
              <div style="font-weight: 600;font-size: 16px;">Payment via</div>';
              if($orders['paymentMode']=="PWP") {
                  $output.="Paid withPaytm</br></br>";
              }elseif($orders['paymentMode']=='COD'){
                  $output.="Cash on delivery</br></br>";
              }
              $output.='
              <table class="table">
                <thead>
                <tr>
                    <th width="50%">Product</th>
                    <th width="35%">Quantity</th>
                    <th width="15%"><div class="float-right">Total</div></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>'.$orders['productTitle'].'</td>
                    <td>X'.$orders['quantity'].'</td>
                    <td>₹'.$orders['totalAmount'].'</td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        ';
        echo $output;
    }
    public function orderDetails($order)
    {
        $orderCount=Order::join('payments','payments.id','=','orders.paymentId')
                            ->where(['payments.sellerId'=>Auth::user()->id,'orders.id'=>$order])
                            ->count();
                            // dd($orderCount);
        if ($orderCount==0) {
            return redirect()->back()->with('error', 'This order is not your. choose other and try again');
        }else{
            $orders=Order::join('addresses','addresses.userId','=','orders.userId')
                       ->join('productvariations','productvariations.id','=','orders.productVariationsId')
                       ->join('products','products.id','=','productvariations.productId')
                       ->join('payments','payments.id','=','orders.paymentId')
                       ->select('orders.*','addresses.*','products.productTitle','payments.*','productvariations.*')
                       ->where('orders.id',$order)
                       ->first();
                    //    dd($orders);
        return view('seller.order_details',['orders'=>$orders,'orderId'=>$order,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order,Request $request)
    {
        $order->status=$request->orderStatus;
        $order->save();
        // app('App\Http\Controllers\NotificationController')->setSellerNotificationDown($request->notificationTimestamp);
        return redirect()->back()->with('success', 'Order status changed successfully !!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

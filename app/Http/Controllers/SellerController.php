<?php

namespace App\Http\Controllers;

use App\Seller;
use App\Order;
use Illuminate\Http\Request;
use Auth;

class SellerController extends Controller
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
                       ->paginate(6);
        $pendingOrderCount=Order::join('payments','payments.id','=','orders.paymentId')
                            ->where(['payments.sellerId'=>Auth::user()->id,'orders.status'=>'PENDING'])->count();
        $shipedOrderCount=Order::join('payments','payments.id','=','orders.paymentId')
                            ->where(['payments.sellerId'=>Auth::user()->id,'orders.status'=>'SHIPED'])->count();
        $holdOrderCount=Order::join('payments','payments.id','=','orders.paymentId')
                            ->where(['payments.sellerId'=>Auth::user()->id,'orders.status'=>'HOLD'])->count();
        $completedOrderCount=Order::join('payments','payments.id','=','orders.paymentId')
                            ->where(['payments.sellerId'=>Auth::user()->id,'orders.status'=>'COMPLETED'])->count();
        return view('seller.home',['orders'=>$orders,'pendingOrderCount'=>$pendingOrderCount,'shipedOrderCount'=>$shipedOrderCount,'holdOrderCount'=>$holdOrderCount,'completedOrderCount'=>$completedOrderCount,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
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
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}

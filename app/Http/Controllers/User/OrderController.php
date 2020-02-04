<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Auth;

class OrderController extends Controller
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
        $orders=Order::join('productvariations','productvariations.id','=','orders.productVariationsId')
                      ->join('products','products.id','=','productvariations.productId')
                      ->select('orders.*','products.productTitle','productvariations.color','productvariations.size','productvariations.productImage')
                      ->where(['orders.userId'=>Auth::user()->id,['orders.status','!=','completed']])
                      ->get();
        $completedOrders=Order::join('productvariations','productvariations.id','=','orders.productVariationsId')
                      ->join('products','products.id','=','productvariations.productId')
                      ->select('orders.*','products.productTitle','productvariations.color','productvariations.size','productvariations.productImage')
                      ->where(['orders.userId'=>Auth::user()->id,['orders.status','=','completed']])
                      ->get();
                    //   dd($orders);
        return view('user.order.orders')->with(['orders'=>$orders,'completedOrders'=>$completedOrders]);
    }

    public function orderPlaced()
    {
        return view('user.order.orderPlaced');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address=Order::join('addresses','addresses.userId','=','orders.userId')
                        ->where('orders.id',$id)
                        ->first();
        $orders=Order::join('productvariations','productvariations.id','=','orders.productVariationsId')
                        ->join('products','products.id','=','productvariations.productId')
                        ->select('orders.*','products.productTitle','productvariations.color','productvariations.size','productvariations.productImage')
                        ->where('orders.id',$id)
                        ->first();
        return view('user.order.orderDetails')->with(['address'=>$address,'orders'=>$orders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Order::where('id',$id)->update(['status'=>'CANCELLED']);
        return redirect('/orders/'.$id)->with('success', 'Order cencelled successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

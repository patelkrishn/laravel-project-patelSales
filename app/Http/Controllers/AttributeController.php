<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Attribute;
use App\Product;
use Auth;
class AttributeController extends Controller
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
        $attributes=Product::join('attributes','attributes.productId','=','products.id')
                            ->select('products.*','attributes.*')
                            ->where('products.sellerId',Auth::user()->id)
                            ->get();
        // print_r($attributes);
        // die();
        return view('seller.attribute',['products'=>$products,'attributes'=>$attributes,'notifications'=>$this->notifications(),'notificationsCount'=>$this->notificationsCount]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Attribute::insert([
            'productId'=>$request->productId,
            'name'=>$request->sizeName,
            'type'=>'size'
        ]);
        return redirect()->back()->with('success', 'Attribute Added Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Attribute::create([
            'productId'=>$request->productId,
            'name'=>$request->colorName,
            'colors'=>$request->colors,
            'type'=>'color'
        ]);
        return redirect()->back()->with('success', 'Attribute Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Product;
use App\Attribute;
use App\ProductVariation;
use Auth;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.shop');
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
        $products=Product::join('categories', 'categories.id', '=', 'products.productCategories')
                            ->join('productvariations','productvariations.productId','=','products.id')
                            ->select('products.*', 'categories.name','productvariations.*')
                            ->where('productvariations.id',$id)
                            ->first();
        $colorAttributes=Attribute::join('productvariations','productvariations.productId','=','attributes.productId')
                               ->where(['productvariations.id'=>$id,'attributes.type'=>'color'])
                               ->get();
                            //    dd($products);
       return view('user.productDetails',['items'=>$products,'colorAttributes'=>$colorAttributes]);
    }

    public function getSizeForAjax(Request $request,$id)
    {
        // $sizeAttributes=Attribute::leftJoin('productvariations','productvariations.size','=','attributes.name')
        //                           ->select('attributes.name','productvariations.id')
        //                           ->where(['attributes.productId'=>$id,'attributes.type'=>'size'])
        //                           ->get();
        $sizeAttributes=ProductVariation::where(['productId'=>$id,'color'=>$request->color])
                                    ->select('id','size','color')
                                   ->get();
            $output='
                    <div>
                        <div>Size :</div>
                        <form method="get">
            ';		
            foreach ($sizeAttributes as $item) {
                $path=asset("/product/".$item->id);
                if ($item->size==$request->size) {
                    $output.='<button class="btn btn-default active" formaction="'.$path.'">'.$item->size.'</button>&nbsp;';
                }else{
                    $output.='<button class="btn btn-default " formaction="'.$path.'">'.$item->size.'</button>&nbsp;';
                }
                
            }
            
            $output.='</form></div>';
        echo $output;
        // dd($sizeAttributes);
    }
    
    public function updateSizeForAjax(Request $request)
    {
        // $sizeAttributes=Attribute::leftJoin('productvariations','productvariations.size','=','attributes.name')
        //                           ->select('attributes.name','productvariations.id')
        //                           ->where(['attributes.productId'=>$id,'attributes.type'=>'size'])
        //                           ->get();
        $sizeAttributes=ProductVariation::where(['productId'=>$request->id,'color'=>$request->color])
                                    ->select('id','size','color')
                                   ->get();
            $output='
                    <div>
                        <div>Size :</div>
                        <form method="get">
            ';		
            foreach ($sizeAttributes as $item) {
                $path=asset("/product/".$item->id);
                if ($item->size==$request->size) {
                    $output.='<button class="btn btn-default active" formaction="'.$path.'">'.$item->size.'</button>&nbsp;';
                }else{
                    $output.='<button class="btn btn-default " formaction="'.$path.'">'.$item->size.'</button>&nbsp;';
                }
                
            }
            
            $output.='</form></div>';
        echo $output;
        // dd($sizeAttributes);
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

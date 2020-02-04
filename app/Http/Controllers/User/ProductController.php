<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Product;
use App\Attribute;
use App\ProductVariation;
use App\Category;
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
        $categories=Category::all();
        $categoryForProduct=Category::first();
        $categoryForProductId=$categoryForProduct['id'];
        $products=Product::join('productvariations','productvariations.productId','=','products.id')
                            ->select('products.*','productvariations.*')
                            ->where('products.productcategories',$categoryForProductId)
                            ->get();
        return view('user.shop')->with(['categories'=>$categories,'searchResult'=>'','products'=>$products,'categoryForProduct'=>$categoryForProductId]);
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
        
    }

    public function getSearchData(Request $request)
    {
        $query=$request->search_data;
        $categories=Category::all();
        $categoryForProduct=Category::first();
        $categoryForProductId=$categoryForProduct['id'];
        $products=Product::join('productvariations','productvariations.productId','=','products.id')
                            ->join('categories','categories.id','=','products.productCategories')
                            ->select('products.*','productvariations.*')
                            ->where('products.productTitle','like','%'.$query.'%')
                            ->orWhere('products.productDescreption','like','%'.$query.'%')
                            ->orWhere('categories.name','like','%'.$query.'%')
                            ->orWhere('productvariations.size','like','%'.$query.'%')
                            ->orWhere('productvariations.color','like','%'.$query.'%')
                            ->get();
        return view('user.shop')->with(['categories'=>$categories,'searchResult'=>$query,'products'=>$products,'categoryForProduct'=>$categoryForProductId]);
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
        $categories=Category::all();
        $products=Product::join('productvariations','productvariations.productId','=','products.id')
                            ->select('products.*','productvariations.*')
                            ->where('products.productcategories',$id)
                            ->get();
        return view('user.shop')->with(['categories'=>$categories,'searchResult'=>'','products'=>$products,'categoryForProduct'=>$id]);
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

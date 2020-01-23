@extends('user.layouts.app')
@section('content')
    
                            @foreach ($data as $item)
                                
							<div class="col-md-4 text-center">
								<div class="product-entry">
										<img src="{{asset('/storage/'.$item->product_img)}}" alt="product-image" width="25%">
										<h3><a href="{{route('product.show',['product'=>$item->id])}}">{{$item['product_name']}}</a></h3>
										<p class="price"><span>&#8377;{{$item['product_price']}}</span></p>
									
                            @endforeach
@endsection
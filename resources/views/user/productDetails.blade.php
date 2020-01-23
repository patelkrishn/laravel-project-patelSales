@extends('user.layouts.app')
@section('content')
    
										<img src="{{asset('/storage/'.$items->product_img)}}" alt="product-image" width="25%">
										<h3>{{$items->product_name}}</h3>
										<p>{{$items->product_descreption}}</p>
										<p>{{$items->product_price}}</p>

@endsection
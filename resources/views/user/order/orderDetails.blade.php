@extends('user.layouts.app')
@section('content')
  <div class="container">
     <h3><a href="/profile">My Account</a> > <a href="/orders">My Orders</a> > Order Id #{{$orders->id}}</h3><br>
     
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Delivery Address</h4>
                        <h5>{{$address->name}}</h5>  
                        <h6>{{$address->street}}, </h6>
                           <h6> {{$address->landmark}}, </h6>
                            <h6>{{$address->city}} - {{$address->pincode}}, </h6>
                            <h6> {{$address->state}} </h6>
                           <h6> Phone number <a href="tel:{{$address->mobile}}">{{$address->mobile}}</a></h6>
                    </div>
                </div>
            </div>
        </div>
        <br>

     <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <img src="{{asset($orders->productImage)}}" width="50px" alt="product-image">
                </div>
                <div class="col-md-3">
                    <h6>{{$orders->productTitle}}</h6>
                        Color: {{$orders->color}}<br>
                        Size: {{$orders->size}}
                        <h6>₹{{$orders->totalAmount}}</h6>
                </div>
                <div class="col-md-5">
                    @if ($orders->status=='COMPLETED')
                            <h6>Completed</h6>
                      @elseif($orders->status=='PENDING')
                            <h6>Processing</h6>
                            <a href="/orders/{{$orders->id}}/edit">Cancel this order</a>
                      @elseif($orders->status=='HOLD')
                            <h6>On hold</h6>  
                            <a href="/orders/{{$orders->id}}/edit">Cancel this order</a>
                      @elseif($orders->status=='SHIPED')
                            <h6>Shiped</h6>
                            <a href="/orders/{{$orders->id}}/edit">Cancel this order</a>
                      @elseif($orders->status=='FAILED')
                            <h6>Failed</h6>
                      @elseif($orders->status=='CANCELLED')
                            <h6>Cancelled</h6>
                      @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            Total <h6>₹{{$orders->totalAmount}}</h6>
        </div>
    </div> 
    <br>
    

  </div>
  <br>
@endsection
@section('extra-js')
@if(session()->has('success'))
<script>
	$(document).ready(function(){
      toastr.success('{{ session()->get('success') }}')
    });
</script>
@endif
@if(session()->has('warning'))
<script>
	$(document).ready(function(){
      toastr.warning('{{ session()->get('warning') }}')
    });
</script>
@endif
@if(session()->has('error'))
<script>
	$(document).ready(function(){
      toastr.error('{{ session()->get('error') }}')
    });
</script>
@endif
@endsection


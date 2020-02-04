@extends('user.layouts.app')
@section('content')
  <div class="container">
     <h3><a href="/profile">My Account</a> >My Orders</h3><br>
     @foreach ($orders as $item)
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" disabled>Order Id #{{$item->id}}</button>
                <div class="pull-right">
                    <form method="get">
                    <button class="btn btn-default" formaction="/orders/{{$item->id}}"><i class="fa fa-location-arrow" style="color:blue"></i> Track</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <img src="{{asset($item->productImage)}}" width="50px" alt="product-image">
                    </div>
                    <div class="col-md-4">
                        <h6>{{$item->productTitle}}</h6>
                            Color: {{$item->color}}<br>
                            Size: {{$item->size}}
                    </div>
                    <div class="col-md-2">
                        <h6>₹{{$item->totalAmount}}</h6>
                    </div>
                    <div class="col-md-5">
                        @if ($item->status=='COMPLETED')
                                <h6>Completed</h6>
                          @elseif($item->status=='PENDING')
                                <h6>Processing</h6>
                          @elseif($item->status=='HOLD')
                                <h6>On hold</h6>  
                          @elseif($item->status=='SHIPED')
                                <h6>Shiped</h6>
                          @elseif($item->status=='FAILED')
                                <h6>Failed</h6>
                                @elseif($item->status=='CANCELLED')
                                      <h6>Cancelled</h6>
                          @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                Ordered On {{$item->created_at->format('D, M d, Y')}}
                <div class="pull-right">
                    Order Total <h6>₹{{$item->totalAmount}}</h6>
                </div>
            </div>
        </div>
        <br>
     @endforeach
     
     @foreach ($completedOrders as $item)
     <div class="card">
        <div class="card-header">
            <button class="btn btn-primary" disabled>Order Id #{{$item->id}}</button>
            <div class="pull-right">
                <form method="get">
                <button class="btn btn-default" formaction="/orders/{{$item->id}}"><i class="fa fa-location-arrow" style="color:blue"></i> Track</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <img src="{{asset($item->productImage)}}" width="50px" alt="product-image">
                </div>
                <div class="col-md-4">
                    <h6>{{$item->productTitle}}</h6>
                        Color: {{$item->color}}<br>
                        Size: {{$item->size}}
                </div>
                <div class="col-md-2">
                    <h6>₹{{$item->totalAmount}}</h6>
                </div>
                <div class="col-md-5">
                    @if ($item->status=='COMPLETED')
                            <h6>Completed</h6>
                      @elseif($item->status=='PENDING')
                            <h6>Processing</h6>
                      @elseif($item->status=='HOLD')
                            <h6>On hold</h6>  
                      @elseif($item->status=='SHIPED')
                            <h6>Shiped</h6>
                      @elseif($item->status=='FAILED')
                            <h6>Failed</h6>
                      @elseif($item->status=='CANCELLED')
                            <h6>Cancelled</h6>
                      @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            Ordered On {{$item->created_at->format('D, M d, Y')}}
            <div class="pull-right">
                Order Total <h6>₹{{$item->totalAmount}}</h6>
            </div>
        </div>
    </div>
    <br>
     @endforeach
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


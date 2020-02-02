@extends('seller.layouts.app')

@section('nav_title','Edit Order')
@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/seller">Home</a></li>
                <li class="breadcrumb-item"><a href="/seller/order">Order</a></li>
                <li class="breadcrumb-item"><a href="/seller/order">All Order</a></li>
                <li class="breadcrumb-item active">Edit Order</li>
              {{-- <li class="breadcrumb-item active">Dashboard v3</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row ml-2">
      <div class="col-md-9">
        <div class="card">
          
          <div class="card-body">
            <h3>Order #{{$orderId}} details</h3>
            @if ($orders->paymentMode=='PWP')
            <p>Payment via Paytm. Paid on January 27, 2020 @ 4:52 am. </p>
            @elseif($orders->paymentMode=='COD')
            <p>Payment via Cash on delivery. Paid on January 27, 2020 @ 4:52 am. </p>
            @endif
              <div class="row">
                <div class="col-md-4">
                  <div>
                    <h4>General</h4>
                      <form action="{{asset('seller/order/'.$orderId.'/edit')}}">
                        <label >
                          Status:							</label>
                          <div class="form-group">
                        <select class="form-control" name="orderStatus">
                          <option value="PENDING" {{$orders->status=="PENDING" ? 'selected' : ''}}>Processing</option>
                          <option value="SHIPED" {{$orders->status=="SHIPED" ? 'selected' : ''}}>Shiped</option>
                          <option value="HOLD" {{$orders->status=="HOLD" ? 'selected' : ''}}>On hold</option>
                          <option value="COMPLETED" {{$orders->status=="COMPLETED" ? 'selected' : ''}}>Completed</option>
                          <option value="FAILED" {{$orders->status=="FAILED" ? 'selected' : ''}}>Failed</option>						
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                  </div>
                </div>
                <div class="col-md-4 ml-3">
                  <div>
                    <h4>
                      Shipping
                    </h4>
                    <div>
                      <p>{{$orders->name}}<br />
                        {{$orders->street}}<br />
                        {{$orders->landmark}}<br />
                        {{$orders->city}} {{$orders->pincode}}<br />
                        {{$orders->state}}</p>
                        
                          <p>
                            <strong>Phone:</strong> 
                            <a href="tel:{{$orders->mobile}}">{{$orders->mobile}}</a>
                          </p>						
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
      </div>
      {{-- end of col --}}
      <div class="col-md-9">
        <div class="card">
          
          <div class="card-body">
            <table id="order" class="table table-responsive">
              <thead>
              <tr>
                <th width='70%'>Item</th>
                <th width='10%'>Cost</th>
                <th width='10%'>Quantity</th>
                <th width='10%'>Total</th>
              </tr>
              </thead>
              <tbody>
                      <tr>
                          <td>{{ $orders['productTitle']}}</td>
                          <td>₹ {{$orders['salePrice']!=0 ? $orders['salePrice'] : $orders['productPrice']}}</td>
                          <td>X {{ $orders['quantity']}}</td>
                          <td>₹ {{ $orders['totalAmount']}}</td>
                      </tr>
                      <tr>
                        <td>Flat shipping rate</td>
                        <td></td>
                        <td></td>
                        <td>₹ 59</td>
                      </tr>
          </tbody>
        </table>
          </div>
      </div>
      </div>
      {{-- end of col --}}
    </div>
    {{-- end of row --}}
    @endsection
    @section('extra-js')
    @if(session()->has('success'))
    <script>
        $(document).ready(function(){
          toastr.success('{{ session()->get('success') }}')
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
    @if(session()->has('warning'))
    <script>
        $(document).ready(function(){
          toastr.warning('{{ session()->get('warning') }}')
        });
    </script>
    @endif
    @endsection



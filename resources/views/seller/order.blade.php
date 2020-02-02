@extends('seller.layouts.app')

@section('nav_title','All Order')
@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/seller">Home</a></li>
                <li class="breadcrumb-item">Order</li>
                <li class="breadcrumb-item active">All Order</li>
              {{-- <li class="breadcrumb-item active">Dashboard v3</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Your Product Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="order" class="table table-responsive">
                <thead>
                <tr>
                  <th width='40%'>Order</th>
                  <th width='1%'>View</th>
                  <th width='20%'>Date</th>
                  <th width='20%'>Status</th>
                  <th width='19%'>Total</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td><a href="">#{{$order->id}} {{$order->name}}</a></td>
                            <td><button class="btn btn-default order_details" id="{{ $order->id}}"><i class="fa fa-eye"></i></button></td>
                            <td>{{ $order->created_at}}</td>
                            <td>
                                @if ($order->status=='COMPLETED')
                                    <span class="badge badge-primary">{{ $order->status}}</span>
                                @elseif($order->status=='PENDING')
                                    <span class="badge badge-info">{{ $order->status}}</span>  
                                @elseif($order->status=='HOLD')
                                    <span class="badge badge-warning">{{ $order->status}}</span>  
                                @elseif($order->status=='DISPATCH')
                                    <span class="badge badge-success">{{ $order->status}}</span>
                                @elseif($order->status=='FAILED')
                                    <span class="badge badge-danger">{{ $order->status}}</span>
                                    {{-- <button type="button" class="btn btn-danger disabled">{{ $order->status}}</button> --}}
                                @endif
                            </td>
                            <td>₹{{ $order->totalAmount}}</td>
                        </tr>
                    @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Order</th>
                <th>View</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="test"></div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @endsection

    
@section('extra-js')
<script>
    $(function () {
      $("#order").DataTable();
    });
    $(document).on('click', '.order_details', function(){  
           var id = $(this).attr("id");
                $.ajax({  
                     url:"/seller/order/"+id,  
                     method:"GET",  
                     data:{id:id},  
                     success:function(data){  
                          $('#test').html(data);  
                          $('#modal-default').modal('show');  
                     }  
                });  
                      
      });
  </script>
@endsection





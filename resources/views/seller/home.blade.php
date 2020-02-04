@extends('seller.layouts.app')

@section('nav_title','Home')
@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="/seller">Home</a></li>
              {{-- <li class="breadcrumb-item active">Dashboard v3</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row ml-2">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$pendingOrderCount}}</h3>

            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/seller/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$shipedOrderCount}}</h3>

            <p>Shiped Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/seller/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$holdOrderCount}}</h3>

            <p>On Hold Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/seller/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$completedOrderCount}}</h3>

            <p>Completed Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/seller/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
      <div class="row ml-2">
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
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
                              <span class="badge badge-primary">Completed</span>
                          @elseif($order->status=='PENDING')
                              <span class="badge badge-info">Processing</span>  
                          @elseif($order->status=='HOLD')
                              <span class="badge badge-warning">On hold</span>  
                          @elseif($order->status=='SHIPED')
                              <span class="badge badge-success">Shiped</span>
                          @elseif($order->status=='FAILED')
                              <span class="badge badge-danger">Failed</span>
                              @elseif($order->status=='CANCELLED')
                              <span class="badge badge-danger">Cancelled</span>
                          @endif
                      </td>
                        <td>₹{{ $order->totalAmount}}</td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
              <a href="/seller/order" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    {{-- </div> --}}

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



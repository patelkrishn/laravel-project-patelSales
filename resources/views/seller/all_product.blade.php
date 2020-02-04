@extends('seller.layouts.app')



@section('nav_title','All Product')
@section('content')
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/seller">Home</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">All Products</li>
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
              <table id="product" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><i class="far fa-image"></i></th>
                  <th>Name</th>
                  <th>SKU</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th>Categories</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td width="9%"><img src="{{asset($product->productImage) }}" alt="..." class="img-thumbnail" width="100%"></td>
                            <td><a href="#" class="nav nav-link variation_details" id="{{ $product->id}}">{{ $product->productTitle}} <?php if($product->color!=NULL && $product->size!=NULL){echo '('.$product->color.'+'.$product->size.')';} elseif($product->color==NULL && $product->size!=NULL){echo '('.$product->size.')';} elseif($product->color!=NULL && $product->size==NULL){echo '('.$product->color.')';} else{echo '';} ?></a></td>
                            <td>{{ $product->sku}}</td>
                            <td style="{{ $product->stockQuantity==0 ? 'color:red' : 'color:green' }}">{{ $product->stockQuantity}}&nbsp;({{ $product->stockQuantity==0 ? 'out of stock' : 'in stock' }})</td>
                            <td>{{ $product->productPrice}}</td>
                            <td>{{$product->name}}</td>
                        </tr>
                    @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th><i class="far fa-image"></i></th>
                <th>Name</th>
                <th>SKU</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Categories</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Product Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="test"></div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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
      $("#product").DataTable();
    });
    $(document).on('click', '.variation_details', function(){  
           var id = $(this).attr("id");
                $.ajax({  
                     url:"/seller/product/variations/"+id,  
                     method:"GET",  
                     data:{id:id},  
                     success:function(data){  
                          $('#test').html(data);  
                          $('#modal-xl').modal('show');  
                     }  
                });  
                      
      });
  </script>
@endsection



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
                            <td>{{ $product->productTitle}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$product->name}}</td>
                        </tr>
                    @endforeach
            </tbody>
            <tfoot>
            <tr>
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

@endsection 


@section('extra-js')
<script>
    $(function () {
      $("#product").DataTable();
    });
  </script>
@endsection



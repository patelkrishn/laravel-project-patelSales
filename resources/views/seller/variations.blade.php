@extends('seller.layouts.app')



@section('nav_title','Variations')
@section('content')
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Variations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/seller">Home</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Variations</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <!-- /.card-header -->
            <!-- form start -->
        <form action="/seller/products" method="post" enctype="multipart/form-data">
            @csrf
                {{-- variations --}}
                <section class="content">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                            Variations
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                
                        <div class="form-group">
                            <label>Regular Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter product price">
                        </div>
                        <div class="form-group">
                            <label>Sale Price (optional)</label>
                            <input type="text" name="sale_price" class="form-control" placeholder="Enter product price">
                        </div>
                        {{-- discount --}}
                            <section class="content">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                        Discount (optional)
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <label>Coupen Code  (optional)</label>
                                            <input type="text" name="coupen_code" class="form-control" placeholder="Enter coupen code">
                                            <label>Discount Amount (optional)</label>
                                            <input type="text" name="discount_amount" class="form-control" placeholder="Enter discount amount">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                                </div>
                                <!-- ./row -->
                            </section>
                            <!-- /.content -->
                        {{-- /discount --}}
                        {{-- Inventory --}}
                            <section class="content">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                        Inventory
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <label>SKU</label>
                                            <input type="text" name="sku" class="form-control" placeholder="Enter product sku">
                                            <label>Stock quantity</label>
                                            <input type="text" name="quantity" class="form-control" placeholder="Enter stock quantity">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                                </div>
                                <!-- ./row -->
                            </section>
                            <!-- /.content -->
                        {{-- /Inventory --}}
                        <div class="form-group">
                            <label>Attech product image</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="form-control-file" name="image">
                            </div>
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    </div>
                    <!-- ./row -->
                </section>
                <!-- /.content -->
                {{-- /variations --}}
        
        </form>
    </div>
</div>


@endsection 


@section('extra-js')
<script>
    $(function () {
      // Summernote
      $('.textarea').summernote()
    })
  </script>
@endsection


















    
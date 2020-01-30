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
    @if(session()->has('success'))
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ session()->get('success') }}
              </div>
        </div>
    </div>
    @endif
<!-- Main content -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <!-- /.card-header -->
            <!-- form start -->
        <form action="{{route('variations.store')}}" method="post" enctype="multipart/form-data">
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
                        {{-- select product and variations --}}
                        <section class="content">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Select Product and Variations
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pad">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label>Choose Product</label>
                                            <select class="form-control @error('productId') is-invalid @enderror" name="productId" onchange="selectProduct(this.value)"  value="{{old('productId')}}">
                                                <option value="">Select...</option>
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->productTitle}}</option>
                                                @endforeach
                                            </select>
                                            @error('productId')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div id="attributeData"></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- /.col-->
                            </div>
                            <!-- ./row -->
                        </section>
                        <!-- /.content -->
                    {{-- /select product and variations --}}   
                        <div class="form-group">
                            <label>Regular Price</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter product price" value="{{old('price')}}">
                            @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Sale Price (optional)</label>
                            <input type="text" name="sale_price" class="form-control" placeholder="Enter product price" value="{{old('sale_price')}}">
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
                                            <input type="text" name="coupen_code" class="form-control" placeholder="Enter coupen code" value="{{old('coupen_code')}}">
                                            <label>Discount Amount (optional)</label>
                                            <input type="text" name="discount_amount" class="form-control" placeholder="Enter discount amount" value="{{old('discount_amount')}}">
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
                                            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="Enter product sku" value="{{old('sku')}}">
                                            @error('sku')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label>Stock quantity</label>
                                            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Enter stock quantity" value="{{old('quantity')}}">
                                            @error('quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                            </div>
                            </div>
                        </div>
                            </div>
                        </div>{{-- main card body end --}}
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
    function selectProduct(id)
    {
        $.ajax({
        url:"{{route('variations.attribute')}}",
        method:"GET",
        data:{id:id},
        success:function(data)
        {
            $('#attributeData').html(data);
        }
        });
    }
  </script>
@endsection


















    
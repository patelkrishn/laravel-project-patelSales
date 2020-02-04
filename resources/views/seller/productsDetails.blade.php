@extends('seller.layouts.app')



@section('nav_title','Edit Products')
@section('content')
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/seller">Home</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Edit Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="ml-4 mr-4">
        <form action="/seller/products/{{$id}}/update" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="productId" value="{{$productId}}">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control" name="productTitle" value="{{$products['productTitle']}}">
                </div>
                {{-- short-descreption --}}
                <section class="content">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                              Short Descreption
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                            <textarea class="textarea" name="productShortDescreption" placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$products['productShortDescreption']}}</textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    </div>
                    <!-- ./row -->
                </section>
                <!-- /.content -->
            {{-- /short-descreption --}}
                {{-- descreption --}}
                    <section class="content">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                Descreption
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                <div class="mb-3">
                                <textarea class="textarea" name="productDescreption" placeholder="Place some text here"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$products['productDescreption']}}</textarea>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        </div>
                        <!-- ./row -->
                    </section>
                    <!-- /.content -->
                {{-- /descreption --}}
                    {{-- choose product area --}}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Select Product and Variations
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <select class="form-control" name="color">
                                                <option value="">Select...</option>
                                                @foreach ($colorAttributes as $colorAttribute)
                                                    <option value="{{$colorAttribute->name}}" {{$colorAttribute->name==$products['color'] ? 'selected' : ''}}>{{$colorAttribute->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select class="form-control" name="size">
                                                <option value="">Select...</option>
                                                @foreach ($sizeAttributes as $sizeAttribute)
                                                    <option value="{{$sizeAttribute->name}}" {{$sizeAttribute->name==$products['size'] ? 'selected' : ''}}>{{$sizeAttribute->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        {{-- choose product area end --}}
                        <div class="form-group">
                            <label>Regular Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter product price" value="{{$products['productPrice']}}">
                            
                        </div>
                        <div class="form-group">
                            <label>Sale Price (optional)</label>
                            <input type="text" name="sale_price" class="form-control" placeholder="Enter product price" value="{{$products['salePrice']}}">
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
                                            <input type="text" name="coupen_code" class="form-control" placeholder="Enter coupen code" value="{{$products['productCoupenCode']}}">
                                            <label>Discount Amount (optional)</label>
                                            <input type="text" name="discount_amount" class="form-control" placeholder="Enter discount amount" value="{{$products['discountAmount']}}">
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
                                            <input type="text" name="sku" class="form-control" placeholder="Enter product sku" value="{{$products['sku']}}">
                                            
                                            <label>Stock quantity</label>
                                            <input type="text" name="quantity" class="form-control" placeholder="Enter stock quantity" value="{{$products['salePrice']}}">
                                            
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
            </div><!-- col-md-9 end -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Categories
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" name="productCategories">
                                <option value="">Select...</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id==$products['productCategories'] ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    </div>
    
@endsection 


@section('extra-js')

  <script>
    $(function () {
      // Summernote
      $('.textarea').summernote()
    })
  </script>
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



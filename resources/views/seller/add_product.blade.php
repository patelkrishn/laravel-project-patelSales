@extends('seller.layouts.app')



@section('nav_title','Add Product')
@section('content')
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add new product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/seller">Home</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Add Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(session()->has('message'))
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ session()->get('message') }}
              </div>
        </div>
    </div>
    @endif
<!-- Main content -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Enter product details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
        <form action="/seller/products" method="post" enctype="multipart/form-data">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Product Title</label>
                  <input type="text" name="title" class="form-control" placeholder="Enter product title">
                </div>
                <div class="form-group">
                    <label>Short Descreption</label>
                    <textarea name="short_descreption" class="form-control" placeholder="Enter short descreption"></textarea>
                  </div>
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
                                <textarea class="textarea" name="descreption" placeholder="Place some text here"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                {{-- categories --}}
                    <section class="content">
                        <div class="row">
                        <div class="col-md-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                        Choose categories
                                        </h3>
                                        
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="form-group">
                                            <select class="form-control" name="category">
                                                <option>Select...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </div>
                                </div>
                            
                        </div>
                        <!-- /.col-->
                        </div>
                        <!-- ./row -->
                    </section>
                    <!-- /.content -->
                {{-- /categories --}}
            </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        </div>
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


















    
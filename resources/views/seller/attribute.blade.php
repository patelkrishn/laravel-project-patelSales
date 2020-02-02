@extends('seller.layouts.app')



@section('nav_title','Attributes')
@section('content')
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Attributes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/seller">Home</a></li>
              <li class="breadcrumb-item">Products</li>
              <li class="breadcrumb-item active">Attribute</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(session()->has('success'))
    <div class="container">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            {{ session()->get('success') }}
          </div>
    </div>
    @endif
<div class="container">
    <!-- Main content -->
        <div class="row">
            <div class="col-md-7">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Your Attributes</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form action="/seller/products" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <table id="attributeTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Attribute name</th>
                                <th>Attribute type</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($attributes as $attribute)
                                    <tr>
                                        <td>{{$attribute->productTitle}}</td>
                                        <td>{{$attribute->name}}</td>
                                        <td>{{$attribute->type}}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Product name</th>
                            <th>Attribute name</th>
                            <th>Attribute type</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Add color attribute</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form action="{{route('attribute.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <form action="">
                            @csrf
                            <div class="form-group">
                                <label>Choose Product</label>
                                <select class="form-control" name="productId">
                                    <option>Select...</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->productTitle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Color</label>
                                <input type="text" class="form-control" name="colorName">
                            </div>
                            <div class="form-group">
                                <label>Color <small>(choose color to show color on color variation tab)</small></label>
                                <input type="color" class="form-control" name="colors">
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div>
                </form>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Add size attribute</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form action="{{route('attribute.create')}}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <form action="">
                            @csrf
                            <div class="form-group">
                                <label>Choose Product</label>
                                <select class="form-control" name="productId">
                                    <option>Select...</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->productTitle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>size</label>
                                <input type="text" class="form-control" name="sizeName">
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div>
                </form>
                </div>
            </div>
        </div>
@endsection 


@section('extra-js')
<script>
    $(function () {
      $("#attributeTable").DataTable();
    });
  </script>
@endsection



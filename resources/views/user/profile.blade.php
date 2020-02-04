@extends('user.layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 class="mb-20 title_color">Your Details</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/profile" method="POST">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                <input type="text" class="form-control" name="userName" value="{{Auth::User()->name}}">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" class="form-control" name="gender" value="{{Auth::User()->gender}}">
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" name="mobile" value="{{Auth::User()->mobile}}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="{{Auth::User()->email}}">
                </div>
                <div class="form-group">
                    <label>Password</label> &nbsp; <small>(Leave blank if you not want to change)</small>
                    <input type="text" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label> &nbsp; <small>(Leave blank if you not want to change)</small>
                    <input type="text" class="form-control" name="password_confirmation">
                </div>
                <input type="submit" class="btn btn-primary" name="submit">
            </form>
        </div>
        <div class="col-md-6">
            <h3 class="mb-20 title_color">Your address Details</h3>
            <form action="/profile/address" method="POST">
                @csrf
                <input type="hidden" name="addressId" value="{{$address['id']}}">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{$address['name']}}">
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" name="mobile" value="{{$address['mobile']}}">
                </div>
                <div class="form-group">
                    <label>Street</label>
                    <input type="text" class="form-control" name="street" value="{{$address['street']}}">
                </div>
                <div class="form-group">
                    <label>Landmark</label>
                    <input type="text" class="form-control" name="landmark" value="{{$address['landmark']}}">
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" name="city" value="{{$address['city']}}">
                </div>
                <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control" name="state" value="{{$address['state']}}">
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" name="country" value="{{$address['country']}}">
                </div>
                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" class="form-control" name="pincode" value="{{$address['pincode']}}">
                </div>
                <input type="submit" class="btn btn-primary" name="submit">
            </form>
        </div>
    </div>
    <br>
  </div>
@endsection

@section('extra-js')
@if(session()->has('success'))
<script>
	$(document).ready(function(){
      toastr.success('{{ session()->get('success') }}')
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
@if(session()->has('error'))
<script>
	$(document).ready(function(){
      toastr.error('{{ session()->get('error') }}')
    });
</script>
@endif
@endsection


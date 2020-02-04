@extends('user.layouts.app')
@section('content')

   <div style="margin:60px 0px 70px 0px;">
       <center><h1 style="font-size: 70px;">Your order is placed</h1></center>
       <center><h5><a href="/orders">Click here</a> to view your order.</h5></center>   
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
@endsection
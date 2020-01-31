@extends('user.layouts.app')
@section('content')

   <div>
       <center><h1 style="font-size: 70px;margin:60px 0px 70px 0px;">Your order is placed</h1></center>
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
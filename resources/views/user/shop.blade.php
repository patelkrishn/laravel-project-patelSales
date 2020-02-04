@extends('user.layouts.app')
@section('content')

   
    <!--================Home Banner Area =================-->
    <div class="container">
      <form action="/search" method="get">
        @csrf
        <div class="row">
          <div class="col-md-9">
            <div class="mt-10">
              <input type="text" name="search_data" placeholder="Search for products, brands and more" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Secondary color'"
               required class="single-input-primary" >
            </div>
          </div>
          <div class="col-md-3">
            <button type="submit" class="genric-btn success radius mt-10">Search</button>
          </div>
        </div>
      </form>
    </div>
      <!--================End Home Banner Area =================-->
      <br><br>
    @if ($searchResult!=NULL)
      <div class="container mb-0">
        <h2>@Showing result for <i style="background-color:#cbf7d9">&nbsp;{{ $searchResult }} &nbsp;</i></h2>
      </div>
    @endif
      <!--================Category Product Area =================-->
      <section class="cat_product_area section_gap">
        <div class="container">
          <div class="row flex-row-reverse">
            <div class="col-lg-9">
              
              <div class="latest_product_inner">
                @foreach ($products as $item)
                  <div class="row">
                    <div class="col-md-3">
                      <img src="{{asset($item->productImage)}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6 mt-sm-20 left-align-p">
                      <h4 class="product_title">
                        <a href="/product/{{$item->id}}" target="_blank">
                          @if($item['size']!=NULL && $item['color']!=NULL)
                            <h3>{{$item['productTitle']}}<br>({{$item['color']}}+{{$item['size']}})</h3>
                          @elseif($item['size']==NULL && $item['color']!=NULL)
                            <h3>{{$item['productTitle']}}<br>({{$item['color']}})</h3>
                          @elseif($item['size']!=NULL && $item['color']==NULL)
                            <h3>{{$item['productTitle']}}<br>({{$item['size']}})</h3>
                          @else
                            <h3>{{$item['productTitle']}}</h3>
                          @endif
                        </a>
                      </h4>
                      {{$item->productShortDescreption}}
                    </div>
                    <div class="col-md-3 mt-sm-20 left-align-p">
                      @if ($item->onsale==1)
                          <h3><span style="color:green">₹{{$item->salePrice}}</span></h3>
                          <h4><del>₹{{$item->productPrice}}</del></h4><h5><span style="color:green">{{round((100-(($item->salePrice*100)/($item->productPrice))),2)}}% off</span></h5>
                          @else
                          <h3><span>₹{{$item->productPrice}}</span></h3>
                          @endif
                    </div>
                  </div>
            @endforeach
              </div>
            </div>
  
            <div class="col-lg-3">
              <div class="left_sidebar_area">
                <aside class="left_widgets p_filter_widgets">
                  <div class="l_w_title">
                    <h3>Browse Categories</h3>
                  </div>
                  <div class="widgets_inner">
                    <ul class="list">
                      @foreach ($categories as $item)
                      @if ($categoryForProduct==$item->id)
                        <li>
                          <a style="color:green" href="{{$item->id}}">{{$item->name}}</a>
                        </li>
                      @else
                        <li>
                          <a href="{{asset('/product/'.$item->id.'/edit')}}">{{$item->name}}</a>
                        </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                </aside>
  
  
                {{-- <aside class="left_widgets p_filter_widgets">
                  <div class="l_w_title">
                    <h3>Price Filter</h3>
                  </div>
                  <div class="widgets_inner">
                    <div class="range_item">
                      <div id="slider-range"></div>
                      <div class="">
                        <label for="amount">Price : </label>
                        <input type="text" id="amount" readonly />
                      </div>
                    </div>
                  </div>
                </aside> --}}


              </div>
            </div>
          </div>
        </div>
      </section>
      <!--================End Category Product Area =================-->
  
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


@section('extra-css')
    <style>
      
      /* mouse over link */
      .product_title a:hover {
        color: blue;
      }

    </style>
@endsection
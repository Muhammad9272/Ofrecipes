@extends('front.layouts.app')
@section('page_content')
    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          <li class="text-white">{{\Route::current()->getName() == 'front.cuisine'?'Cuisines':'Recipes'}}</li>
           
        </ul>
      </div>
    </div>


    <div class="ps-page--blog">
      <div class="container def-pad">
        <div class="ps-page__header">
          <h1 class="text-center " >{{\Route::current()->getName() == 'front.cuisine'?'Cuisines':'Recipes'}}</h1>
        </div>

        <div class="ps-blog--sidebar">

	        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-80">                        
	            <div class="row blog-pg-tag">
                @if(\Route::current()->getName() == 'front.cuisine')
                  @foreach($datas as $data)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12  pb-20 ">
                          <div class="ps-product p-0">
                            <div class="ps-product__thumbnail"><a href="{{route('front.cuisine.detail',$data->slug)}}"><img src="{{asset('assets/images/subcategories/'.$data->photo)}}" alt=""></a>
                             
                            </div>
                            <div class="cat-pad-sec">
                              <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">{{$data->name}}</a>
                                
                              </div>

                            </div>
                          </div>
                    </div>  
                  @endforeach 
                @else
                  @foreach($datas as $data)
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 pb-20">
                            <div class="ps-product p-0 ">
                              <div class="ps-product__thumbnail"><a href="{{route('front.category.detail',$data->slug)}}"><img src="{{asset('assets/images/subcategories/'.$data->photo)}}" alt=""></a>
                               
                              </div>
                              <div class="cat-pad-sec">
                                <div class="ps-product__content"><a class="ps-product__title" href="{{route('front.category.detail',$data->slug)}}">{{$data->name}}</a>
                                  
                                </div>

                              </div>
                            </div>
                      </div>  
                  @endforeach  

                @endif                                                        
	            </div>
	            <div class="ps-pagination">
	              <ul class="pagination">
	                <li>
                   {{$datas->Oneachside(2)->links('includes.pagination.default')}} 
                  </li>
	                
	              </ul>
	            </div>
	        </div>
	        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
  
                @include('front.layouts.sidebar')

	        </div>
        </div>
      </div>
    </div>


{{-- 	<div class="row">
	    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 "></div>
	    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 "></div>
	</div> --}}


@endsection



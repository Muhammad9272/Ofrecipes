@extends('front.layouts.app')
@section('page_content')
    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          <li class="text-white">{{\Route::current()->getName() == 'front.cuisine.detail'?'Cuisines':'Recipes'}}</li>
          @if(\Route::current()->getName() != 'front.recipe.all')
          <li class="text-white">{{$cat}}</li>
          @endif
           
        </ul>
      </div>
    </div>


    <div class="ps-page--blog">
      <div class="container def-pad">
        <div class="ps-page__header">
          @if(\Route::current()->getName() == 'front.recipe.search')
          <h1 class="text-center " >Matching results for "{{$search}}"</h1>
          @else
          <h1 class="text-center " >{{$cat}} {{\Route::current()->getName() == 'front.cuisine.detail'?'Cuisines':'Recipes'}}</h1>
          @endif

        </div>

        <div class="ps-blog--sidebar">

	        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-80">                        
	            <div class="row blog-pg-tag ft-recipe">
                @if($datas->count()>0)
                  @foreach($datas as $data)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pb-20">
                          <div class="ps-product p-0">
                            <div class="box-shadow">
                              <div class="ps-product__thumbnail"><a href="{{route('front.recipe',$data->slug)}}"><img src="{{$data->photo?asset('assets/images/recipe/'.$data->photo):asset('assets/images/noimage.png')}}" alt=""></a>
                                
                              </div>
                              <div class="ps-product__container">
                                <div class="ps-product__content">
                                  <div class="mid-content" >
                                    <a class="ps-product__title" href="{{route('front.recipe',$data->slug)}}">{{ Illuminate\Support\Str::limit($data->name, 25) }}</a>
                                   
                                    <p class="ps-product__price sp-txt">{{ Illuminate\Support\Str::limit($data->summary, 90) }}</p>  
                                  </div> 

                                   <div class="row">
                                      <div class="col-6" >
                                        <p class="ps-product__bottom-t sp-txt" style="width: max-content">
                                          <span ><img class="d-inline-flex" src="{{asset('assets/front/img/recip/comnt.svg')}}">&nbsp;</span>
                                          <span>{{count($data->reviews)}} Comments</span>
                                        </p>
                                      </div>
                                      <div class="col-6">
                                         <div class="ps-product__bottom-t" >
                                          <ul> 
                                              @if(\Route::current()->getName() == 'front.category.detail')
                                                @if($data->cuisines_id && $data->cuisines_id!='[]' )
                                                  @php
                                                     $arr=json_decode($data->cuisines_id);
                                                     $cuisine=App\Models\SubCategory::find($arr[0]);
                                                  @endphp
                                                  @if($cuisine)
                                                  <li class="list-bolt-col  sp-txt">{{$cuisine->name}} </li> 
                                                  @endif

                                                @endif

                                              @else  
                                                @if($data->recipes_id && $data->recipes_id!='[]' )
                                                    @php
                                                       $arr=json_decode($data->recipes_id);
                                                       $course=App\Models\SubCategory::find($arr[0]);
                                                    @endphp
                                                    @if($course)
                                                    <li class="list-bolt-col  sp-txt">{{$course->name}} </li> 
                                                    @endif

                                                  @endif
                                              @endif

                                                                                      
                                              
                                               
                                          </ul>
                                           
                                         </div>
                                      </div>                                                                     
                                   </div>                                                                 
                                </div>
                               
                              </div>
                            </div>
                          </div>
                    </div>  

                  @endforeach
                @else
                 <h2>No Data Found</h2>
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



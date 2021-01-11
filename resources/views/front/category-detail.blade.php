@extends('front.layouts.app')

          @if(\Route::current()->getName() == 'front.recipe.search')
          @section('title', 'Searching results  — ')
          @elseif(\Route::current()->getName() == 'front.recipe.all')
          @section('title', 'All Recipes — ')
          @endif


@section('page_content')
    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          <li class="text-white">{{$data?$data->category->name:'Recipes'}}</li>
          
          <li class="text-white">{{$data?$data->name:'All'}}</li>
          
        </ul>
      </div>
    </div>


    <div class="ps-page--blog">
      <div class="container def-pad">
        <div class="ps-page__header">
          @if(\Route::current()->getName() == 'front.recipe.search')
          <h1 class="text-center " >Matching results for "{{$search}}"</h1>
          @elseif(\Route::current()->getName() == 'front.recipe.all')
          <h1 class="text-center " >All Recipes</h1>
          @else
          <h1 class="text-center " >{{$data?$data->name:''}} {{$data?$data->category->name:''}} </h1>
          @endif

        </div>

        <div class="ps-blog--sidebar">

	        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-80">
            @if(isset($data->detail_desc))     
            <div class="mb-30">{!! $data->detail_desc !!}</div>
            @endif                    
	            <div class="row blog-pg-tag ft-recipe">
                @if($datas->count()>0)
                  @foreach($datas as $datawise)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pb-20">
                          <div class="ps-product p-0">
                            <div class="box-shadow">
                              <div class="ps-product__thumbnail"><a href="{{route('front.recipe',$datawise->slug)}}"><img src="{{$datawise->photo?asset('assets/images/recipe/'.$datawise->photo):asset('assets/images/noimage.png')}}" alt=""></a>
                                
                              </div>
                              <div class="ps-product__container">
                                <div class="ps-product__content">
                                  <div class="mid-content" >
                                    <a class="ps-product__title" href="{{route('front.recipe',$datawise->slug)}}">{{ Illuminate\Support\Str::limit($datawise->name, 25) }}</a>
                                   
                                    <p class="ps-product__price sp-txt">{{ Illuminate\Support\Str::limit($datawise->summary, 90) }}</p>  
                                  </div> 

                                   <div class="row">
                                      <div class="col-6" >
                                        <p class="ps-product__bottom-t sp-txt" style="width: max-content">
                                          <span ><img class="d-inline-flex" src="{{asset('assets/front/img/recip/comnt.svg')}}">&nbsp;</span>
                                          <span>{{count($datawise->reviews)}} Comments</span>
                                        </p>
                                      </div>
                                      <div class="col-6">
                                         <div class="ps-product__bottom-t" >
                                          <ul> 
                                              @if(\Route::current()->getName() == 'front.category.detail')
                                                @if($datawise->cuisines_id && $datawise->cuisines_id!='[]' )
                                                  @php
                                                     $arr=json_decode($datawise->cuisines_id);
                                                     $cuisine=App\Models\SubCategory::find($arr[0]);
                                                  @endphp
                                                  @if($cuisine)
                                                  <li class="list-bolt-col  sp-txt">{{$cuisine->name}} </li> 
                                                  @endif

                                                @endif

                                              @else  
                                                @if($datawise->recipes_id && $datawise->recipes_id!='[]' )
                                                    @php
                                                       $arr=json_decode($datawise->recipes_id);
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
                 <h2 style="padding: 15px">No Data Found</h2>
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



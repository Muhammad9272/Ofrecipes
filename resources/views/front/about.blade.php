@extends('front.layouts.app')
@section('page_content')

    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          @if(\Route::current()->getName() == 'front.about')
          <li class="text-white">About</li>
          @else
          <li class="text-white">{{$data->title}}</li>
          @endif
           
        </ul>
      </div>
    </div>



    <div class="ps-page--blog">
      <div class="container def-pad">

        <div class="row mt-50">
          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-100">

        		{!! $data->desc !!}

        	</div>

          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
  
                @include('front.layouts.sidebar')

          </div>
	               	
        </div>

      </div>
    </div>

@endsection    
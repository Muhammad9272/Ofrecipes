@extends('front.layouts.app')
@section('page_content')

    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          <li class="text-white">{{$data->title}}</li>
           
        </ul>
      </div>
    </div>



    <div class="ps-page--blog">
      <div class="container def-pad">

        <div class="row mt-50">
        	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-80">

        		{!! $data->desc !!}

        	</div>
	               	
        </div>

      </div>
    </div>

@endsection    
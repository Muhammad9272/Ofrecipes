<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
       @if(isset($data) && isset($data->seo_check) && $data->seo_check==1 )
        <meta name="keywords" content="{{ !empty($data->meta_tag) ? $data->meta_tag:  $gs->meta_keys}}">

        <meta name="description" content="{{ $data->meta_desc != null ? $data->meta_desc : '' }}">
        
        <title> {{ !empty($data->meta_title) ? ($data->meta_title .' — '. $gs->title) :  $gs->title}}  </title>
      @else

      <meta name="keywords" content="{{ $gs->meta_keys }}">
      <meta name="description" content="Ofrecipes">

      <title> @yield('title') {{$gs->title}}</title>
      @endif

    <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>



    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/font-awesome/css/font-awesome.min.css')}}">
    

    <link rel="stylesheet" href="{{asset('assets/front/fonts/Linearicons/Linearicons/Font/demo-files/demo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/owl-carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/lightGallery-master/dist/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('assets/flashy/css/flashy.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/furniture.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
  </head>
  <body>
    




   @include('front.layouts.header')

    @section('page_content')
    @show

  @include('front.layouts.footer')

    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
{{--     <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div> --}}


    <script src="{{asset('assets/front/plugins/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/bootstrap4/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/slick/slick/slick.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/slick-animation.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/sticky-sidebar/dist/sticky-sidebar.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery.slimscroll.min.js')}}"></script>

    <script src="{{ asset('assets/admin_assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>


    <script type="text/javascript">
      var mainurl = "{{url('/')}}";
      var gs      = {!! json_encode($gs) !!};
      

    </script>
    <!-- custom scripts-->
   @section('pagelevel_scripts')
   @show
   <script type="text/javascript" src="{{asset('assets/flashy/js/flashy.min.js')}}"></script>

    <script src="{{asset('assets/front/js/custom.js')}}"></script>
    <script src="{{asset('assets/front/js/main.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
  </body>
</html>
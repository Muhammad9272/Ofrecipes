@extends('front.layouts.app')
@section('title', 'Home — ')
@section('page_content')
    <div id="homepage-8" >

      @if($top_banner->status==1)
      <div class="ps-home-promotion-2 " >
        <div class="container def-pad"><a href="{{$top_banner->link}}"><img style="width: 100%" src="{{asset('assets/images/banners/'.$top_banner->photo)}}" alt=""></a></div>
      </div>
      @endif


      <div class="ps-home-banner container def-pad">
        <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="{{$sliders->count()>1?'true':'false'}}" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="{{$sliders->count()>1?'true':'false'}}" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
          @foreach($sliders as $data)
          <div class="ps-banner--autopart" data-background="{{asset('assets/images/sliders/'.$data->photo)}}"><img src="{{asset('assets/images/sliders/'.$data->photo)}}" alt="">

          </div>
          @endforeach
          
        </div>
      </div>

      @if($recipes->count()>0)
      <div class="ps-home-trending-products ps-section--furniture mb-70" >
        <div class="container def-pad-slide" >
          <div class="ps-section__header">
            <h3>Featured Recipes</h3>
          </div>
          <div class="ps-section__content ft-recipe">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="{{$recipes->count()>3?'true':'false'}}" data-owl-dots="true" data-owl-item="3" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on">
              @foreach($recipes as $data)
                          <div class="ps-product">
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
                                          <span class="ppn">{{count($data->reviews)}} Comments</span>
                                        </p>
                                      </div>
                                      <div class="col-6">
                                         <div class="ps-product__bottom-t" >
                                          <ul>
                                            @if($data->recipes_id && $data->recipes_id!='[]' )
                                              @php
                                                 $arr=json_decode($data->recipes_id);
                                                 $course=App\Models\SubCategory::find($arr[0]);
                                              @endphp
                                              @if($course)
                                              <li class="list-bolt-col  sp-txt">{{$course->name}} </li> 
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
              @endforeach
                                            

            </div>
          </div>
          <div class="ps-section__header">
                <div class="read-btn margin-t-25">
                 <a class="ps-btn btn-custom " href="{{route('front.recipe.all')}}">View all</a>
                </div>            
          </div>
                                  
        </div>
      </div>
      @endif

      @if($cuisine_cat->status==1)
        <div class="ps-home-trending-products ps-section--furniture mb-70">
          <div class="container def-pad-slide">
            <div class="ps-section__header">
              <h3> Cuisines</h3>
            </div>
            <div class="ps-section__content">
              <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="{{$cuisines->count()>4?'true':'false'}}" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on">

                  <div class="row">
                  @foreach($cuisines as $cuisine)
                            <div class="ps-product">
                              <div class="ps-product__thumbnail box-shadow"><a href="{{route('front.category.detail',['slug2'=>$cuisine->slug])}}"><img src="{{asset('assets/images/subcategories/'.$cuisine->photo)}}" alt=""></a>
                               
                              </div>
                              <div class="cat-pad-sec">
                                <div class="ps-product__content"><a class="ps-product__title" href="{{route('front.category.detail',['slug2'=>$cuisine->slug])}}">{{$cuisine->name}}</a>
                                  
                                </div>

                              </div>
                            </div>
                          @if((count($cuisines)<8))
                           </div><div class="row">
                          @elseif ( ( ($loop->iteration % 2) == 0 ) && (!$loop->last) )
                               </div><div class="row">
                          @endif
                   @endforeach
                  </div>
                            
              </div>
            </div>
            <div class="ps-section__header">
                  <div class="read-btn margin-t-25">
                   <a class="ps-btn btn-custom " href="{{route('front.category',$cuisine_cat->slug)}}">View all</a>
                  </div>            
            </div>
          </div>
        </div>
      @endif


      <div class="ps-home-trending-products ps-section--furniture mb-70" >
        <div class="container def-pad-slide" >
          <div class="ps-section__header">
            <h3>Latest Recipes</h3>
          </div>
          <div class="ps-section__content ft-recipe">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="{{$recipes->count()>3?'true':'false'}}" data-owl-dots="true" data-owl-item="3" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on">
              @foreach($recipe_latest as $data)
                          <div class="ps-product">
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
                                          <span class="ppn">{{count($data->reviews)}} Comments</span>
                                        </p>
                                      </div>
                                      <div class="col-6">
                                         <div class="ps-product__bottom-t" >
                                          <ul>
                                            @if($data->recipes_id && $data->recipes_id!='[]' )
                                              @php
                                                 $arr=json_decode($data->recipes_id);
                                                 $course=App\Models\SubCategory::find($arr[0]);
                                              @endphp
                                              @if($course)
                                              <li class="list-bolt-col  sp-txt">{{$course->name}} </li> 
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
              @endforeach
                                            

            </div>
          </div>
          <div class="ps-section__header">
                <div class="read-btn margin-t-25">
                 <a class="ps-btn btn-custom " href="{{route('front.recipe.all')}}">View all</a>
                </div>            
          </div>
                                  
        </div>
      </div>


      <div class="ps-about-awards mt-40">
        <div class="container def-pad">
          <div class="ps-section__header">
            <h4>About us</h4>
            
          </div>
          <div class="ps-section__content">
            <div class="row">
              <div class="col-md-6 pr-60 mt-40">
                <h4 >{{$about->title}}</h4>
                <p class="sp-txt">
                 {!! $about->summary !!}
                </p>
                <a href="{{route('front.about')}}" class="ps-post__title_read">Read more</a>
              </div>
              <div class="col-md-6 text-right">
                <div class="pl-30 pad-l-0">
                   <img src="{{asset('assets/images/about/'.$about->photo)}}">
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>

      <div class="ps-newsletter">
        <div class="container def-pad">
          <form class="ps-form--newsletter subscribeform"  id="" action="{{route('front.subscribe')}}" method="post">
            @csrf
            <div class="row">
                          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                            <div class="e-book-h">
                              <p class="">{!! $gs->newsletter !!}</p>
                            </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-form__right">
                               
                                  <div class="form-row">
                                    <div class="form-group col-md-6 pr-20 pad-r-0">
                                      <input type="text" class="form-control custom-form-input sp-txt" required="" name="name" id="inputEmail4" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-6 pl-20 pad-l-0">
                                      <input type="text" class="form-control custom-form-input sp-txt" name="lname" id="inputPassword4" placeholder="Last Name">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <input type="email " required="" name="email" class="form-control custom-form-input sp-txt" id="inputAddress" placeholder="Email here">
                                    <button class="newslatter-btn" id="sub-btn">
                                      <i class="fa fa-arrow-right form-control-feedback" aria-hidden="true"></i>
                                    </button>
                                    
                                  </div>                              
                          
                            </div>
                          </div>
            </div>
          </form>
        </div>
      </div>

      @if($course_cat->status==1) 
        <div class="ps-home-trending-products ps-section--furniture margin-t-25 mb-90">
          <div class="container def-pad-slide">
            <div class="ps-section__header">
              <h3>Recipe Categories</h3>
            </div>

            <div class="ps-section__content">
              <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="{{$courses->count()>4?'true':'false'}}" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                          
                  <div class="row">
                  @foreach($courses as $course)
                            <div class="ps-product">
                              <div class="ps-product__thumbnail box-shadow"><a href="{{route('front.category.detail',['slug2'=>$course->slug])}}"><img src="{{asset('assets/images/subcategories/'.$course->photo)}}" alt=""></a>
                               
                              </div>
                              <div class="cat-pad-sec">
                                <div class="ps-product__content"><a class="ps-product__title" href="{{route('front.category.detail',['slug2'=>$course->slug])}}">{{$course->name}}</a>
                                  
                                </div>

                              </div>
                            </div>
                           @if((count($courses)<8))
                           </div><div class="row">
                           
                           @elseif ( ( ($loop->iteration % 2) == 0 ) && (!$loop->last) )
                               </div><div class="row">
                          @endif
                   @endforeach
                  </div>
                            
              </div>
            </div>
            <div class="ps-section__header">
                  <div class="read-btn margin-t-25">
                   <a class="ps-btn btn-custom " href="{{route('front.category',$course_cat->slug)}}">View all</a>
                  </div>            
            </div>
          </div>
        </div>
      @endif


      @if($bottom_banner->status==1)
      <div class="ps-home-promotion-2 margin-t-50 " >
        <div class="container def-pad"><a href="{{$bottom_banner->link}}"><img style="width: 100%" src="{{asset('assets/images/banners/'.$bottom_banner->photo)}}" alt=""></a></div>
      </div>
      @endif

      <div class="ps-home-trending-products ps-section--furniture margin-t-50">
        <div class="container def-pad">
          <div class="ps-section__header" style="text-align: left;">
            <h3 class="mb-30">Latest Posts</h3>
          </div>
          <div class="ps-blog__content">
            <div class="row">
                          @foreach($blog_latest as $data)
                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="ps-post">
                              <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="{{route('front.blog.detail',$data->slug)}}"></a><img src="{{asset('assets/images/articles/'.$data->photo)}}" alt="">
                                
                              </div>
                              <div class="ps-post__content">
                                <div class="ps-post__meta">
                                   
                                   <div class="blog-li-span">
                                    @if($data->publish_check==1 && $data->publish_date)
                                    <span class="sp-txt"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{ Carbon\Carbon::parse($data->publish_date)->format('M d, Y') }}</span>
                                    @endif
                                    <span class="sp-txt">{{count($data->comments)}} Comments</span>
                                    <span class="sp-txt">{{$data->category->name}}</span>
                                   </div>
                                </div>
                                <a class="ps-post__title" href="{{route('front.blog.detail',$data->slug)}}">{{$data->title}}</a>
                                <p class="sp-txt">{{ Illuminate\Support\Str::limit($data->small_desc, 130) }}</p>
                                <a href="{{route('front.blog.detail',$data->slug)}}" class="ps-post__title_read">Read more</a>
                              </div>
                            </div>
                          </div> 
                          @endforeach                         

            </div>
          </div>
        </div>
      </div>

    </div>
@endsection    
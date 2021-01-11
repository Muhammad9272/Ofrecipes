
      <div class="ps-about-awards ps-about-awards-custom">
        <div class="container def-pad-slide">
          <div class="ps-section__header">
            <h4>Featured On </h4>
            
          </div>
          @if(count($partnrs)>0)
          <div class="ps-section__content featur-pad" >
            <div class="ps-carousel--nav owl-slider"  data-owl-auto="true" data-owl-loop="true" data-owl-speed="15000" data-owl-gap="10" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="5" data-owl-duration="100" data-owl-mousedrag="on">
              @foreach($partnrs as $partnr)
              <a href="{{$partnr->link}}"><img src="{{asset('assets/images/partner/'.$partnr->photo)}}" alt=""></a>
              @endforeach
            </div>
          </div>
          @endif

        </div>
      </div>
    <footer class="ps-footer ps-footer--2 ps-footer--furniture">
      <div class="container">
        <div class="ps-footer__content">
          <div class="row">
                        <div class="col-xl-3 col-lg-2 col-md-1 col-sm-6 col-6 "></div>
                        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 ">
                          <aside class="widget widget_newletters widget_footer widget_newletters-footer">
                            <img src="{{asset("assets/images/recipe/logo/".$gs->logo)}}" style="width: 140px;">
                            <form class="ps-form--newletter" action="{{route('front.recipe.search')}}" method="get">

                              <ul class="ps-list--social">
                              @if(App\Models\Socialsetting::find(1)->f_status == 1)
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                              </li>
                             
                              @endif

                              @if(App\Models\Socialsetting::find(1)->g_status == 1)
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                              </li>
                              
                              @endif

                              @if(App\Models\Socialsetting::find(1)->t_status == 1)
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                              </li>
                              
                              @endif

                              @if(App\Models\Socialsetting::find(1)->l_status == 1)
                             
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                              </li>
                              
                              @endif

                              @if(App\Models\Socialsetting::find(1)->d_status == 1)
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                              </li>
                             
                              @endif
                              @if(App\Models\Socialsetting::find(1)->i_status == 1)
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                              </li>
                            
                              @endif
                              @if(App\Models\Socialsetting::find(1)->p_status == 1)
                              <li>                             
                                <a href="{{ App\Models\Socialsetting::find(1)->pinterest }}" class="pinterest" target="_blank">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                              </li>
                              @endif

                              @if(App\Models\Socialsetting::find(1)->y_status == 1)
                              <li>
                                <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="youtube" target="_blank">
                                    <i class="fa fa-youtube"></i>
                                </a>
                              </li>
                              
                              @endif
                              </ul>

                              <div class="form-group--nest">
                                <input class="form-control" required="" name="search" type="text" placeholder="Search">
                                <button class="ps-btn">
                                  <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                              </div>

                            </form>


                            <nav class="navigation-center">                                    
                              <ul class="menu menu--electronic ">
                                <li><a class="sp-txt " href="{{route('front.index')}}">Home</a>
                                </li>
                                @foreach($rc_cats as $rc_cat)
                                <li> <a class="sp-txt " href="{{route('front.category',$rc_cat->slug)}}">{{$rc_cat->name}}</a>                
                                </li>
                                @endforeach

                                <li><a class="sp-txt " href="{{route('front.page',$blogpgSlug->slug)}}"> Blog</a>
                                </li>
                                <li><a class="sp-txt " href="{{route('front.contact')}}"> Contact</a>
                                </li>
                              </ul>

                            </nav>
                          </aside>
                        </div>
                        <div class="col-xl-3 col-lg-2 col-md-1 col-sm-6 col-6 ">
                        </div>
          </div>
        </div>
        
      </div>
      <div class="ps-footer__copyright">
          {{-- <p>© 2018 Martfury. All Rights Reserved</p> --}}
          <p>
            {{$gs->copyright}}
          </p>
      </div>
      <div class="ps-footer__pages" style="">
          <p>
            @foreach($pgotherss as $pgothr)
            <a class="ppn"  href="{{route('front.page',$pgothr->slug)}}">{{$pgothr->title}}</a>&nbsp;&nbsp;   
            @endforeach
          </p>


      </div>
    </footer>
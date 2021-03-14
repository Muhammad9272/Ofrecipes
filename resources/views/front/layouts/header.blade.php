    <header class="header header--furniture " data-sticky="true">
      @if(Auth::guard('admin')->check())
      <div class="header--standard head-adv" >
        <div class="header__top">
          <div class="container def-pad">
            <div class="header__left">
              <p>Hi {{ Auth::guard('admin')->user()->name}}, Welcome to {{$gs->title}} !</p>
            </div>
            <div class="header__right">
              <ul class="header__top-links">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin-recipe-create')}}"><i class="fa fa-plus"></i>&nbsp;Recipe</a></li>
                <li><a href="{{route('admin-article-create')}}"><i class="fa fa-plus"></i>&nbsp;Blog</a></li>

                @if(isset($page_no))
                <li>
                  @if($page_no==1)
                  <a href="{{route('admin.gs.edit')}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==2)
                  <a href="{{route('admin-cat-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==3)
                  <a href="{{route('admin-subcat-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>                  
                  @elseif($page_no==4)
                  <a href="{{route('admin-recipe-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==5)
                  <a href="{{route('admin-article-index')}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==6)
                  <a href="{{route('admin-article-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==7)
                  <a href="{{route('admin-about-index')}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==8)
                  <a href="{{route('admin-pgother-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==9)
                  <a href="{{route('admin-childcat-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @endif                  
                </li>
                @endif


                <li>
                  <div class="ps-dropdown language cus-drop"><a href="#">{{ Auth::guard('admin')->user()->name}}<img class="img-admin" src="{{asset('assets/images/admins/'.Auth::guard('admin')->user()->photo)}}" alt=""></a>
                    <ul class="ps-dropdown-menu">
                      <li><a href="{{route('admin.profile')}}"><i class="fa fa-edit"></i> Edit Profile</a></li>
                      <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="header__top">
        <div class="container def-pad">
          <div class="header__left"><a class="ps-logo" href="{{route('front.index')}}"><img src="{{asset("assets/images/recipe/logo/".$gs->logo)}}" style="width: 140px" alt=""></a>

          </div>
          <div class="header__center">
              <nav class="navigation">              
                  <div class="navigation__left">
                                <ul class="menu menu--furniture">
                                  <li class="current-menu-item menu-item-has-children"><a href="{{route('front.index')}}">Home</a>
                                    <div class="{{request()->is('/')?'menu-border':''}}"></div>
                                                
                                  </li>


                                @foreach($rc_cats as $key=>$rc_cat)
                                <li>
                                    <div class="navbar-expand-lg ">                
                                        <ul class="nav-cutum-1 navbar-nav mr-auto  ">
                                                                  
                                            <li class="dropdown">
                                                <a class="colr-ornge" href="{{route('front.category',$rc_cat->slug)}}" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">{{$rc_cat->name}}</a>
                                                @if($key==0)
                                                <div class="{{(isset($page_no) &&  $page_no==4) || (isset($ad_check) &&  $ad_check==1)?'menu-border':''}}"></div>
                                                @elseif($key==1)
                                                 <div class="{{ (isset($ad_check) &&  $ad_check==2)?'menu-border':''}}"></div>
                                                @endif
                                          
                                                <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                                  @foreach($rc_cat->subs as $rc_sub)
                                                  @if($rc_sub->childs->count()<1)
                                                  <li><a href="{{route('front.category.detail',['slug2'=>$rc_sub->slug])}}">{{$rc_sub->name}}</a></li>
                                                  @else
                                                  <li class="dropdown">
                                                      <a class="dropdown-toggle" href="{{route('front.category.detail',['slug2'=>$rc_sub->slug])}}" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">{{$rc_sub->name}}</a>
                                                      
                                                      <ul class="dropdown-menu" style="min-height: 50px" aria-labelledby="navbarDropdown">
                                                      @foreach($rc_sub->childs as $child)
                                                          <li><a href="{{route('front.childcategory.detail',['slug1' => $rc_sub->slug, 'slug2' => $child->slug])}}">{{$child->name}}</a></li>

                                                         @endforeach
                                                      </ul>
                                                      
                                                  </li>
                                                  @endif
                                                    @endforeach
                                                </ul>
                                                
                                            </li>
                                            
                                        </ul>                
                                    </div>
                                </li>
                                @endforeach

                                  {{-- @foreach($rc_cats as $key=>$rc_cat)
                                  <li class="menu-item-has-children "><a href="{{route('front.category',$rc_cat->slug)}}">{{$rc_cat->name}}</a>
                                    @if($key==0)
                                    <div class="{{(isset($page_no) &&  $page_no==4) || (isset($ad_check) &&  $ad_check==1)?'menu-border':''}}"></div>
                                    @elseif($key==1)
                                     <div class="{{ (isset($ad_check) &&  $ad_check==2)?'menu-border':''}}"></div>
                                    @endif
                                      <span class="sub-toggle"></span>
                                       <ul class="sub-menu">
                                                    @foreach($rc_cat->subs as $rc_sub)
                                                    <li><a href="{{route('front.category.detail',['slug2'=>$rc_sub->slug])}}">{{$rc_sub->name}}</a>
                                                    </li>
                                                    @endforeach
                                        </ul>

                                  </li>
                                  @endforeach --}}
 {{--                                @foreach($rc_cats as $key=>$rc_cat)
                                    <li class="tmero">                                      
                                        <div class="menu--product-categories">
                                          <a class="fr-st" href="{{route('front.category',$rc_cat->slug)}}">{{$rc_cat->name}}</a>
                                            @if($key==0)
                                          <div class="{{(isset($page_no) &&  $page_no==4) || (isset($ad_check) &&  $ad_check==1)?'menu-border':''}}"></div>
                                        @elseif($key==1)
                                         <div class="{{ (isset($ad_check) &&  $ad_check==2)?'menu-border':''}}"></div>
                                        @endif
                                            <div class="menu__content">
                                                        <ul class="menu--dropdown">
                                                            @foreach($rc_cat->subs as $rc_sub)
                                                          <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="{{route('front.category.detail',['slug2'=>$rc_sub->slug])}}">{{$rc_sub->name}}</a>
                                                              @if($rc_sub->childs->count()>0)
                                                              <div class="mega-menu" style="position: relative;">
                                                                <div class="mega-menu__column">                    
                                                                  <ul class="mega-menu__list">
                                                                    @foreach($rc_sub->childs as $child)
                                                                    <li class="current-menu-item "><a href="#">{{$child->name}}</a>
                                                                    </li>
                                                                    @endforeach
                                                                    
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                              @endif
                                                          </li>
                                                          @endforeach

                                                        </ul>
                                            </div>
                                        </div>                                      
                                    </li>
                                @endforeach --}}

                                  <li class="menu-item-has-children "><a href="{{route('front.recipe',$blogpgSlug->slug)}}">Blog</a>
                                    <div class="{{request()->is('*blog*')?'menu-border':''}}"></div>
                                   

                                  </li>
                                  <li class="menu-item-has-children "><a href="{{route('front.contact')}}">Contact</a>
                                    <div class="{{request()->is('contact')?'menu-border':''}}"></div>

                                  </li>
                                </ul>
                  </div>               
              </nav>
          </div>
          <div class="header__right">
            <form class="ps-form--quick-search" action="{{route('front.recipe.search')}}" method="get">
              <input class="form-control" required="" name="search" type="text" placeholder="Search Recipe">
              <button><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
          </div>
        </div>
      </div>

    </header>
    <header class="header header--mobile furniture" data-sticky="false">

      @if(Auth::guard('admin')->check())
      <div class="header--standard head-adv">
        <div class="header__top head-adv-top">
          <div class="container def-pad">
            <div class="header__left">
              <p>Hi {{ Auth::guard('admin')->user()->name}}, Welcome to {{$gs->title}} !</p>
            </div>
            <div class="header__right">
              <ul class="header__top-links">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin-recipe-create')}}"><i class="fa fa-plus"></i>&nbsp;Recipe</a></li>
                <li><a href="{{route('admin-article-create')}}"><i class="fa fa-plus"></i>&nbsp;Blog</a></li>

                @if(isset($page_no))
                <li>
                  @if($page_no==1)
                  <a href="{{route('admin.gs.edit')}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==2)
                  <a href="{{route('admin-cat-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==3)
                  <a href="{{route('admin-subcat-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>                  
                  @elseif($page_no==4)
                  <a href="{{route('admin-recipe-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==5)
                  <a href="{{route('admin-article-index')}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==6)
                  <a href="{{route('admin-article-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==7)
                  <a href="{{route('admin-about-index')}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @elseif($page_no==8)
                  <a href="{{route('admin-pgother-edit',$data->id)}}"><i class="fa fa-pencil"></i>&nbsp;Edit Page</a>
                  @endif                  
                </li>
                @endif


                <li>
                  <div class="ps-dropdown language cus-drop"><a href="#">{{ Auth::guard('admin')->user()->name}}<img class="img-admin" src="{{asset('assets/images/admins/'.Auth::guard('admin')->user()->photo)}}" alt=""></a>
                    <ul class="ps-dropdown-menu">
                      <li><a href="{{route('admin.profile')}}"><i class="fa fa-edit"></i> Edit Profile</a></li>
                      <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="container def-pad">
        <div class="navigation--mobile">

          <div class="navigation__left"><a class="ps-logo" href="{{route('front.index')}}"><img src="{{asset("assets/images/recipe/logo/".$gs->logo)}}" style="width: 140px" alt=""></a></div>
          <div class="navigation__right">
            <div class="header__actions">
              <div class="ps-cart--mini tablet-search">

                <form class="ps-form--quick-search" action="{{route('front.recipe.search')}}" method="get">
                  <input class="form-control" required="" name="search" type="text" placeholder="I'm searching for...">
                  <button><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>

              </div>
              <div class="ps-block--user-header mobile-left">
                <div class="ps-block__left"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu" style="color: white"></i></a></div>
                
              </div>
            </div>
          </div>
        </div>
       <!-- For mobile search-------------->
        <div class="ps-search--mobile">
          <form class="ps-form--search-mobile" action="{{route('front.recipe.search')}}" method="get">
            <div class="form-group--nest">
              <input class="form-control" required="" name="search" type="text" placeholder="Search something...">
              <button><i class="icon-magnifier"></i></button>
            </div>
          </form>
        </div>
        <!-- For mobile search ends--------->
      </div>
        

    </header>
    <div class="ps-panel--sidebar" id="menu-mobile">
      <div class="ps-panel__header">
        <h3>Menu</h3>
        <a class="ps-btn--close ps-btn--no-boder" id="custom-close" href="#menu-mobile"></a>
      </div>
      <div class="ps-panel__content">
          <ul class="menu--mobile">
            <li class="current-menu-item menu-item-has-children"><a href="{{route('front.index')}}">Home</a>
            </li>

            @foreach($rc_cats as $rc_cat)
            <li class="menu-item-has-children has-mega-menu"><a href="{{route('front.category',$rc_cat->slug)}}">{{$rc_cat->name}}</a>

                <span class="sub-toggle"></span>
                 <ul class="sub-menu">
                              @foreach($rc_cat->subs as $rc_sub)
                              <li><a href="{{route('front.category.detail',['slug2'=>$rc_sub->slug])}}">{{$rc_sub->name}}</a>
                              </li>
                              @endforeach
                  </ul>

            </li>
            @endforeach

            <li class="current-menu-item menu-item-has-children"><a href="{{route('front.recipe',$blogpgSlug->slug)}}">Blog</a>
            </li>
            <li class="current-menu-item menu-item-has-children"><a href="{{route('front.contact')}}">Contact</a>
            </li>

          </ul>
      </div>
    </div>
    <header class="header header--furniture " data-sticky="false">
      <div class="header__top ">
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
                                  <li class="menu-item-has-children "><a href="{{route('front.category')}}">Recipe Types</a>
                                    <div class="{{ (request()->is('category/recipe*')) || (request()->is('recipe*'))? 'menu-border' : '' }}"></div>
                                      <span class="sub-toggle"></span>
                                       <ul class="sub-menu">
                                                    @foreach($rc_subs->where('category_id',1) as $rc_sub)
                                                    <li><a href="{{route('front.category.detail',$rc_sub->slug)}}">{{$rc_sub->name}}</a>
                                                    </li>
                                                    @endforeach
                                        </ul>

                                  </li>
                                  <li class="menu-item-has-children"><a href="{{route('front.cuisine')}}">Cuisines</a>
                                    <div class="{{request()->is('category/cuisine')?'menu-border':''}}"></div>

                                      <span class="sub-toggle"></span>
                                       <ul class="sub-menu">
                                                    @foreach($rc_subs->where('category_id',2) as $rc_sub)
                                                    <li><a href="{{route('front.cuisine.detail',$rc_sub->slug)}}">{{$rc_sub->name}}</a>
                                                    </li>
                                                    @endforeach
                                        </ul>
                                  </li>
                                  <li class="menu-item-has-children "><a href="{{route('front.blog')}}">Blog</a>
                                    <div class="{{request()->is('blog*')?'menu-border':''}}"></div>
                                   

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
            <li class="menu-item-has-children has-mega-menu"><a href="{{route('front.category')}}">Recipe Types</a>
                          <span class="sub-toggle"></span>
                          <ul class="sub-menu">
                             @foreach($rc_subs->where('category_id',1) as $rc_sub)
                                                    <li><a href="{{route('front.category.detail',$rc_sub->slug)}}">{{$rc_sub->name}}</a>
                                                    </li>
                             @endforeach
                            
                          </ul>
            </li>
            <li class="menu-item-has-children has-mega-menu"><a href="{{route('front.cuisine')}}">Cuisines</a>
                          <span class="sub-toggle"></span>
                          <ul class="sub-menu">
                             @foreach($rc_subs->where('category_id',2) as $rc_sub)
                                                    <li><a href="{{route('front.cuisine.detail',$rc_sub->slug)}}">{{$rc_sub->name}}</a>
                                                    </li>
                             @endforeach
                            
                          </ul>
            </li>
            <li class="current-menu-item menu-item-has-children"><a href="{{route('front.blog')}}">Blog</a>
            </li>
            <li class="current-menu-item menu-item-has-children"><a href="{{route('front.contact')}}">Contact</a>
            </li>

          </ul>
      </div>
    </div>
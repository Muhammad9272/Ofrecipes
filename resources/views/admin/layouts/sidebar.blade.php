<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu" id="sidebare" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item start ">
                <a href="{{route('admin.dashboard')}}" >
                    <i class="icon-home"></i>
                    <span class="title">DashBoard</span>                    
                </a>
            </li>

            <li class="nav-item start {{ (request()->is('admin/category*')) || (request()->is('admin/category/create*')) || (request()->is('admin/category/edit*')) ? 'active' : '' }}">
                <a href="{{route('admin-cat-index')}}" >
                    <i class="fa fa-th"></i>
                    <span class="title">Manage Category</span>                    
                </a>
            </li>

            <li class="nav-item start {{ (request()->is('admin/subcategory*')) || (request()->is('admin/subcategory/create*')) || (request()->is('admin/subcategory/edit*')) ? 'active' : '' }}">
                <a href="{{route('admin-subcat-index')}}" >
                    <i class="fa fa-child"></i>
                    <span class="title">Manage SubCategory</span>                    
                </a>
            </li>
            <li class="nav-item start {{ (request()->is('admin/childcategory*')) || (request()->is('admin/childcategory/create*')) || (request()->is('admin/childcategory/edit*')) ? 'active' : '' }}">
                <a href="{{route('admin-childcat-index')}}" >
                    <i class="fa fa-child"></i>
                    <span class="title">Manage ChildCategory</span>                    
                </a>
            </li>




            <li class="nav-item start {{  Request::segment(2) === 'recipe' || request()->is('recipe/review*')  ? 'active' : null }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">Manage Recipe</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item start {{ (request()->is('admin/recipe')) || (request()->is('admin/recipe/create*')) || (request()->is('admin/recipe/edit*')) ? 'active' : '' }}">

                        <a href="{{route('admin-recipe-index')}}" >
                            
                            <span class="title">Recipes</span>                    
                        </a>
                    </li>

                    <li class="nav-item start {{ (request()->is('admin/recipe/review*')) || (request()->is('admin/recipe/review/edit/*')) ? 'active' : '' }} ">

                        <a href="{{route('admin-recipe-review-index')}}" class="nav-link ">
                           
                            <span class="title">Recipe Reviews</span>
                         
                        </a>
                    </li>

                    <li class="nav-item start {{ (request()->is('admin/recipe/reply*')) ? 'active' : '' }} ">

                        <a href="{{route('admin-recipe-reply-index')}}" class="nav-link ">
                           
                            <span class="title">Replies</span>
                         
                        </a>
                    </li>

                </ul>
            </li>









            <li class="nav-item start {{ (request()->is('admin/slider*')) || (request()->is('admin/slider/create*')) || (request()->is('admin/slider/edit*')) ? 'active' : '' }}">
                <a href="{{route('admin-sl-index')}}" >
                    <i class="fa fa-sliders"></i>
                    <span class="title">Slider</span>                    
                </a>
            </li>

            <li class="nav-item start {{ (request()->is('admin/banner*'))  ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-tripadvisor"></i>
                    <span class="title">Banners</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ Request::segment(4) === 'top-banner' ? 'active' : null }}">

                        <a href="{{route('admin-banner-edit', ['slug' =>"top-banner"])}}" class="nav-link ">
                            
                            <span class="title">Top Banner</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::segment(4) === 'bottom-banner' ? 'active' : null }}">
                        <a href="{{route('admin-banner-edit', ['slug' =>"bottom-banner"])}}" class="nav-link ">                            
                            <span class="title">Bottom Banner</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::segment(4) === 'side-banner1' ? 'active' : null }}">
                        <a href="{{route('admin-banner-edit', ['slug' =>"side-banner1"])}}" class="nav-link ">
                           
                            <span class="title">Side Banner 1</span>
                         
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::segment(4) === 'side-banner2' ? 'active' : null }}">
                        <a href="{{route('admin-banner-edit', ['slug' =>"side-banner2"])}}" class="nav-link ">
                            
                            <span class="title">Side Banner 2</span>
                        </a>
                    </li>

                </ul>
            </li>





{{--             <li class="nav-item start {{ (request()->is('admin/faqs*')) || (request()->is('admin/faqs/create*')) || (request()->is('admin/faqs/edit*')) ? 'active' : '' }} ">

                <a href="{{route('admin-faqs-index')}}" >
                    <i class="fa fa-question-circle"></i>
                    <span class="title">Add Faqs Page</span>                    
                </a>
            </li> --}}



            <li class="nav-item start {{  Request::segment(2) === 'blog' || request()->is('blog/category*')  ? 'active' : null }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">Manage Blogs</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item start {{ (request()->is('admin/blog')) || (request()->is('admin/blog/create*')) || (request()->is('admin/blog/edit*')) ? 'active' : '' }}">

                        <a href="{{route('admin-article-index')}}" >
                            <i class="fa fa-newspaper-o"></i>
                            <span class="title">Blogs</span>                    
                        </a>
                    </li>
                    

                    <li class="nav-item start {{ (request()->is('admin/blog/category*')) || (request()->is('admin/blog/category/create*')) || (request()->is('admin/blog/category/edit*')) ? 'active' : '' }} ">

                        <a href="{{route('admin-cblog-index')}}" class="nav-link ">
                           
                            <span class="title">Blog Category</span>
                         
                        </a>
                    </li>
                    <li class="nav-item start {{  (request()->is('admin/blog/comment*')) ? 'active' : '' }}">

                        <a href="{{route('admin-article-indexComment')}}" >
                        
                            <span class="title">Blog Comments</span>                    
                        </a>
                     </li>


                </ul>
            </li>


            <li class="heading">
                <h3 class="uppercase">Settings</h3>
            </li>


            <li class="nav-item start {{  Request::segment(2) === 'about' || Request::segment(2) === 'pgother'  ? 'active' : null }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-navicon"></i>
                    <span class="title">Menu Page Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item start {{ (request()->is('admin/about*'))  ? 'active' : '' }} ">

                        <a href="{{route('admin-about-index')}}" class="nav-link ">
                           
                            <span class="title">About</span>
                         
                        </a>
                    </li>

                    <li class="nav-item start {{ (request()->is('admin/pgother*')) || (request()->is('admin/pgother/create*')) || (request()->is('admin/pgother/edit*')) ? 'active' : '' }} ">

                        <a href="{{route('admin-pgother-index')}}" class="nav-link ">
                           
                            <span class="title">Other Pages</span>
                         
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ (request()->is('admin/generalsettings*')) ? 'active' : '' }}">

                <a href="{{route('admin.gs.edit')}}" >
                    <i class="icon-settings"></i>
                    <span class="title">General Settings</span>                    
                </a>
            </li>
            <li class="nav-item start {{ (request()->is('admin/social*')) ? 'active' : '' }}">

                <a href="{{route('admin-social-index')}}" >
                    <i class="icon-social-dribbble"></i>
                    <span class="title">Social  Settings</span>                    
                </a>
            </li>

            <li class="nav-item start {{ (request()->is('admin/partner*')) ? 'active' : '' }}">

                <a href="{{route('admin-partner-index')}}" >
                    <i class="fa fa-hand-rock-o"></i>
                    <span class="title">Partners</span>                    
                </a>
            </li>

            <li class="nav-item start {{ (request()->is('admin/subscribers*')) ? 'active' : '' }}">

                <a href="{{route('admin-subs-index')}}" >
                    <i class="fa fa-users"></i>
                    <span class="title">Subscribers</span>                    
                </a>
            </li>

            <li class="nav-item start {{ (request()->is('admin/seotools/keywords*')) ? 'active' : '' }}">

                <a href="{{route('admin-seotool-keywords')}}" >
                    <i class=" icon-wrench"></i>
                    <span class="title">Seo Tools</span>                    
                </a>
            </li>
            <li class="nav-item start">

                <a href="{{route('admin-cache-clear')}}" >
                    <i class="fa fa-refresh"></i>
                    <span class="title">Clear Cache</span>                    
                </a>
            </li>

 
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
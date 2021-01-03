<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top" style="background: #1c2346 !important">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            {{-- <a href="index.html">
                <img src="{{ asset('assets/admin_assets/layouts/layout4/img/logo-light.png') }}" alt="logo" class="logo-default" /> </a> --}}
                <a  href="{{url('/')}}"><img style="" src="{{asset('assets/admin_assets/adlogo.png')}}" alt="logo" class="logo-default"></a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

        <div class="page-top">

            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>

                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile">{{ Auth::guard('admin')->user()->name}} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="{{asset('assets/images/admins/'.Auth::guard('admin')->user()->photo)}}" /> </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{route('admin.profile')}}">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="{{route('admin.password')}}">
                                    <i class="icon-lock"></i>Change Password </a>
                            </li>
                            <li class="divider"> </li>

                            <li>
                                <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" >
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                     <form id="logout-form" action="{{route('admin.logout')}}"  method="Get" style="display: none;">
                @csrf
            </form>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
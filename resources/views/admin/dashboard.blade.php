@extends('admin.layouts.app')

@section('page_content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            @include('includes.admin.form-both')
            <div class="page-title">
                <h1>{{$gs->web_name}}
                    <small>Admin Panel</small>
                
                </h1>
            </div>

        </div>

        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="note note-info">
            <p> Welcome to {{$gs->web_name}} Admin Panel </p>
        </div>


        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Guidlines</span>
                </div>
            </div>
            <div class="portlet-body">
                <h4 class="block">What is slug/permalink?</h4>
                <p>Slug/permalink is used as page links whenever you create any page,<strong>Don't add white spaces in slug</strong> Try to create user friendly slug.If you create about us page & its slug is like "about-us" then its link will be like that
                     <b>https://{{$gs->web_name}}/about-us</b>
                </p>

                <h4 class="block">How to add Recipe Ingredients value   ?</h4>
                <p> Don't Use Fractional values like (1/4 or 4/3) use instead in points(1.3 or 4) .Its necessary to make values dynamic & for accurate result.
                </p>

                <h4 class="block">Clearing cache ?</h4>
                <p>
                 Clearing cache is a quick and easy way to free up space and (hopefully) fix a misbehaving app.</p>
                

                 <h4 class="block">What is Status  ?</h4>
                 <p>
                     If you change status to inactive.Then that particular info will not show in website 
                 </p>
                
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
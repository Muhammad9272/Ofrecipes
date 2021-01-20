@extends('admin.layouts.app')

@section('pagelevel_styles')
<link href="{{ asset('assets/admin_assets/img_upload/imgUpload.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('page_content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="fa fa-edit"></i>                      
                </a>
                
                <span class="caption-subject font-red-sunglo bold uppercase">General settings</span>

               

                                                <div class="btn-group">
                                                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-sl-index')}}"> <i class="fa fa-arrow-left"></i>&nbsp;Back
                                                        
                                                    </a>
                                                </div>
                                         
                                    
               
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{route('admin-gs-update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{csrf_field()}}
               @include('includes.admin.form-both')
            
                <div class="form-body">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Current Favicon</label>
                        <div class="col-md-7">
                                <div class="form-file">
                                    <input type="file" class="inputfile" name="favicon" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected" multiple />
                                    <label for="your_picture">
                                        <figure>
                                            <img src="{{asset('assets/images/'.$gs->favicon)}}" alt="" class="your_picture_image">
                                        </figure>
                                        <span class="file-button">Choose favicon</span>
                                    </label>
                                </div> 
                            </div>
                    </div> 

                    <div class="form-group last">
                        <label class="control-label col-md-3">Website Logo</label>
                        <div class="col-md-3">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{$gs->logo?asset('assets/images/recipe/logo/'.$gs->logo):'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="logo"> </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>                                    
                        </div>
                    </div>



                    <div class="form-group last">
                        <label class="control-label col-md-3">Enter Website Slogan/Title</label>
                        <div class="col-md-8">
                              <input type="text" name="title" class="form-control" value="{{$gs->title}}">                                 
                        </div>
                    </div>

                    <div class="form-group last">
                        <label class="control-label col-md-3"> Recipe Author(Default)</label>
                        <div class="col-md-8">
                              <input type="text" name="author_name" class="form-control" value="{{$gs->author_name}}">                                 
                        </div>
                    </div>
                    <div class="form-group last">
                        <label class="control-label col-md-3"> Recipe Author Link(Default)</label>
                        <div class="col-md-8">
                              <input type="text" name="author_link" class="form-control" value="{{$gs->author_link}}">                                 
                        </div>
                    </div>

                    <div class="form-group last">
                        <label class="control-label col-md-3"> eCookbook Text</label>
                        <div class="col-md-8">
                            <textarea class="nic-edit" type="text" class="form-control"  name="eCookbook" required="" >
                                {!! $gs->eCookbook !!}
                            </textarea>
                                                             
                        </div>
                    </div>

                    <div class="form-group last">
                        <label class="control-label col-md-3"> Newsletter Text</label>
                        <div class="col-md-8">
                            <textarea class="nic-edit" type="text" class="form-control"  name="newsletter" required="" >
                                {!! $gs->newsletter !!}
                            </textarea>
                                                             
                        </div>
                    </div>


                    <div class="form-group last">
                        <label class="control-label col-md-3"> Recipe Card Footer Area (Tag it)</label>
                        <div class="col-md-8">
                            <textarea name="recipe_tag" class="nic-edit" style="width: 100%;">
                                {!! $gs->recipe_tag !!}
                                  </textarea>
                                                             
                        </div>
                    </div>

                    <div class="form-group last">
                        <label class="control-label col-md-3">Copyrights</label>
                        <div class="col-md-8">
                              <input type="text" name="copyright" class="form-control" value="{{$gs->copyright}}">                                 
                        </div>
                    </div>

                    <div class="form-group last">
                        <label class="control-label col-md-3">Enter Contact us Email</label>
                        <div class="col-md-8">
                              <input type="email" name="email" class="form-control" value="{{$gs->to_email}}">                                 
                        </div>
                    </div>


                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-4">
                            <button type="submit" class="btn green addProductSubmit-btn">Submit</button>
                            <button type="button" class="btn default">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>

        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->

@endsection
@section('pagelevel_scripts')
<script src="{{ asset('assets/admin_assets/img_upload/imgUpload.js') }}" type="text/javascript"></script>

@endsection
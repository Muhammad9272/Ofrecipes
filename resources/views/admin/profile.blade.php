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
                
                <span class="caption-subject font-red-sunglo bold uppercase">Edit Profile</span>                                    
               
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{csrf_field()}}
               @include('includes.admin.form-both')
            
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Photo</label>
                        <div class="col-md-7">
                                <div class="form-file">
                                    <input type="file" class="inputfile" name="photo" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected" multiple />
                                    <label for="your_picture">
                                        <figure>
                                            <img src="{{asset('assets/images/admins/'.$data->photo)}}" alt="" class="your_picture_image">
                                        </figure>
                                        <span class="file-button">Choose picture</span>
                                    </label>
                                </div> 
                            </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding-top: 0px">Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Enter Button Name" value="{{$data->name}}" name="name">                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding-top: 0px">Email</label>
                        <div class="col-md-5">
                            <input type="email" class="form-control" placeholder="Enter Email" value="{{$data->email}}" name="email">                            
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
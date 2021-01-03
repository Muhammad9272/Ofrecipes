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
                
                <span class="caption-subject font-red-sunglo bold uppercase">Edit Banner</span>                            
               
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{route('admin-banner-update',$data->slug)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{csrf_field()}}
               @include('includes.admin.form-both')
            
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding-top: 0px">Link</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Enter Button link" value="{{$data->link}}" name="link">                            
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-7">
                                <div class="form-file">
                                    <input type="file" class="inputfile" name="photo" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected" multiple />
                                    <label for="your_picture">
                                        <figure>
                                            <img src="{{asset('assets/images/banners/'.$data->photo)}}" alt="" class="your_picture_image">
                                        </figure>
                                        <span class="file-button">Choose picture</span>
                                    </label>
                                </div> 
                            </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-6">
                            <div class="clearfix">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{$data->status==1?'active':'' }}">
                                        <input type="radio" name="status" value="1" class="toggle">Active</label>
                                    <label class="btn btn-default {{$data->status==0?'active':'' }}">
                                        <input type="radio" name="status" value="0" class="toggle">Inactive</label>
                                
                                </div>
                            </div>
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
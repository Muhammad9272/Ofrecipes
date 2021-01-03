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
                
                <span class="caption-subject font-red-sunglo bold uppercase">{{ __('Social Links') }}</span>
  
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{ route('admin-social-update-all') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{csrf_field()}}
               @include('includes.admin.form-both')
            
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Facebook') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                             <input class="form-control" name="facebook" id="facebook" placeholder="{{ __('http://facebook.com/') }}" required="" type="text" value="{{$data->facebook}}"> 
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="f_status" value="1" {{$data->f_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Google Plus') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                              <input class="form-control" name="gplus" id="gplus" placeholder="{{ __('http://google.com/') }}" required="" type="text" value="{{$data->gplus}}">
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="g_status" value="1" {{$data->g_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Twitter') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                             <input class="form-control" name="twitter" id="twitter" placeholder="{{ __('http://twitter.com/') }}" required="" type="text" value="{{$data->twitter}}"> 
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="t_status" value="1" {{$data->t_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Instagram') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                              <input class="form-control" name="instagram" id="instagram" placeholder="{{ __('https://instagram.com/') }}" required="" type="text" value="{{$data->instagram}}">
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="i_status" value="1" {{$data->i_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Pinterest') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                             <input class="form-control" name="pinterest" id="pinterest" placeholder="{{ __('https://pinterest.com/') }}" required="" type="text" value="{{$data->pinterest}}">
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="p_status" value="1" {{$data->p_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Youtube') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                             <input class="form-control" name="youtube" id="youtube" placeholder="{{ __('https://youtube.com/') }}" required="" type="text" value="{{$data->youtube}}"> 
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="y_status" value="1" {{$data->y_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Linkedin') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                            <input class="form-control" name="linkedin" id="linkedin" placeholder="{{ __('http://linkedin.com/') }}" required="" type="text" value="{{$data->linkedin}}">
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="l_status" value="1" {{$data->l_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >{{ __('Dribble') }} *</label>
                        <div class="col-md-6 d-inline-flex">
                             <input class="form-control" name="dribble" id="dribble" placeholder="{{ __('https://dribbble.com/') }}" required="" type="text" value="{{$data->dribble}}">
       
                        </div> 
                        <div class="col-md-3">
                            <input type="checkbox"  class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-color="danger" data-off-text="<i class='fa fa-times'></i>" name="d_status" value="1" {{$data->d_status==1?"checked":""}}>
                            
                        </div>                       
                    </div>


                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-4">
                            <button type="submit" class="btn green addProductSubmit-btn">Save</button>
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
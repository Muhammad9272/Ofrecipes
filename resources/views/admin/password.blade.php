@extends('admin.layouts.app')

@section('pagelevel_styles')


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
                
                <span class="caption-subject font-red-sunglo bold uppercase">Edit Password</span>                                    
               
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{route('admin.password.update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{csrf_field()}}
               @include('includes.admin.form-both')
            
                <div class="form-body">

                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding-top: 0px">Current Password *</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" placeholder="Enter Current Password"  name="cpass">                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding-top: 0px">New Password *</label>
                        <div class="col-md-5">
                            <input type="Password" class="form-control" placeholder="Enter New Password" name="newpass" required="">                            
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding-top: 0px">Retype New Password *</label>
                        <div class="col-md-5">
                            <input type="Password" class="form-control" placeholder="Retype New Password" name="renewpass" required="">                            
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


@endsection
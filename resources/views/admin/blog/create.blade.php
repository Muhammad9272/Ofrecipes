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
                   <i class="fa fa-plus"></i>                       
                </a>
                <span class="caption-subject font-red-sunglo bold uppercase">Add Blog</span>
                <div class="btn-group">
                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-article-index')}}"> <i class="fa fa-arrow-left"></i>&nbsp;Back
                        
                    </a>
                </div>
               
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="geniusform" action="{{route('admin-article-store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{csrf_field()}}
               @include('includes.admin.form-both')



            
                <div class="form-body">

                    <div class="form-group">
                        <label class="col-md-3 control-label" >Category</label>
                        <div class="col-md-8 d-inline-flex">

                            <select  name="category_id" required="" class="form-control">
                              <option value="">{{ __('Select Category') }}</option>
                                @foreach($cats as $cat)
                                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>                             
       
                        </div>                        
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" >Title</label>
                        <div class="col-md-8 d-inline-flex">
                            <input type="text" class="form-control"  name="title" required="">  
       
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" >Slug</label>
                        <div class="col-md-8 d-inline-flex">
                            <input type="text" class="form-control"  name="slug" required="">  
       
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-8">
                                <div class="form-file">
                                    <input type="file" class="inputfile" name="photo" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected"  />
                                    <label for="your_picture">
                                        <figure>
                                            <img src="{{asset('assets/upload.png')}}" alt="" class="your_picture_image img-thumbnail img-responsive ">
                                        </figure>
                                        <span class="file-button"> Choose Thumnail(Preferred size 620*350)</span>
                                    </label>
                                </div> 
                        </div>
                        {{-- <div class="col-md-3">
                                <div class="form-file">
                                    <input type="file" class="inputfile" name="image" id="thumb_img"  onchange="readthumbURL(this);" data-multiple-caption="{count} files selected" />
                                    <label for="thumb_img" >
                                        <figure>
                                            <img class="img-thumbnail img-responsive thumb_img" src="{{asset('assets/upload.png')}}" alt="">
                                        </figure>
                                        <span class="file-button"> Picture(For thumbnail)</span>
                                    </label>
                                </div> 
                        </div> --}}

                    </div> 

                    <div class="form-group">
                        <label class="col-md-3 control-label" >Small Detail</label>
                        <div class="col-md-8 d-inline-flex">
                            <textarea style="height: 70px;" type="text" class="form-control"  name="small_desc" required="" ></textarea>  
       
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                        <div class="form-group last">
                            <label class="control-label col-md-3">Blog Detail</label>
                            <div class="col-md-8">
                                  <textarea name="desc" class="nic-edit" style="width: 100%;">
                                  </textarea>
                            </div>
                        </div>

                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-9">
                            <div class="mt-checkbox-inline">
                                <label class="mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" class="seocheck"  value="1" name="seo_check" >{{ __('Allow Page SEO') }}
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="seofields" id="seofield">
                        <div class="form-group">
                            <label class="col-md-3 control-label" >Meta Title</label>
                            <div class="col-md-8 d-inline-flex">
                                <input  type="text" class="form-control"  name="meta_title"  >  
           
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" >Meta tags</label>
                            <div class="col-md-8 d-inline-flex">
                                <input  type="text" class="form-control" data-role="tagsinput" name="meta_tag"  >  
           
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" >Meta description</label>
                            <div class="col-md-8 d-inline-flex">
                                <input  type="text" class="form-control"  name="meta_desc" >         
                            </div>                        
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
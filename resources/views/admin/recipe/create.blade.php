@extends('admin.layouts.app')

@section('pagelevel_styles')
<link href="{{ asset('assets/admin_assets/img_upload/imgUpload.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ asset('assets/admin_assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

{{-- ck editor --}}
{{-- <link href="{{ asset('assets/admin_assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- ck editor --}}

<style type="text/css">
    .modal-content{
        padding: 10px;
    }
</style>
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
                <span class="caption-subject font-red-sunglo bold uppercase">Add Recipe</span>
                <div class="btn-group">

                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-recipe-index')}}"> <i class="fa fa-arrow-left"></i>&nbsp;Back
                        
                    </a>
                </div>
               
            </div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

            <div class="portlet light bordered">

                <div class="portlet-body">

                    <form class="form-horizontal rc-form" action="{{route('admin-recipe-store')}}" id="geniusform" method="post" enctype="multipart/form-data" role="form">
                       <div class="side-btn-save">
                           <div>

                               <button type="submit" class="btn btn-lg blue addProductSubmit-btn">
                                <i class="fa fa-check"></i> Save </button>
                           </div>
                       </div>

                        @csrf
                        @include('includes.admin.form-both')

                        <div class="btn-group pointed-btn-g" style="float: right;">
                            <a  type="button" data-id="section-1"  class="btn btn-default">
                                 Import</a>
                            <a type="button" data-id="section-11" class="btn btn-default">
                                Detail</a>
                            
                            <a type="button" data-id="section-3" class="btn btn-default">
                                 General</a>
                            <a type="button" data-id="section-2" class="btn btn-default">
                                 Media</a>
                            <a type="button" data-id="section-4" class="btn btn-default">
                                 Times</a>
                            <a type="button" data-id="section-5" class="btn btn-default">
                                Categories</a>
                            <a type="button" data-id="section-6" class="btn btn-default">
                                Equipment</a>
                            <a type="button" data-id="section-7" class="btn btn-default">
                                Ingredients</a>
                            <a type="button" data-id="section-8" class="btn btn-default">
                               Instructions</a>
                            <a type="button" data-id="section-9" class="btn btn-default">
                                Nutritions</a>  
                            <a type="button" data-id="section-10" class="btn btn-default">
                                Notes</a>
                                   
                        </div>
                        <br>
                        <br>


                        <div class="rc-section section-1">
                            <h4>Import</h4>
                             <hr>
                            <div class="row">
                                <label class="col-md-3 control-label" >Import from Text</label>
                                <div class="col-md-6 d-inline-flex">
                                    <input type="text" id="target_im_text" class="form-control"  >  
               
                                </div> 
                                <div class="col-md-2 d-inline-flex">
                                    <a class="btn green btn-outline sbold" data-toggle="modal" href="#large"> Import from text </a>                 
                                </div>
                                
                            </div>
                        </div>

                        <div class="rc-section section-11">
                            <h4>Detailed Description</h4>
                             <hr>
                            <div class="form-group last">
                                <label class="col-md-3 control-label" >Recipe Detailed Description</label>
                                <div class="col-md-8">

                                   <textarea class="nic-edit"  name="detail_desc" ></textarea>
               
                                </div> 
                            </div>
                        </div>  

                        <div class="rc-section section-3">
                            <h4>General</h4>
                             <hr>
                            <div class="row">
                                <label class="col-md-3 control-label" >Name</label>
                                <div class="col-md-8 d-inline-flex">
                                    <input type="text" class="form-control" id="r-name"  name="name" required=""  placeholder="Recipe Name">  
               
                                </div> 
                            </div>

                            <div class="row">
                                <label class="col-md-3 control-label" >Slug</label>
                                <div class="col-md-8 d-inline-flex">
                                    <input type="text" class="form-control" id="r-slug" name="slug" required="" placeholder="Enter slug/permalink">  
               
                                </div> 
                            </div>

                            <div class="row">

                                <label class="col-md-3 control-label" >Summary</label>
                                <div class="col-md-8 d-inline-flex">
                                    <textarea style="height: 100px;" class="form-control" name="summary" id="r-summary" placeholder="Short Description for this recipe..."></textarea>   
               
                                </div> 
                            </div>
                            <div class="row">
                                <label class="col-md-3 control-label" >Pinterest Link</label>
                                <div class="col-md-8 d-inline-flex">
                                    <input type="text" class="form-control"  name="pinterest"  placeholder="Enter Pinterest link">  
               
                                </div> 
                            </div>

                            <div class="row">
                                <label class="col-md-3 control-label">Author</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="author_check" id="authr-change">
                                        <option value="1">Use Default</option>
                                        <option value="0">Don't Show</option>
                                        <option value="2">Custom Author</option>     
                                    </select>
                                </div>
                            </div>
                            <div class="custom-author" id="custom-athr-1">
                                <div class="row">
                                    <label class="col-md-3 control-label fw-200" >Name</label>
                                    <div class="col-md-8 d-inline-flex">
                                        <input type="text" class="form-control" placeholder="Author Name"  name="author_name" >  
                   
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 control-label fw-200" >Link</label>
                                    <div class="col-md-8 d-inline-flex ">
                                        <input type="text" class="form-control"  name="author_link" placeholder="https://google.com">  
                   
                                    </div>
                                </div>
                            </div>

                            <div class="row"> 

                                <label class="col-md-3 control-label" >Servings</label>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" value="1"  name="serving" min="1" required="">  
               
                                </div>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="text" class="form-control"  name="serving_text" placeholder="People">  
               
                                </div>
                            </div>

                            <div class="row"> 

                                <label class="col-md-3 control-label" >Post Schedule</label>
                                <div class="col-md-4 d-inline-flex">
                                    <input class="input-group form-control form-control-inline" type="datetime-local" id="post-schedule" name="post_schedule" > 
               
                                </div>
                            </div>                                   
                                                 

                            <div class="row mb-10"> 

                                <label class="col-md-3 control-label" >Allow Publish Date</label>
                                <div class="col-md-4 d-inline-flex mt-5">
                                     <label class="mt-checkbox">
                                        <input type="checkbox" id="publish-check" value="1" class="form-control" name="publish_check"> <span></span>
                                                                                                
                                    </label>
                                                   
                                </div>
                            </div>

                           <div class="custom-publish-date" id="custom-publish-date">
                                <div class="row"> 

                                    <label class="col-md-3 control-label fw-200" >Publish Date</label>
                                    <div class="col-md-4 d-inline-flex">
                                        <input class="pb-date input-group form-control form-control-inline" type="date" value="01/08/2016" name="publish_date" > 
                   
                                    </div>
                                </div>                                   
                           </div>
                            <div class="row mb-10"> 

                                <label class="col-md-3 control-label" >Allow Updated Date</label>
                                <div class="col-md-4 d-inline-flex mt-5">
                                     <label class="mt-checkbox">
                                        <input type="checkbox" id="updated-check" value="1" class="form-control" name="updated_check"> <span></span>
                                                                                                
                                    </label>
                                                   
                                </div>
                            </div>

                           <div class="custom-updated-date" id="custom-updated-date">
                                <div class="row"> 

                                    <label class="col-md-3 control-label fw-200" >Updated Date</label>
                                    <div class="col-md-4 d-inline-flex">
                                        <input class="input-group form-control form-control-inline up-date" type="date" value="01/08/2016" name="updated_date"  > 
                   
                                    </div>
                                </div>                               
                           </div>
                            

                        </div>

                        <div class="rc-section section-2">
                            <h4>Media</h4>
                             <hr>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Recipe Image</label>
                                <div class="col-md-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>                                    
                                </div>
                                <label class="control-label col-md-2">Recipe Video</label>
                                <div class="col-md-3 ">
                                    <div class="d-inline-flex">                                        
                                        <div class="fileinput fileinput-new" id="rc-vd-div" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                                <span class="fileinput-new"><i class="fa fa-upload"></i> Video </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="video"> </span>
                                            <span class="fileinput-filename"> </span> &nbsp;
                                            <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                        </div>

                                        <div class="fileinput" id="rc-em-div">
                                            <a href="javascript:;" class="input-group-addon btn grey-cascade" id="rc-em-link-sbtn"> <i class="fa fa-link text-white"></i> Embed Video </a>
                                        </div>


                                    </div>
                                    <div id="rc-em-link">
                                        <textarea name="video_link" class="form-control h-100 em-link-t" placeholder="Use URL to the video (e.g. https://www.youtube.com/embed/dQw) or the full embed code."></textarea>
                                        <a href="javascript:;" id="rc-em-link-rbtn" >Remove Video</a>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="rc-section section-4" id="section-4">
                            <h4>Times</h4>
                             <hr>
                            <div class="row inn-cont">
                                <label class="col-md-3 control-label" >Prep Time</label>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" min="0" name="prep_days" >  
                                    <span>days</span>
                                </div> 

                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" min="0"  name="prep_hours" > 
                                    <span>hours</span> 
               
                                </div>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" min="0"  name="prep_mins" >  
                                   <span>minutes</span>
                                </div>
                            </div>
                            <div class="row inn-cont">
                                <label class="col-md-3 control-label" >Cook Time</label>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" min="0" name="cook_days" >  
                                    <span>days</span>
                                </div> 

                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" min="0"  name="cook_hours" > 
                                    <span>hours</span> 
               
                                </div>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" class="form-control" min="0"  name="cook_mins" >  
                                   <span>minutes</span>
                                </div>
                            </div>
                        </div>

                        <div class="rc-section section-5">
                            <h4>Categories</h4>
                             <hr>
                            <div class="row mb-15">
                                <label for="multiple" class="col-md-3 control-label">Courses</label>
                                <div class="col-md-8">
                                    <select id="multiple" name="recipes_id[]" class="form-control select2-multiple" data-placeholder="Select courses" multiple>
                                        <option disabled="">Select Courses</option>    
                                        @foreach($courses as $course)                                    
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-15">
                                <label class="col-md-3 control-label" >Cuisines</label>
                                <div class="col-md-8">
                                    <select id="multiple" name="cuisines_id[]" class="form-control select2-multiple" data-placeholder="Select cuisines" multiple>
                                        <option disabled="">Select Cuisines</option>
                                        @foreach($cuisines as $cuisine)                                    
                                            <option value="{{$cuisine->id}}">{{$cuisine->name}}</option>
                                        @endforeach
                                    </select>
               
                                </div> 
                            </div>

                            <div class="row mb-15">
                                <label class="col-md-3 control-label" >Child category</label>
                                <div class="col-md-8">
                                    <select id="" name="childcat_id[]" class="form-control select2-multiple" data-placeholder="Select Child Category" multiple>
                                        <option disabled="">Select child category</option>
                                        @foreach($childcats as $childcat)                                    
                                            <option value="{{$childcat->id}}">{{$childcat->name}}</option>
                                        @endforeach
                                    </select>
               
                                </div> 
                            </div>

                            <div class="row">
                                <label class="col-md-3 control-label" >Keywords</label>
                                <div class="col-md-8">
                                      <input type="text" name="keywords" class="form-control input-large" value="" placeholder="Add keywords" data-role="tagsinput"> 
               
                                </div>                            
                            </div>
                        </div>
                        <div class="rc-section section-6">
                            <h4>Equipment</h4>
                             <hr>
                            <div class="form-group last">
                                <label class="col-md-3 control-label" >Add Equipment</label>
                                <div class="col-md-8">
                                    <textarea id="r-equipment" class="nic-edit" name="equipment" ></textarea> 
                                        
                                    
               
                                </div> 
                            </div>

                        </div>






                        <div class="rc-section section-7">
                            <h4>Ingredients</h4>
                             <hr>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Variation</label>
                                <div class="col-md-9">
                                    <div class="mt-repeater">
                                        <div data-repeater-list="group-b">
                                            <div data-repeater-item class="row mt-pad-lab">
                                                <div class="col-md-2">
                                                    <label class="control-label">Amount</label>
                                                    <input type="number" placeholder="3" class="form-control" step="0.01" name="ingredient_amount"   /> </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Unit</label>
                                                    <input type="text" name="ingrdient_unit" placeholder="tbsp" class="form-control" /> </div>

                                                <div class="col-md-6">
                                                    <label class="control-label">Name</label>
                                                     <textarea  name="ingrdient_name" placeholder="Salted Tuna" class="form-control summernote" >
                                                        
                                                    </textarea> 
                                                </div>
                                                
                                                <div class="col-md-1">
                                                    <label class="control-label">&nbsp;</label>
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                            <i class="fa fa-plus"></i> Add Ingredient</a>
                                        <br>
                                        <br> </div>
                                </div>
                            </div>
                        </div>                        

                        <div class="rc-section section-8">
                            <h4>Instructions</h4>
                             <hr>
                            <div class="form-group last">
                                <label class="col-md-3 control-label" >Add Instructions</label>
                                <div class="col-md-8">

                                   <textarea class="nic-edit" id="r-instruction" name="instruction" ></textarea>
               
                                </div> 
                            </div>
                        </div>

                        <div class="rc-section section-9">
                            <h4>Nutrition</h4>
                             <hr>
                            <div class="row">
                                <label class="col-md-3 control-label" >Add Nutritions</label>
                                <div class="col-md-8">

                                   <textarea class="nic-edit" id="r-nutrition" name="nutrition" ></textarea>
               
                                </div> 
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-md-3 control-label" >Calories</label>
                                <div class="col-md-2 d-inline-flex">
                                    <input type="number" step="0.01" class="form-control" name="calories">   
                                    <span class="nut-cal-sp">kcal</span>                                
                                </div> 
                            </div>


                        </div>

                        <div class="rc-section section-10">
                            <h4>Notes</h4>
                             <hr>
                            <div class="form-group last">
                                <label class="col-md-3 control-label" >Recipe Notes</label>
                                <div class="col-md-8">

                                   <textarea class="nic-edit" id="r-notes" name="notes" ></textarea>
               
                                </div> 
                            </div>
                        </div>                      

                        <div class="rc-section section-12">
                            <h4>Seo tools</h4>
                             <hr>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <div class="mt-checkbox-inline">
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="1" class="seocheck" name="seo_check" >{{ __('Allow Page SEO') }}
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
                                         <input type="text" class="form-control input-large" value="" name="meta_tag" placeholder="Add keywords" data-role="tagsinput">
                   
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
                        <hr>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-10 col-md-2">
                                    <button type="submit" class="btn blue btn-block addProductSubmit-btn">Save</button>
                                </div>
                            </div>
                        </div>


                    </form>



                </div>
            </div>


            <!-- END FORM-->
        </div>
    </div>

        <!-- END PAGE BASE CONTENT -->
    </div>
     
    <!-- END CONTENT BODY -->

<!-- /.modal -->
<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Recipe - Import From Text</h4>
            </div>
            <div class="modal-body imp-text-modal"> 
               
                <div class="row" >
                    <h4 class="imp-mdl-hd">Highlight text and click the corresponding button</h4>
                    <div class="col-md-3">
                        <div class="">
                                 <div class="clearfix imp-txt-btns">                                  
                                    
                                    <button data-id="fr-name" class="btn btn-manual">Name</button>
                                    <button data-id="fr-slug" class="btn btn-manual">Slug</button>
                                    <button data-id="fr-summary" class="btn btn-manual">Summary</button>
                                    <button data-id="fr-equipment" class="btn btn-manual">Equipment</button>
                                    <button data-id="fr-ingredient" class="btn btn-manual">Ingredients</button>
                                    <button data-id="fr-instruction" class="btn btn-manual">Instructions</button>
                                    <button data-id="fr-nutrition" class="btn btn-manual">Nutrition</button>
                                    <button data-id="fr-notes" class="btn btn-manual">Notes</button>
                                    
                                     
                                </div>                            
                        </div>
                    </div>
                    <div class="col-md-9">
                            <div class="">
                                                                                   
                                <textarea class="form-control" id="imported-text">
                                    
                                </textarea> 
                                                           
                            </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <h4 class="imp-mdl-hd">Fine-tune selections</h4>
                </div>
                <div class="hid-fields">
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Name</label>
                        <div class="col-md-9 d-inline-flex">
                            <input type="text"  class="form-control fr-name"  >
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Slug</label>
                        <div class="col-md-9 d-inline-flex">
                            <input type="text" class="form-control fr-slug"  >
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Summary</label>
                        <div class="col-md-9 d-inline-flex">
                            <input type="text" class="form-control fr-summary"  >
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Equipment</label>
                        <div class="col-md-9 d-inline-flex">
                            <textarea class="form-control fr-equipment"></textarea>
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Instructions</label>
                        <div class="col-md-9 d-inline-flex">
                            <textarea class="form-control fr-instruction"></textarea>
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Ingredients</label>
                        <div class="col-md-9 d-inline-flex">
                            
                            <textarea class="form-control fr-ingredient"></textarea>

                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Nutrition</label>
                        <div class="col-md-9 d-inline-flex">
                           
                            <textarea class="form-control fr-nutrition"></textarea>
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-md-1"></div>                    
                        <label class="col-md-2 control-label" >Notes</label>
                        <div class="col-md-9 d-inline-flex">
                            
                            <textarea class="form-control fr-notes"></textarea>
                        </div> 
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green" id="modal-save-btn" >Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




@endsection
@section('pagelevel_scripts')


{{--         <script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
       
        
        <script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script> --}}

         <script src="{{ asset('assets/admin_assets/img_upload/imgUpload.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin_assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

        <script src="{{ asset('assets/admin_assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

        <script src="{{ asset('assets/admin_assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin_assets/pages/scripts/form-repeater.min.js')}}" type="text/javascript"></script>



<script type="text/javascript">


  $(document).ready(function() {


      $("#post-schedule").setNow();


      $("#rc-em-link-sbtn").on('click',function(){
        $('#rc-em-link').show();
        $('#rc-vd-div').hide();
      });

      $("#rc-em-link-rbtn").on('click',function(){
        $('#rc-em-link').hide();
        $('#rc-em-link .em-link-t').val('')
        $('#rc-vd-div').show();
      });

        $('#rc-vd-div input[type="file"]').change(function() { 
                var fileName = $(this).val();
                if($(this).val()){
                    $('#rc-em-link-sbtn').hide();
                }
                else{
                   $('#rc-em-link-sbtn').show(); 
                } 
            });
        $('#rc-vd-div [data-dismiss="fileinput"]') .on('click',function () {
            $('#rc-em-link-sbtn').show();
        })    


      $('#authr-change').on('change',function () {

        var value = $(this).val();
        if(value==2){
          $('#custom-athr-1').show();  
           $('#custom-athr-1 input').prop("required", true);       
        }
        else{
            $('#custom-athr-1').hide();
            $('#custom-athr-1 input').prop("required", false); 
        }

      });

      $(".pointed-btn-g a").click(function() {
        var id=$(this).attr('data-id');
        $('html,body').animate({
            scrollTop: $("."+id).offset().top-80},
            'slow');

       });





  });


$( document ).ready(function() {

    var text,ing_name;

    $( "#target_im_text" ).keypress(function() {
      $('#large').modal('show');
    });

    $('#imported-text').mouseup(function (e){
        text = window.getSelection().toString();
        
    });

    $(".imp-txt-btns button").on('click',function() {        
        if(text){ 
           var id=$(this).attr('data-id');       
           $(this).addClass('active');             
            $('.'+id).val(text);
            $('.'+id).parent().parent().show();

        }
        text='';
        
    });



    $("#modal-save-btn").on('click',function() {
        if($('.fr-name').val()!=''){
           $('#r-name').val($('.fr-name').val()); 
        }
        
        if($('.fr-slug').val()!=''){
            $('#r-slug').val($('.fr-slug').val());
        }
        if($('.fr-summary').val()!=''){
         $('#r-summary').val($('.fr-summary').val());
        }

        if($('.fr-equipment').val()!=''){
            nicEditors.findEditor( "r-equipment" ).setContent($('.fr-equipment').val());
        }
               
 
        //Ingredients
           var ing=$('.fr-ingredient').val();
           var ks = ing.split("\n");
           $.each(ks, function(k){
             
            if(ks[k]!=''){  

                var r_length = $('[data-repeater-item]').length;
                var last=r_length-1; 
                var last_r_name=$('[name="group-b['+last+'][ingrdient_name]"]').val();
                if(last_r_name!='' || last==-1){
                     $('[data-repeater-create]').click();
                     last=last+1;
                }

              var amount=ks[k].match(/[-]?[0-9]+[,.]?[0-9]*([\/][0-9]+[,.]?[0-9]*)*/g);
              ing_name=ks[k];
              if(amount){
                $('[name="group-b['+last+'][ingredient_amount]"]').val(parseFloat(amount[0]));
                ing_name =ks[k].replace(amount, "");
              }
              $('[name="group-b['+last+'][ingrdient_name]"]').summernote('insertText', ing_name);  

            }

           });


        //End ingredients
         

        if($('.fr-instruction').val()!=''){
            nicEditors.findEditor( "r-instruction" ).setContent($('.fr-instruction').val());
        }
        if($('.fr-nutrition').val()!=''){
            nicEditors.findEditor( "r-nutrition" ).setContent($('.fr-nutrition').val());
        }
        if($('.fr-notes').val()!=''){
            nicEditors.findEditor( "r-notes" ).setContent($('.fr-notes').val());
        }
                
        
        $('.imp-text-modal button').removeClass('active');
        $('#imported-text').val('');

        $('.imp-text-modal input').val('');
        $('.hid-fields .row').hide();
        $('#large').modal('hide');

    })


})


</script>
<script>
    $(document).ready(function()
    {
        $("#publish-check").on( "change", function() {
            if(this.checked){
             $('#custom-publish-date').removeClass('custom-publish-date');
             $('.pb-date').attr('required',true);
            }
            else{
              $('#custom-publish-date').addClass('custom-publish-date');
              $('.pb-date').attr('required',false);
                            
            }

          });
          $("#updated-check").on( "change", function() {
            if(this.checked){
             $('#custom-updated-date').removeClass('custom-updated-date');
             $('.up-date').attr('required',true);
             
            }
            else{
              $('#custom-updated-date').addClass('custom-updated-date');
                 $('.up-date').attr('required',false);           
            }

          });

    })
</script>
<script>
    $(document).ready(function() {
       
        $('.mt-repeater-add').on('click',function(){
            $('.summernote').summernote({
                airMode:true,
                popover: {
                    air: [
                        ['insert', ['link', ]],  
                        ['style', ['bold', 'italic', 'underline', 'clear']],                    
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                    ]
                }
            }); 
             
        });

            $('.summernote').summernote({
                airMode:true,
                popover: {
                    air: [
                        ['insert', ['link', ]],  
                        ['style', ['bold', 'italic', 'underline', 'clear']],                    
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                    ]
                }
            }); 


    });
  </script>

@endsection
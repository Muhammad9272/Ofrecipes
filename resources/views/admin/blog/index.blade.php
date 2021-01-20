@extends('admin.layouts.app')
<style type="text/css">

</style>
@section('page_content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">




                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption d-inline-flex">
                                        <i  class="fa fa-list mt-10"></i>
                                        <span class="caption-subject  sbold uppercase">Blogs</span>
                                        <div class="blog-slug d-inline-flex" >
                                              <form id="blogSlugUpdate" action="{{route('admin-article-slug-update')}}" method="post">
                                              @csrf                         
                                                <div class="blog-slug-2 d-inline-flex">
                                                       <p style="margin:7px 0">{{route('front.index')}}/</p>
                                                        <input style="width: auto;" id="blog-slug-in" name="slug" type="text" class="form-control" value="{{$blogpgSlug->slug}}" placeholder="Enter Slug" disabled="">
                                                        <input type="hidden" id="blog-slug-hid" value="{{$blogpgSlug->slug}}">

                                                    <span class="input-group-btn btn-right">
                                                        <button id="blog-slug" class="btn green-haze" type="submit">Edit Slug!</button>
                                                        
                                                    </span>
                                                </div>
                                              </form>
                                           
                                        </div>

                                    </div>
                                    <div class="actions">
                                                <div class="btn-group">
                                                  <a class="btn default disabled" id="c-rp-ttl" style="margin-right: 10px;" data-toggle="modal" href="#basic" >Bulk Edit <span class="ed-rc-ttl">0</span> Blogs</a>
                                                 </div>

                                                <div class="btn-group">
                                                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-article-create')}}"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                         
                                    </div>
                                </div>
                                @include('includes.admin.form-both')

                                <div class="row">

                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control filter-input" placeholder="Name" data-id="column-1">
                                    </div>                                     
                                  </div>

                                  <div class="col-md-3">

                                    <div class="form-group">
                                      <label >Category</label>
                                      <select class="form-control filter-select" data-id="column-2">
                                            <option selected="" value="">All Categories</option>
                                            @foreach($blog_cats as $blog_cat)
                                            <option value="{{$blog_cat->name}}">{{$blog_cat->name}}</option>
                                            @endforeach
                                      </select>  
                                    </div>
                                                                      
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Publish Date</label>
                                       <input type="date" placeholder="Date" class="form-control filter-select" data-id="column-3" >
                                    </div>                                     
                                  </div>
                                </div>

                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-custom">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="geniustable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                      <label class="mt-checkbox mt-checkbox-outline">
                                                          <input type="checkbox" id="master_select"  > 
                                                          <span></span>
                                                      </label>
                                                    </th>
                                                   
                                                    <th id="column-1"> Title</th>
                                                    <th id="column-2"> Category</th>
                                                    <th id="column-3"> Publish Date </th>
                                                    <th> Photo</th>
                                                    <th> Views</th>
                                                    <th> Status </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>

                    </div>
    </div>
    <!-- END CONTENT BODY -->

     <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Bulk Edit <span class="ed-rc-ttl"></span> Blog </h4>
                </div>
                <form id="bulk-edit-form" action="{{route('admin-blog-bulkedit')}}" method="post">
                  @csrf
                  <div class="modal-body"> <b>Select an action to perform:</b>
                      <input type="hidden" id="data-idt" name="data_ids" value="">
                      <div class="mt-radio-list">

                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios23" data-id="ch-cat" value="1" > Change Category
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios24" data-id="ch-status" value="2" > Change Status
                              <span></span>
                          </label>
                          
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" data-id="pbl-date" id="optionsRadios26" value="3" > Change Publish Date
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input data-id="upl-date" type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios25" value="4" > Change Updated date
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input data-id="ps-sc-date" type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios27" value="5" > Change Post Scheduled Date
                              <span></span>
                          </label>


                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios28" value="6" > Delete Blogs
                              <span></span>
                          </label> 

                      </div>
                      <b class="ac-opt" >Action Options:</b>

                     <div class="row mdr-hide" id="ch-cat"> 
                          <label class="col-md-3 control-label fw-200" >Change Category</label>
                          <div class="col-md-4 d-inline-flex">

                            <select  id="cat-req" name="category_id"  class="form-control">
                              <option value="">{{ __('Select Category') }}</option>
                                @foreach(App\Models\BlogCategory::where('status',1)->get() as $cat)
                                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select> 
         
                          </div>
                      </div>

                      <div class="row mdr-hide" id="pbl-date"> 

                          <div class="mt-checkbox-list" style="margin-left: 15px;">
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" id="publish-check" name="publish_check"  value="9"> Remove Publish Date
                                <span></span>
                            </label>
                          </div>
                          <div class="" id="custom-publish-date">
                            <label class="col-md-3 control-label fw-200" >Publish Date</label>
                            <div class="col-md-4 d-inline-flex">
                                <input class="input-group form-control pb-date form-control-inline" type="date" value="01/08/2016" name="publish_date" id="" > 
           
                            </div>
                          </div>
                      </div>  
                      <div class="row mdr-hide" id="upl-date"> 
                          <div class="mt-checkbox-list" style="margin-left: 15px;">
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" id="updated-check" name="updated_check"  value="9"> Remove Updated Date
                                <span></span>
                            </label>
                          </div>
                          <div class="" id="custom-updated-date">
                            <label class="col-md-3 control-label fw-200" >Updated Date</label>
                            <div class="col-md-4 d-inline-flex">
                                <input class="input-group up-date form-control form-control-inline" type="date" value="01/08/2016" name="updated_date" id="" > 
           
                            </div>
                          </div>
                      </div>
                      <div class="row mdr-hide" id="ps-sc-date">
                        <div class="row" style="margin-left: 15px;"> 

                                <label class="col-md-3 control-label"  >Post Schedule</label>
                                <div class="col-md-6 d-inline-flex">
                                    <input class="input-group form-control form-control-inline" type="datetime-local" id="post-schedule" name="post_schedule" > 
               
                                </div>
                            </div>    
                      </div>


                      <div class="row mdr-hide" id="ch-status"> 
                          <div class="mt-radio-list" style="margin-left: 15px;">
                               <label class="mt-radio ">
                              <input type="radio" name="status"  value="1" checked> Activate
                              <span></span>
                          </label>
                          <label class="mt-radio ">
                              <input type="radio"  name="status" value="0">Deactivate
                              <span></span>
                          </label>
                          </div>
                      </div>


                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                      <button type="submit" id="bulk-edit-save" class="btn green">Save changes</button>
                  </div>
                </form>



            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
@section('pagelevel_scripts')



    <script src="{{ asset('assets/admin_assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin_assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        
    {{-- DATA TABLE --}}

<script type="text/javascript">
        var table = $('#geniustable').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-article-datatables') }}',
               columns: [
                        { data: 'select', name: 'select', searchable: false, orderable: false },
                        { data: 'title', name: 'title' },
                        { data: 'category_id', name: 'category_id' },
                        { data: 'publish_date', name: 'publish_date' },
                        { data: 'photo', name: 'photo' , searchable: false, orderable: false},
                        
                        { data: 'views', name: 'views' },
                        { data: 'status', searchable: false, orderable: false},
                        { data: 'action', searchable: false, orderable: false }


                     ],
                language : {
                        processing: '<div class="preloader"  style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center ;"></div>'
                    },
                 drawCallback: function (oSettings) {


                        $("#master_select").prop('checked', false); 
                        $('#c-rp-ttl').addClass('disabled');
                        $('.ed-rc-ttl').text('0');


                        $('.sub_select').on('click', function(e) {
                          var numberOfChecked = $('.sub_select:checked').length;
                          var totalCheckboxes = $('.sub_select:checkbox').length;
                          $('.ed-rc-ttl').text(numberOfChecked);
                          if(numberOfChecked>0){
                            $('#c-rp-ttl').removeClass('disabled');
                          }
                          else{
                            $('#c-rp-ttl').addClass('disabled');
                          }




                          if(numberOfChecked==totalCheckboxes){
                            $("#master_select").prop('checked', true); 
                          }
                          else{
                            $("#master_select").prop('checked', false); 
                          }

                        });

                        $("[data-toggle=confirmation]").confirmation({                        
                            onConfirm: function(event, element) {
                                $.ajax({
                                     type:"GET",
                                     url:$(this).attr('data-href'),
                                     success:function(data)
                                     {
                                          toastr.success(data);
                                          table.ajax.reload();
                                     }
                                });
                            }
                        })
                    }
            });

    {{-- DATA TABLE ENDS--}}
</script>

<script type="text/javascript">
        // Today's Date in datetimepicker Javascript
    // var today = new Date();
    // var dd = today.getDate();
    // var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    // var yyyy = today.getFullYear();
    // if(dd<10){
    //   dd='0'+dd
    // } 
    // if(mm<10){
    //   mm='0'+mm
    // } 

    // today = yyyy+'-'+mm+'-'+dd;
    // // document.getElementById("pb-date").setAttribute("min", today); 
    // document.getElementById("pb-date").setAttribute("value", today);

    // Today's Date in datetimepicker Javascript ends
</script>


<script type="text/javascript">
   
  $(document).ready(function () {
    $("#post-schedule").setNow();
    $('.filter-input').keyup( function() {
      table.column('#'+$(this).attr('data-id')).search( $(this).val() ).draw();
    } );

    $('.filter-select').change( function() {
      table.column('#'+$(this).attr('data-id')).search( $(this).val() ).draw();
    } );

     $('#blog-slug').on('click', function(e) {
      e.preventDefault();
      if($('#blog-slug-in').is(":disabled")){
         $('#blog-slug-in').prop('disabled',false);
         $(this).text('Save');
      }
      else{
        $('#blogSlugUpdate').submit();
      }


     });     

        $('#master_select').on('click', function(e) {
          
         if($(this).is(':checked',true))  
         {
            $(".sub_select").prop('checked', true);
            var numberOfChecked = $('.sub_select:checked').length;
            $('.ed-rc-ttl').text(numberOfChecked);
            if(numberOfChecked>0){
              $('#c-rp-ttl').removeClass('disabled');
            }
            else{
              $('#c-rp-ttl').addClass('disabled');
            }

         } else {  
            $(".sub_select").prop('checked',false);  
            var numberOfChecked = $('.sub_select:checked').length;
            $('.ed-rc-ttl').text(numberOfChecked);
            if(numberOfChecked>0){
              $('#c-rp-ttl').removeClass('disabled');
            }
            else{
              $('#c-rp-ttl').addClass('disabled');
            }
         }  
        });
    });

  $(document).ready(function () {


      $('.bulkEditRadio').on('change',function () {

         if($(this).attr('data-id')=='ch-cat'){
           $('#cat-req').prop('required',true);
         }
         else{
            $('#cat-req').prop('required',false);
         }
          $('.mdr-hide').hide(); 
           var id=$(this).attr('data-id');
           if(id){
            $('.ac-opt').show();
           }
           else{
            $('.ac-opt').hide();
           }
           $('#'+id).show();
        });
  });


  $(document).on('submit','#bulk-edit-form',function(e){
    e.preventDefault();
    var allVals = [];  
    $(".sub_select:checked").each(function() {  
        allVals.push($(this).attr('data-id'));
    });

    if(allVals.length <=0)  
    {  
        alert("Please select row.");  
    }  else {  

            var join_selected_values = allVals.join(","); 
             $('#data-idt').val(join_selected_values);
              if(admin_loader == 1)
                {
                $('.submit-loader').show();
              }

              $.ajax({
               method:"POST",
               url:$(this).prop('action'),
               data:new FormData(this),
               contentType: false,
               cache: false,
               processData: false,
                 success:function(data)
                 {
                      table.ajax.reload();

                      if(admin_loader == 1)
                      {
                        $('.submit-loader').hide();
                      }

                    if ((data.errors)) {
                      $('.alert-success').hide();
                      $('.alert-info').hide();
                      $('.alert-danger').show();
                      $('.alert-danger ul').html('');
                        
                          $('.alert-danger ul').html(data.errors);
                        
                        $('#basic').modal('hide');
                    }
                    else{
                      $('.alert-danger').hide();
                      $('.alert-success').show();
                      $('.alert-success p').html(data);
                      $('#basic').modal('hide');
                    }



                 }
                });
    }

  });
</script>

<script>
    $(document).ready(function()
    {
        $("#publish-check").on( "change", function() {
            if(this.checked){
             $('#custom-publish-date').addClass('custom-publish-date');
            }
            else{
              $('#custom-publish-date').removeClass('custom-publish-date');                            
            }

          });
          $("#updated-check").on( "change", function() {
            if(this.checked){
             
             $('#custom-updated-date').addClass('custom-updated-date');

            }
            else{
              $('#custom-updated-date').removeClass('custom-updated-date');
     
            }

          });

    })
</script>

@endsection

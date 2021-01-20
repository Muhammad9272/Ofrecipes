@extends('admin.layouts.app')

@section('page_content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
                                        
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i  class="fa fa-list"></i>
                                        <span class="caption-subject  sbold uppercase">Recipes</span>


                                    </div>
                                    <div class="actions">
                                               

                                                <div class="btn-group">
                                                  <a class="btn default disabled" id="c-rp-ttl" style="margin-right: 10px;" data-toggle="modal" href="#basic" >Bulk Edit <span class="ed-rc-ttl">0</span> recipes</a>

                                                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-recipe-create')}}"> Add New
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
                                      <label >Course</label>
                                      <select class="form-control filter-select" data-id="column-2">
                                            <option selected="" value="">All Courses</option>
                                            @foreach($coursess as $course)
                                            <option value="{{$course->name}}">{{$course->name}}</option>
                                            @endforeach
                                      </select>  
                                    </div>
                                                                      
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label >Cuisine</label>
                                      <select class="form-control filter-select" data-id="column-3" >
                                            <option selected="" value="" >All Cuisines</option>
                                            @foreach($cuisiness as $cuisine)
                                            <option value="{{$cuisine->name}}">{{$cuisine->name}}</option>
                                            @endforeach
                                          </select>  
                                    </div>                                                                        
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Publish Date </label>
                                       <input type="date" placeholder="Date" class="form-control filter-select date-clear" data-id="column-4" >
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
                                                   
                                                    <th id="column-1" class="select-filter">Name</th>
                                                    <th id="column-2" >Courses</th>
                                                    <th id="column-3">Cuisines</th>                                                   
                                                    <th id="column-4">Publish Date</th>
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



  <!--Higlight Recipe /.modal -->
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Highlight Recipe</h4>
                </div>

                <div class="ajax-d-content">
                  <div class="ajax-loader" style="padding: 15px;text-align: center;">
                    <img src="{{asset('assets/admin_assets/global/img/loading-spinner-grey.gif')}}" alt="" class="loading">
                            <span> &nbsp;&nbsp;Loading... </span>
                  </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->

    <!-- modal -->
     <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Bulk Edit <span class="ed-rc-ttl"></span> recipes </h4>
                </div>
                <form id="bulk-edit-form" action="{{route('admin-recipe-bulkedit')}}" method="post">
                  @csrf
                  <div class="modal-body"> <b>Select an action to perform:  </b><span>(Only One action will be implemented at once)</span>
                      <input type="hidden" id="data-idt" name="data_ids" value="">
                      <div class="mt-radio-list">
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" data-id="autr-dis" id="optionsRadios22" value="1" > Change Display Author
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" data-id="serv-ppl" id="optionsRadios23" value="2" > Change Servings
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios24" data-id="ch-status" value="3" > Change Status
                              <span></span>
                          </label>
                          
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" data-id="pbl-date" id="optionsRadios25" value="4" > Change Publish Date
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input data-id="upl-date" type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios26" value="5" > Change Updated date
                              <span></span>
                          </label>
                          <label class="mt-radio mt-radio-outline">
                              <input data-id="ps-sc-date" type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios27" value="6" > Change Post Scheduled Date
                              <span></span>
                          </label>

 
                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios28" data-id="rc-highlight" value="7"  > Highlight Recipe
                              <span></span>
                          </label>

                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios29" value="8" > Delete Recipes
                              <span></span>
                          </label> 

                      </div>
                      <b class="ac-opt" >Action Options:</b>
                      <div class="mdr-hide" id="autr-dis" >
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
                      </div>
                      

                      <div class="row mdr-hide" id="serv-ppl"> 

                          <label class="col-md-3 control-label" >Servings</label>
                          <div class="col-md-2 d-inline-flex">
                              <input type="number" class="form-control" value="1"  name="serving" min="1" required="">  
         
                          </div>
                          <div class="col-md-2 d-inline-flex">
                              <input type="text" class="form-control"  name="serving_text" placeholder="People">  
         
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

                      <div class="row mdr-hide" id="rc-highlight"> 
                          <div class="mt-checkbox-list" style="margin-left: 15px;">
                          <label class="mt-checkbox mt-checkbox-outline">
                              <input type="checkbox" name="is_featured"  value="1"> Featured Recipe
                              <span></span>
                          </label>
                          <label class="mt-checkbox mt-checkbox-outline">
                              <input type="checkbox"  name="is_trending" value="1"> Trending Recipe
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
    <!-- /.modal -->



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
               ajax: '{{ route('admin-recipe-datatables') }}',
               columns: [
               { data: 'select', name: 'select', searchable: false, orderable: false },
               { data: 'name', name: 'name' },
               { data: 'recipes_id', name: 'recipes_id' },
               { data: 'cuisines_id', name: 'cuisines_id' },
               

               { data: 'publish_date', name: 'publish_date' },
               { data: 'photo', name: 'photo' , searchable: false, orderable: false },
               { data: 'views', name: 'views' },
               { data: 'status', name: 'status' , searchable: false, orderable: false },
               { data: 'action', name: 'action' , searchable: false, orderable: false },
                        


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
 

<!-- Bulk edit check box -->
<script type="text/javascript">


   
    $(document).ready(function () {

       $("#post-schedule").setNow();
       $('#geniustable_filter input').addClass('custom-search-op');


        $('.filter-input').keyup( function() {
          table.column('#'+$(this).attr('data-id')).search( $(this).val() ).draw();
        } );

        $('.filter-select').change( function() {
          table.column('#'+$(this).attr('data-id')).search( $(this).val() ).draw();
        } );
        
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
</script>
<!-- Bulk edit check box ends -->



<!-- Bulk edit modal  -->
<script type="text/javascript">

  $(document).ready(function () {


      $('.bulkEditRadio').on('change',function () {

          $('.mdr-hide').hide(); 
            $('#custom-athr-1 input').prop("required", false);
           var id=$(this).attr('data-id');

           if(id){
            $('.ac-opt').show();
           }
           else{
            $('.ac-opt').hide();
           }
           $('#'+id).show();
        });

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
    }

      else {  

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
<!-- Bulk edit modal ends  -->


<script>
    $(document).ready(function()
    {
        $("#publish-check").on( "change", function() {
            if(this.checked){
             $('#custom-publish-date').addClass('custom-publish-date');
              // $('.pb-date').attr('required',false);
            }
            else{
              $('#custom-publish-date').removeClass('custom-publish-date');
             // $('.pb-date').attr('required',true);
              
                            
            }

          });
          $("#updated-check").on( "change", function() {
            if(this.checked){
             
             $('#custom-updated-date').addClass('custom-updated-date');
                 // $('.up-date').attr('required',false);
            }
            else{
              $('#custom-updated-date').removeClass('custom-updated-date');
             // $('.up-date').attr('required',true);
                         
            }

          });

    })
</script>

@endsection
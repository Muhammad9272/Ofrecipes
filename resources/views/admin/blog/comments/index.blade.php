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
                                        <i  class="fa fa-list"></i>
                                        <span class="caption-subject  sbold uppercase">Blog Comments</span>

                                    </div>
                                    <div class="actions">
                                                <div class="btn-group">
                                                  <a class="btn default disabled" id="c-rp-ttl" style="margin-right: 10px;" data-toggle="modal" href="#basic" >Bulk Edit <span class="ed-rc-ttl">0</span> Blog Comments</a>
                                                 </div>

                                                
                                    </div>
                                </div>
                                @include('includes.admin.form-both')


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
                                                   
                                                    <th > Comment</th>
                                                    
                                                    <th>User Email</th>
                                                    <th>Blog Title</th>
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
    <!-- END CONTENT BODY -->

     <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Bulk Edit <span class="ed-rc-ttl"></span> Comments </h4>
                </div>
                <form id="bulk-edit-form" action="{{route('admin-blog-comment-bulkedit')}}" method="post">
                  @csrf
                  <div class="modal-body"> <b>Select an action to perform:</b>
                      <input type="hidden" id="data-idt" name="data_ids" value="">
                      <div class="mt-radio-list">

                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios24" data-id="ch-status" value="2" > Change Status
                              <span></span>
                          </label>
                          

                          <label class="mt-radio mt-radio-outline">
                              <input type="radio" class="bulkEditRadio" name="bulkEditRadios" id="optionsRadios27" value="5" > Delete Comments
                              <span></span>
                          </label> 

                      </div>
                      <b class="ac-opt" >Action Options:</b>

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
               ajax: '{{ route('admin-article-datatablesComment') }}',
               columns: [
                        { data: 'select', name: 'select', searchable: false, orderable: false },
                        { data: 'comment', name: 'comment' },
                        { data: 'email', name: 'email' },
                        { data: 'blog_id', name: 'blog_id' },

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
   
  $(document).ready(function () {

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

<script type="text/javascript">
    $(document).ready(function () {


      $('.bulkEditRadio').on('change',function () {
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

@endsection

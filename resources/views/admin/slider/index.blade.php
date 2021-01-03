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
                                        <i class="fa fa-list"></i>
                                        <span class="caption-subject  sbold uppercase">Website Sliders</span>
                                    </div>

                                    <div class="actions">

                                                <div class="btn-group">
                                                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-sl-create')}}"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                         
                                    </div>
                                </div>
                                @include('includes.admin.form-both')
                                <div class="portlet-body">
                                     
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-light">
                                            <thead>
                                                <tr>
                                                    
                                                    <th> Title</th>

                                                    <th> Photo</th>
                                                    
                                                    <th> Status </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datas as $key=>$data)

                                                <tr >
                                                    
                                                    <td>{{$data->title?$data->title:'No Title'}}</td>
                                                    <td style="width: 30%"><img class="img-thumbnail" src="{{asset('assets/images/sliders/'.$data->photo)}}"> </td>
                                                    
                                                    <td>
                                                        @if($data->status==1)
                                                        <span class="label label-sm label-success">Active</span>
                                                        @else
                                                        <span class="label label-sm label-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td><a href="{{route('admin-sl-edit',$data->id)}}" class="btn btn-outline  btn-sm blue">
                                                            <i class="fa fa-edit"></i> Edit </a>

                                                            <a href="{{route('admin-sl-delete',$data->id)}}" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-id="{{ $data->id }}" >
                                                            <i class="fa fa-trash"></i> Delete </a>
                                                        </td>

                                                    
                                                </tr>
                                                @endforeach
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
@endsection


@section('pagelevel_scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
{{-- <script type="text/javascript">
    
$(document).ready(function () {

 $("body").on("click","",function(e){

    if(!confirm("Do you really want to do this?")) {
       return false;
     }

    e.preventDefault();
    var id = $(this).data("id");  
    // var id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url = e.target;

    $.ajax(
        {
          url: url.href, //or you can use url: "company/"+id,
          type: 'DELETE',
          data: {
            _token: token,
                id: id
        },
        success: function (response){

            $("#success").html(response.message)

            Swal.fire(
              'Success!',
              'Data deleted successfully!',
              'success'
            )
            // location.reload();
        }

     });
      return false;
   });
    

});

</script> --}}
@endsection



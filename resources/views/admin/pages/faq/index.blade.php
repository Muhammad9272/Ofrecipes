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
                                        <span class="caption-subject sbold uppercase">Faq Page   </span>
                                    </div>
                                    <div class="actions">

                                                <div class="btn-group">
                                                    <a id="sample_editable_1_new" class="btn sbold green" href="{{route('admin-faqs-create')}}"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                         
                                    </div>
                                </div>
                                @include('includes.admin.form-both')
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-custom">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="geniustable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Title</th>
                                                    <th>Status</th>
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
@endsection
@section('pagelevel_scripts')

</script>

    <script src="{{ asset('assets/admin_assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin_assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        
    {{-- DATA TABLE --}}

        <script type="text/javascript">



            var table = $('#geniustable').DataTable({
                   ordering: true,
                   processing: true,
                   serverSide: true,
                   searchable:true,
                   order: [[0, 'asc']],
                   ajax: '{{ route('admin-faqs-datatables') }}',
                   columns: [
                            { data: 'title', name: 'title' },
                            
                            
                            { data: 'status', searchable: false, orderable: false},
                            { data: 'action', searchable: false, orderable: false }

                         ],
                    language : {
                        processing: '<div class="preloader"  style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center ;"></div>'
                    },
                    drawCallback: function (oSettings) {
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



@endsection
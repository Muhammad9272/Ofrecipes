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
                                        <span class="caption-subject  sbold uppercase">{{ __("Subscribers") }}</span>
                                        
                                    </div>
                                    <div class="actions">

                                                <div class="btn-group">
                                                    <a id="sample_editable_1_new" class="dt-button buttons-pdf buttons-html5 btn green btn-outline" href="{{route('admin-subs-download')}}">
                                                        <i class="fa fa-download"></i>
                                                        Download CSV
                                                        
                                                    </a>
                                                </div>
                                         
                                    </div>
                                </div>
                                @include('includes.admin.form-both')
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-custom">
                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                   
                                                   <th>{{ __("#Sl") }}</th>
                                                   <th>{{ __("Email") }}</th>
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
        <script src="{{ asset('assets/admin_assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin_assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        
{{-- DATA TABLE --}}

    <script type="text/javascript">

        $('#example').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-subs-datatables') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'email', name: 'email' }
                     ],
                language : {
                    processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

{{-- DATA TABLE ENDS--}}
</script>

@endsection

<meta charset="utf-8" />
<title>Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="BloodPressure Calculator Admin" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->




     
 <link href="{{asset('assets/admin_assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/admin_assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('pagelevel_cssplugins')
@show
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{ asset("assets/admin_assets/global/css/components.min.css") }}" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="{{ asset('assets/admin_assets/layouts/layout4/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/layouts/layout4/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
<link href="{{ asset("assets/admin_assets/layouts/layout4/css/custom.min.css") }}" rel="stylesheet" type="text/css" />
<link href="{{ asset("assets/admin_assets/custom.css") }}" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->

<link href="{{ asset('assets/admin_assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />

<!-- BEGIN PAGE LEVEL STYLES -->
@section("pagelevel_styles")
@show
<!-- END PAGE LEVEL STYLES -->

<link rel="shortcut icon" href="{{ asset('assets/admin_assets/favicon.ico') }}" />


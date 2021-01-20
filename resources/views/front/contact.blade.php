@extends('front.layouts.app')
@section('title', 'Contact — ')
@section('page_content')
    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          
          <li class="text-white">Contact</li>
           
        </ul>
      </div>
    </div>

    <div class="ps-page--blog">
      <div class="container def-pad">

        <div class="row mt-50">
        	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-100">
			    <div class="ps-contact-form">
                     <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

			          <form class="ps-form--contact-us" id="contactform" action="{{route('front.contact.submit')}}" method="POST">
			          	@csrf
			            <h3>Contact Us For Any Questions</h3>
			             <div style="padding: 20px;">@include('includes.admin.form-both')</div>
			            <div class="row contact-rc">
			                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
			                            <div class="form-group">
			                              <input class="form-control ppn" required="" name="name" type="text" placeholder="Name *">
			                            </div>
			                          </div>
			                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
			                            <div class="form-group">
			                              <input class="form-control ppn" required="" name="email" type="text" placeholder="Email *">
			                            </div>
			                          </div>
			                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
			                            <div class="form-group">
			                              <input class="form-control ppn" name="subject" type="text" placeholder="Subject ">
			                            </div>
			                          </div>

                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
			                            <div class="form-group">
			                              <input class="form-control ppn" name="phone" type="text" placeholder="Phone No. ">
			                            </div>
			                          </div>


			                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
			                            <div class="form-group">
			                              <textarea class="form-control ppn " required="" name="text" rows="5" placeholder="Message"></textarea>
			                            </div>
			                          </div>

			                          
                                     
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

						                  <div class="form-group">
						                      <label for="password" class=" control-label">Captcha</label>


						                      <div class="col-md-4">
						                          <div class="captcha">
						                          <span>{!! captcha_img() !!}</span>
						                          <a data-href="{{route('load-new-captcha')}}"
						                           type="button" href="#" id="reload-cap"  class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></a>
						                          </div>
						                          <input id="captcha" type="text" class="form-control mt-20" placeholder="Enter Captcha" name="captcha">
						                      </div>
						                  </div>
					                </div>


			            </div>
			            <div class="form-group submit">
			              <button class="ps-btn submit-btn">Send message</button>
			            </div>
			          </form>
			       
			    </div>

        	</div>
	        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
  
                @include('front.layouts.sidebar')

	        </div>        	
        </div>

      </div>
    </div>


@endsection
 @section('pagelevel_scripts')
<script type="text/javascript">
    $('#reload-cap').click(function (e) {
    	e.preventDefault();
        $.ajax({
            type: 'GET',
            url:$(this).attr('data-href'),
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>
@endsection
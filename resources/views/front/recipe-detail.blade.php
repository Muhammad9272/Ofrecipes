@extends('front.layouts.app')
@section('page_content')
    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          <li><a class="" href="{{route('front.recipe.all')}}">Recipe</a></li>
          <li class="text-white">{{$data->name}}</li>
           
        </ul>
      </div>
    </div>

    

    <div id="homepage-8" >

	    <div class="ps-home-trending-products ps-section--furniture mt-100">
	        <div class="container def-pad">
	            <div class="ps-section__header" style="text-align: left;">
	              <h3 class="mb-30">{{$data->name}}</h3>
	            </div>
	            <div class="ps-blog__content">
	                <div class="blog-li-span social-sh">

	                	         @if($data->publish_check==1 && $data->publish_date)
                                    <span class="sp-txt"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{ Carbon\Carbon::parse($data->publish_date)->format('M d, Y') }}</span>
                                 @endif
                                 @if($data->updated_check==1 && $data->updated_date)
                                    <span class="sp-txt"><span class="tc-orange">Updated :</span>{{ Carbon\Carbon::parse($data->updated_date)->format('M d, Y') }}</span>
                                 @endif
	                           
	                            <span class="sp-txt ">{{count($data->reviews)}} Comments</span>
	                            @if($data->author_check!=0)
	                            <span class="sp-txt lst-n-l"><b class="ppn">BY:</b> 
	                            	<span class="sp-txt rc-auth-cl p-0">
	                            		@if($data->author_check==2)
	                            		<a class="ppn" href="{{$data->author_link}}">{{$data->author_name}}</a>
	                            		@else
	                            		<a class="ppn" href="{{$gs->author_link}}">{{$gs->author_name}}</a>
	                            		@endif
	                            	</span>
	                            </span>
	                            @endif

	                            <div class="d-inline-flex rd-social ps-product--detail" >
	                            	<div class="ps-product__sharing pd-0" >
	                            		@include('includes.social-icons')
	                            	</div>
	                              
	                            </div>
		            </div>

		            <div class="row">
		                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-20">
		                            <div class="ps-post">
			                            <div class="ps-post__content">
			                                <div class="ps-post__meta">
			                                   
			                                   <div class="blog-li-span">
					                            <div class="recip-detail-btn">
					                            	<a class="rd-btn" id="point-rc-card" href="#"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> &nbsp;To Recipe</a>
					                            	@if($data->video || $data->video_link)
					                            	<a class="rd-btn" id="point-rc-video" href="#"><i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;To Video</a>
					                            	@endif

					                            	<a class="rd-btn" id="point-rc-print" href="{{route('recipe-print',$data->slug)}}"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Print</a>
					                            </div>

			                                   </div>
			                                </div>
			                            </div>

		                                
		                            </div>
		                            <div class="ps-post mt-40 img-div" >
		                            	{!! $data->detail_desc !!}
		                            </div>

				                    <div class="row mt-100" id="pointarea-rc-card">
						            	<div class="col-12 col-md-12 col-lg-12 col-xl-12">
				                            <div class="ps-post">
				                            	<div class="recip-card">
				                            		<div class="r-card-content">
				                            			<div class="row">
				                            				<div class="col-md-8">
				                            					<h3>{{$data->name}}</h3>
				                            					
											                        @if($data->author_check==2)
								                            		<a class="text-danger mb-10 ppn" href="{{$data->author_link}}">{{$data->author_name}}</a>
								                            		@else
								                            		<a class="text-danger mb-10 ppn" href="{{$gs->author_link}}">{{$gs->author_name}}</a>
								                            		@endif
				                            					
				                            					<p class="sp-txt">
				                            						{{$data->summary}}
				                                                 </p>
				                                                 <p>
				                                               <div class="form-group form-group__rating d-inline-flex ">

									                               <div class="ps-product__rating">
									                                    <div class="ratings">
									                                        <div class="empty-stars"></div>

									                                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($data->id)}}%"></div>

									                                    </div>
									                                </div>
				                                        
				                                                    
				                                                    <span class="sp-txt"> &nbsp; {{App\Models\Rating::rating($data->id)}}
				                                                    Rating  </span>
				                                                </div>                                                 	

				                                                 </p>
				                            				</div>
				                            				<div class="col-md-4">
				                            					<div class="r-card-img">
				                            					   <img class="img-thumbnail" src="{{$data->photo?asset('assets/images/recipe/'.$data->photo):asset('assets/images/noimage.png')}}" alt="">
				                            					</div>
				                            				</div>

				                            				<div class="r-card-spacer" style="height: 25px"></div>

				                            				<div class="col-md-6">
				                            					<a class="r-card-btn" href="{{route('recipe-print',$data->slug)}}">
				                            						<i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print
				                            					</a>
				                            				</div>

				                            				<div class="mob-sp" ></div>

				                            				<div class="col-md-6">
				                            					<a class="r-card-btn" href="{{$data->pinterest?$data->pinterest:App\Models\Socialsetting::find(1)->pinterest}}">
				                            						<i class="fa fa-pinterest-p" aria-hidden="true"></i>&nbsp;
				                            						Pin
				                            					</a>
				                            				</div>
				                            			</div>

				                            			<div class="r-card-spacer" style="height: 20px"></div>

				                            			<div class="r-card-sp-icon">
				                            				<div class="dec-line"></div>
				                            				  <span><i class="fa fa-clock-o" aria-hidden="true"></i></span>
				                            				<div class="dec-line"></div>
				                            			</div>

				                            			<div class="row rc-r-1 mt-10">

				                            				<div class="col-6">
				                            					<p class="sp-txt "> PREP TIME</p>
				                            					<p class="sp-txt ">
				                            						{{$data->prep_days?
				                            							''.$data->prep_days.' days':''}} 
				                            						{{$data->prep_hours?
				                            							''.$data->prep_hours.' hours':''}} 
				                            						{{$data->prep_mins?
				                            							''.$data->prep_mins.' mins':''}}</p>
				                            				</div>
				                            				<div class="col-6">
				                            					<p class="sp-txt ">COOK TIME</p>
				                            					<p class="sp-txt ">
				                            						{{$data->cook_days?
				                            							''.$data->cook_days.' days':''}} 
				                            						{{$data->cook_hours?
				                            							''.$data->cook_days.' hours':''}} 
				                            						{{$data->cook_mins?
				                            							''.$data->cook_days.' mins':''}}
				                            					</p>
				                            				</div>                                                                        				
				                            			</div>

				                                        <div class="row rc-r-2 mt-20 text-center">                                          
				                            				<div class="col-12 col-md-6  pr-0">
						                            			<div class="r-card-sp-icon">
						                            				<div class="dec-line "></div>
						                            				  <span><i class="fa fa-fire"></i></span>
						                            				<div class="dec-line mob-rig-m"></div>
						                            			</div>
				                                                <div class="d-inline-flex mt-15">
				                                                	<div class="rc-mr">
					                                                	<p class="sp-txt"> COURSE</p>
					                            					   
							                                            <?php $arr=json_decode($data->recipes_id);?>
							                                            @if($arr && $arr!='[]' )
								                                            @foreach(App\Models\SubCategory::whereIn('id',$arr)->get() as $recipe)
								                                            @if($recipe)
								                                             <p class="sp-txt ">  
								                                             	{{$recipe->name}} 
								                                             	@if(App\Models\SubCategory::whereIn('id',$arr)->count()>1)
								                                             	 ,
								                                             	@endif
								                                             	
								                                             </p>
								                                             @endif
								                                                  
								                                            @endforeach
								                                        @else
							                                              <p class="sp-txt ">not defined</p>
								                                        @endif
					                         
					                            					     
				                            					    </div>
				                            					    <div class="rc-mr">
					                                                	<p class="sp-txt ">CUISINE</p>
												                        <?php $arr=json_decode($data->cuisines_id);?>
							                                            @if($arr && $arr!='[]' )
								                                            @foreach(App\Models\SubCategory::whereIn('id',$arr)->get() as $cuisine)
								                                            @if($cuisine)
								                                             <p class="sp-txt ">  
								                                             	
								                                             	{{$cuisine->name}} 
								                                             	@if(App\Models\SubCategory::whereIn('id',$arr)->count()>1)
								                                             	 ,
								                                             	@endif
								                                             	
								                                             </p>
								                                             @endif
								                                                  
								                                            @endforeach
								                                        @else
								                                        <p class="sp-txt ">not defined</p>
								                                            
								                                        @endif

					                            					    
				                            					    </div>
				                                                </div>
				                            				</div>
				                            				<div class="col-12 col-md-6  pl-0">
						                            		    <div class="r-card-sp-icon">
						                            				<div class="dec-line mob-left-m"></div>
						                            				  <span><i class="fa fa-cutlery"></i></span>
						                            				<div class="dec-line"></div>
						                            			</div>
				                            					<div class="d-inline-flex mt-15">
				                                                	<div class="rc-mr">
					                                                	<p class="sp-txt ">SERVINGS</p>
					                            					    <p class="sp-txt ">
					                            					    	
					                            					    	<span data-value="{{$data->serving}}" class="serve_people">{{$data->serving}}</span> 
					                            					    	{{$data->serving_text?$data->serving_text:'People'}}</p>
				                            					    </div>
				                            					    @if($data->calories)
				                            					    <div class="rc-mr">
					                                                	<p class="sp-txt ">CALORIES</p>
					                            					    <p class="sp-txt ">{{$data->calories?
					                            					    	''.$data->calories.' kcal':'not defined'}} </p>
				                            					    </div>
				                            					    @endif
				                                                </div>
				                            				</div> 
					                            		</div>                                     

				                                       @if(count($data->ingredients)>0)
				                                        <div class="rc-def rc-r-3 mt-20">
				                                            <div class="r-card-sp-icon">
				                                            	<h3 class="ppn">INGREDIENTS</h3>
					                            				<div class="dec-line ml-15"></div>
					                            				<div class="rc-in-btn">
					                            					<button class="increase-ppl active" style="border-right: 1px solid #ea5b21;" data-multiplier="1">1x</button>
					                            					<button class="increase-ppl" style="border-right: 1px solid #ea5b21;" data-multiplier="2">2x</button>
					                            					<button class="increase-ppl" data-multiplier="3">3x</button>
					                            					
					                            				</div> 
					                            				
				                            			    </div>
				                            			    <div class="rc-ul mt-20">
					                                            <ul>
					                                            	@foreach($data->ingredients as $ingredient)
					                                            	<li>
					                                            		@if($ingredient->amount)
					                                            		<span class="adjustable-val" data-value="{{$ingredient->amount}}">
					                                            			{{$ingredient->amount}}</span>
					                                            		@endif
					                                            		<span>{{$ingredient->unit}}</span> <span class="d-inline-flex">{!! $ingredient->name !!}</span>
					                                            	</li>
					                                            	@endforeach
					                                            	                                           	
					                                            </ul>
				                                            </div>
				                                        </div>
				                                        @endif
                                                        
                                                        @if($data->instruction && $data->instruction!='<br>')
				                                        <div class="rc-def rc-r-4 mt-20">
				                                            <div class="r-card-sp-icon">
				                                            	<h3 class="ppn">INSTRUCTIONS</h3>
					                            				<div class="dec-line mr-15 ml-15"></div>
					                            			</div>
					                            			 <div class="in-content rc-ul mt-20">
					                            			 	<ul>
					                            			 		{!! $data->instruction !!}
					                            			 		
					                            			 	</ul>
					                            			 </div>
					                            		</div>
					                            		@endif
                                                        @if($data->video || $data->video_link)
				                                        <div class="rc-def rc-r-5 mt-20" id="pointarea-rc-video">
				                                            <div class="r-card-sp-icon">
				                                            	<h3 class="ppn">VIDEO</h3>
					                            				<div class="dec-line  ml-15"></div>
					                            			</div>
					                            			 <div class="in-content mt-20">
					                            			 	@if($data->video)
																<video width="100%"  controls="1">
																  <source src="{{asset('assets/images/recipe_video/'.$data->video)}}" type="video/mp4">
																</video>
																@else
																<iframe width="100" height="350" 
																src="{{$data->video_link}}">
																</iframe>
																@endif
															
					                            			 </div>
					                            	    </div>
					                            	    @endif
					                            	    @if($data->notes && $data->notes!='<br>')
				                                        <div class="rc-def rc-r-6 mt-20">
				                                            <div class="r-card-sp-icon">
				                                            	<h3 class="ppn">NOTES</h3>
					                            				<div class="dec-line  ml-15"></div>
					                            			</div>
					                            			 <div class="in-content rc-ul mt-20">
					                            			 	<ul>
					                            			 		{!! $data->notes !!}
					                            			 		
					                            			 	</ul>

					                            			 </div>
					                            	    </div>
					                            	    @endif
					                            	    @if($data->nutrition && $data->nutrition!='<br>')
				                                        <div class="rc-def rc-r-6 mt-20">
				                                            <div class="r-card-sp-icon">
				                                            	<h3 class="ppn">NUTRITION</h3>
					                            				<div class="dec-line  ml-15"></div>
					                            			</div>
					                            			 <div class="in-content rc-ul mt-20">
				                                                <p class="sp-txt">
				                                                	{!! $data->nutrition !!}
				                                                </p>


					                            			 </div>
					                            		</div>
					                            		@endif
						                            	<div class="rc-r-7 mt-20">
					                                        <div class="r-card-sp-icon">
					                            				<div class="dec-line"></div>
					                            				 <i class="fa fa-search" aria-hidden="true"></i>
					                            				<div class="dec-line"></div>
					                            			</div>
					                            			<div class="in-content mt-20">
					                            				<div class="text-center">
						                            				<p class="sp-txt ">KEYWORD</p>
						                            				<p class="sp-txt ">{{$data->keywords?$data->keywords:'not defined'}}</p>
					                            				</div>
					                            				<div class="rd-end-bg">
					                            					<span class="end-icon">
					                            						<i class="fa fa-instagram" style="font-size: 60px" aria-hidden="true"></i>
					                            					</span>
					                            					<span class="end-content">
					                            						<span class="tried">Tried this recipe?</span>
					                            						<span class="ppn">
					                            							{!! $gs->recipe_tag !!}
					                            						</span>
					                            					</span>
					                            				</div>
					                            			</div>
					                            		</div>

				                            			
				                            		</div>
				                            	</div>
				                            </div>
										    <div class="ps-post-comments">

                                                @include('includes.recipe-reviews')
										        

				                                  <div class="mt-50 mb-50">
				                                  	<div class="gocover"
                                                       style="background: url({{ asset('assets/images/'.$gs->admin_loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                                    </div>
				                                    <form id="reviewform" class="ps-form--review" action="{{route('front.review.submit',$data->id)}}" method="post">
				                                    	@csrf
				                                      <h4>Submit Your Review</h4>
				                                      @include('includes.admin.form-both')
				                                      <p class="sp-txt">Your email address will not be published. Required fields are marked<sup>*</sup></p>
				                                      <div class="form-group form-group__rating">
				                                        <label class="sp-txt">Your rating of this recipe</label>
				                                                    <select required="" class="ps-rating" name="rating" data-read-only="false">
				                                                      <option value="0">0</option>
				                                                      <option value="1">1</option>
				                                                      <option value="2">2</option>
				                                                      <option value="3">3</option>
				                                                      <option value="4">4</option>
				                                                      <option value="5">5</option>
				                                                    </select>
				                                      </div>
				                                      <div class="form-group">
				                                        <textarea name="review" class="form-control ppn" required="" rows="6" placeholder="Write your review here"></textarea>
				                                      </div>
				                                      <div class="row">
				                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
				                                                      <div class="form-group">
				                                                        <input class="form-control ppn" type="text" required="" name="name" placeholder="Your Name">
				                                                      </div>
				                                                    </div>
				                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
				                                                      <div class="form-group">
				                                                        <input class="form-control ppn" type="email" required="" name="email" placeholder="Your Email">
				                                                      </div>
				                                                    </div>
				                                      </div>
				                                      <div class="form-group submit">
				                                        <button type="sumbit" class="ps-btn submit-btn">Submit Review</button>
				                                      </div>
				                                    </form>
				                                  </div>


										    </div>                         
						            	</div>		            	
						            </div>



		                        </div>
		                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                 @include('front.layouts.sidebar')


		                        </div>
		            </div>
		           		            
	            </div>

		        <div class="recip-detail-sub ps-newsletter mb-20">		        
		            <form class="recip-dtl-form ps-form--newsletter subscribeform"  id="" action="{{route('front.subscribe')}}" method="post">
		            	@csrf
			            <div class="row">
			                          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
			                            <div class="ps-form__left e-book-h">
			                              {{-- <h3>Subscribe to our newsletter</h3> --}}
			                              <p class="sp-txt">{!! $gs->newsletter !!}</p>
			                            </div>
			                          </div>
			                          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">			                          		
				                            <div class="ps-form__right">
				                                  <div class="form-row">
				                                    <div class="form-group col-md-6 pr-20 pad-r-0">
				                                      <input type="text" class="form-control custom-form-input sp-txt" id="inputEmail4" name="name" placeholder="First Name">
				                                    </div>
				                                    <div class="form-group col-md-6 pl-20 pad-l-0">
				                                      <input type="text" class="form-control custom-form-input sp-txt" id="inputPassword4" name="lname" placeholder="Last Name">
				                                    </div>
				                                  </div>
				                                  <div class="form-group">
				                                    <input type="email" class="form-control custom-form-input sp-txt" id="inputAddress" name="email" required="" placeholder="Email here">
				                                    <button class="newslatter-btn" id="sub-btn">
				                                      <i class="fa fa-arrow-right form-control-feedback" aria-hidden="true"></i>
				                                    </button>
				                                    
				                                    
				                                  </div>                              
				                            </div>
			                            
			                          </div>
			            </div>
		            </form>		        
		        </div>



	        </div>



	    </div>

    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <form id="rc-reply-form" class="reply-rec-form reply-form" action="" method="POST">
	        	{{ csrf_field() }}
		        <div class="modal-body m-10 rp-r-com">
		        
			        
			        <div class="form-row">
				        <div class="form-group col-md-6">
				            <input required="" type="text" name="name" class="form-control sp-txt" id="recipient-name" placeholder="Name">
				        </div>
				        <div class="form-group col-md-6">
				            <input required="" type="email" name="email" class="form-control sp-txt " id="recipient-email" placeholder="Email">
				        </div>
				        </div>
			            <div class="form-group">
			             <textarea required="" name="text" class="form-control sp-txt" id="message-text" placeholder="Comment..."></textarea>
			            </div>       
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button  type="sumbit" class="btn r-bg-col text-white">Send Reply</button>
			        </div>


		        </div>
	        </form>
	    </div>
	</div>
</div>


@endsection
    <!-- custom scripts-->
@section('pagelevel_scripts')    
 <script type="text/javascript">
 
  $("#point-rc-card").click(function() {
    $('html,body').animate({
        scrollTop: $("#pointarea-rc-card").offset().top},
        'slow');

   })

  $("#point-rc-video").click(function() {
    $('html,body').animate({
        scrollTop: $("#pointarea-rc-video").offset().top},
        'slow');

   })

	 // Add id in Confirm modal
	  $(document).on('click','.reply-btn',function () {
	  	    	
		var url=$(this).attr('data-href');		
	      $('#exampleModal #rc-reply-form').attr('action',url);
	  });

	  $(document).on('click','.increase-ppl',function () {
	  	$('.increase-ppl').removeClass('active');	
		$(this).addClass('active');	
		var mult=parseInt($(this).attr('data-multiplier'));
		var serve=parseInt($('.serve_people').attr('data-value'));
		$(".adjustable-val").each(function(){
           
           var orig_value=parseFloat($(this).attr('data-value'));
           // console.log(orig_value);
           var adjust_val=orig_value*mult;
           
           var valueck =parseInt(adjust_val.toFixed(2).split('.')[1]);
           if(valueck>0){
           	 $(this).text(adjust_val.toFixed(1));
           }
           else{
           	
           	$(this).text(adjust_val.toFixed());
           }           
           $('.serve_people').text(mult*serve);
         });

	      
	  });


 </script> 

<script type="text/javascript">
    $(document).ready(function(){
        $(".load-more").on('click',function(){
            var _totalCurrentResult=$(".comment-box").length;
            // Ajax Reuqest
            $.ajax({
                url:'{{ route('load-more-reviews') }}',
                type:'get',
                dataType:'json',
                data:{
                    skip:_totalCurrentResult,
                    id:'{{$data->id}}',
                },
                beforeSend:function(){
                    $(".load-more").html('Loading...');
                },
                success:function(data){
                    $(".all-comment").append(data);
                    // Change Load More When No Further result
                    var _totalCurrentResult=$(".comment-box").length;
                    var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
                    console.log(_totalCurrentResult);
                    console.log(_totalResult);
                    if(_totalCurrentResult==_totalResult){
                        $(".load-more").remove();
                    }else{
                        $(".load-more").html('Load More');
                    }
                }
            });
        });
    });
</script>

@endsection
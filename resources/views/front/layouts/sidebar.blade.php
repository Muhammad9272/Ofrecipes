                <div class="ps-post">
                    <div class="ps-post__content ">
                        <div class="ps-post__meta recip-detail">
						   {{--  <form class="ps-form--quick-search" action="index.html" method="get">
				              <input class="form-control " type="text" placeholder="Search recipe">
				              <button><i class="fa fa-search" aria-hidden="true"></i></button>
				            </form> --}}
				            <h3 class="ngmr">About me</h3>
                        </div>
                    </div>


                    <div class="ps-post__content">
                        <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="{{route('front.about')}}"></a><img src="{{asset('assets/images/about/'.$abt->photo)}}" alt="">
                        </div>	                            	
                        <p class="sp-txt mt-10">{{ Illuminate\Support\Str::limit($abt->summary, 230) }}</p>
                        <a href="{{route('front.about')}}" class="ps-post__title_read">Read more</a>
                    </div>
                </div>
                @if($sb1->status==1)
                <div class="ps-post">
           			<div class="ps-post__thumbnail">
           				<a  href="{{$sb1->link}}"><img src="{{asset('assets/images/banners/'.$sb1->photo)}}" alt=""></a>
           			</div>
           		</div>
           		@endif
           		<div class="ps-post">
           			<div class="e-book">
           				<div class="e-content">
           					<h3>Get a Free eCookbook!</h3>
           					<p class="sp-txt">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dignissim erat non velit pellentesque</p>
                             <h4 class="mt-20 mb-20">Your Details</h4>
           					<form class="e-book-form subscribeform" action="{{route('front.subscribe')}}"  method="post">
           						@csrf
           						<div class="form-row">
           						    <div class="form-group col-12">
                                      <input type="text" class="form-control empty-me sp-txt" id="inputEmail4" name="name" placeholder="Name">
                                    </div>
                                    <div class="form-group col-12 ">
                                      <input name="email" type="email" class="form-control empty-me sp-txt" required="" id="" placeholder="Email">
                                    </div>
                                    <div class="form-group col-12 ">
                                    	<button id="sub-btn" class="sp-txt">Submit</button>
                                    </div>
                                </div>
           						
           					</form>
           				</div>
           			</div>
           		</div>
           		@if($sb2->status==1)
	                <div class="ps-post">
	           			<div class="ps-post__thumbnail">
	           				<a  href="{{$sb2->link}}"><img src="{{asset('assets/images/banners/'.$sb2->photo)}}" alt=""></a>
	           			</div>
	           		</div>
           		@endif
           		<div class="ps-post recip-detail-t">
           			<h3>Trending Recipe</h3>

		            <div class="ps-section__content">
		                 <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="2" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="2" data-owl-item-lg="2" data-owl-duration="1000" data-owl-mousedrag="on">
		                        
		                        <div class="side-trn-recip">
		                        	@foreach($t_recipes as $t_recipe)
			                          <div class="ps-product">
			                            <div class="ps-product__thumbnail"><a href="{{route('front.recipe',$t_recipe->slug)}}"><img src="{{$t_recipe->photo?asset('assets/images/recipe/'.$t_recipe->photo):asset('assets/images/noimage.png')}}" alt=""></a>
			                             
			                            </div>
			                            <div class="cat-pad-sec">
			                              <div class="ps-product__content"><a class="ps-product__title" style="font-size: 13px;" href="{{route('front.recipe',$t_recipe->slug)}}">{{ Illuminate\Support\Str::limit($t_recipe->name, 50) }}</a>
			                                
			                              </div>

			                            </div>
			                          </div>

			                        @if((count($t_recipes)<5))
			                         </div><div class="side-trn-recip">
			                        @elseif ( ( ($loop->iteration % 4) == 0 ) && (!$loop->last) )
			                             </div><div class="side-trn-recip">
			                        @endif

		                           @endforeach

		                        </div>
		                       
		                          
		                </div>
		            </div>         			
           		</div>
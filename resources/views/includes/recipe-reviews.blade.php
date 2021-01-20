                    <h3 class="text-left"> <span class="ppn" id="comment_count">{{count($data->reviews->where('status',1))}}</span>  Reviews</h3>
                    <div class="all-comment">
                      @if(count($data->reviews->where('status',1))>0)
                        @foreach($data->reviews()->where('status',1)->take(8)->get() as $key=>$user)
                        
                        <div class="ps-block--comment comment-box">
                          <div class="ps-block__thumbnail"><img src="{{asset('assets/front/img/recip/user'.$key.'.png')}}" alt=""></div>
                            <div class="ps-block__content">

                                <h5 style="margin-bottom: 5px;">{{$user->name}}<small class="sp-txt">{{$data->created_at->format('M d, Y ')}}</small></h5>
                                <div class="form-group__rating mb-10">				
    	                          <div class="ratings">
    	                            <div class="empty-stars"></div>
    	                            <div class="full-stars" style="width:{{$user->rating*20}}%"></div>
    	                          </div>           
    				                </div>
                              <p class="sp-txt">{!! $user->review !!}</p>
                              <a  data-toggle="modal" data-target="#exampleModal" 
                                class="ps-block__reply sp-txt reply-btn"  data-href="{{ route('recipe.reply',$user->id) }}">Reply</a>

                                <div class="chain-reply">
                                  @foreach($user->replies()->where('status',1) as $key=>$reply)
                                    <hr>
            	                      <div class="ps-block--comment">
            						              <div class="ps-block__thumbnail"><img src="{{$key%2==0?asset('assets/front/img/recip/user1.png'):asset('assets/front/img/recip/user2.png')}}" alt=""></div>
            						              <div class="ps-block__content">
            						                <h5>{{$reply->name}}<small class="sp-txt">{{$reply->created_at->format('M d, Y ')}}</small></h5>
            						                <p class="sp-txt">{!! $reply->text !!}</p>
            						                <a  data-toggle="modal" data-target="#exampleModal" class="ps-block__reply sp-txt reply-btn"  data-href="{{ route('recipe.reply',$user->id) }}">Reply</a>
            						              </div>
            						            </div>
            						          @endforeach

                                </div>                         
                          </div>                        
                        </div>



                        @endforeach
                      @endif
                    </div>

                    @if(count($data->reviews->where('status',1))>8)
                    <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark" data-totalResult="{{ count($data->reviews) }}">Load More</button></p>
                    @endif
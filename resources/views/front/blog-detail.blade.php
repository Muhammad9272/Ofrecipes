@extends('front.layouts.app')
@section('page_content')
    <div class="ps-breadcrumb">
      <div class="container def-pad">
        <ul class="breadcrumb">
          <li><a class="" href="{{route('front.index')}}">Home</a></li>
          <li><a class="" href="{{route('front.page',$blogpgSlug->slug)}}">Blog</a></li>
          <li class="text-white">{{$data->title}}</li>
           
        </ul>
      </div>
    </div>



    <div class="ps-page--blog">
      <div class="container def-pad">

        <div class="row mt-50">
        	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-100">
        		<div>
        			<h1>{{$data->title}}</h1>
        			                              {{-- <div class="ps-post__content"> --}}
                                <div class="ps-post__meta mt-30">
                                   
                                   <div class="blog-li-span">
                                    @if($data->publish_check==1 && $data->publish_date)
                                    <span class="sp-txt"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{ Carbon\Carbon::parse($data->publish_date)->format('M d, Y') }}</span>
                                    @endif
                                    <span class="sp-txt">{{count($data->comments)}} Comments</span>
                                    <span class="sp-txt">{{$data->category->name}}</span>

                                    @if($data->updated_check==1 && $data->updated_date)
                                    <span class="sp-txt"><span class="tc-orange">Updated :</span>{{ Carbon\Carbon::parse($data->updated_date)->format('M d, Y') }}</span>
                                    @endif

                                   </div>


                                </div>
        		</div>
            <div class="mt-50">
        		{!! $data->desc !!}
            </div>
            <div class="mt-100">

                <div class="ps-post-comments">
                    
                    <h3 class="text-left"> <span class="ppn" id="comment_count">{{count($data->comments->where('status',1))}}</span>  Comments</h3>
                    <div class="all-comment">
                    @if(count($data->comments->where('status',1) )>0)
                      @foreach($data->comments()->where('status',1)->take(8)->get() as $key=>$user)
                      
                      <div class="ps-block--comment comment-box">
                        <div class="ps-block__thumbnail"><img src="{{asset('assets/front/img/recip/user'.$key.'.png')}}" alt=""></div>
                        <div class="ps-block__content">
                          <h5>{{$user->name}}<small class="sp-txt">{{$data->created_at->format('M d, Y ')}}</small></h5>
                          <p class="sp-txt">{!! $user->comment !!}</p>
                         
                        </div>
                      </div>
                      @endforeach
                    @endif
                    </div>

                    @if(count($data->comments->where('status',1) )>0 && count($data->comments->where('status',1) )>8)
                    <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark" data-totalResult="{{ count($data->comments) }}">Load More</button></p>
                    @endif

                    <div class="mt-50 mb-50">
                      <form id="comment-form" class="ps-form--review" action="{{route('front.comment.submit',$data->id)}}" method="post">
                        
                        @csrf
                        <h4>Comment</h4>
                        @include('includes.admin.form-both')
                        <p class="sp-txt">Your email address will not be published. Required fields are marked<sup>*</sup></p>

                        <div class="form-group">
                          <textarea required=""  name="comment" class="form-control ppn" rows="6" placeholder="Write your review here"></textarea>
                        </div>
                        <div class="row">
                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                        <div class="form-group">
                                          <input required="" class="form-control ppn" type="text" name="name" placeholder="Your Name">
                                        </div>
                                      </div>
                                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                        <div class="form-group">
                                          <input  required="" class="form-control email-rpeat ppn" type="email" name="email"  placeholder="Your Email">
                                        </div>
                                      </div>
                        </div>
                        <div class="form-group submit">
                          <button type="sumbit" class="ps-btn submit-btn">Submit</button>
                        </div>
                      </form>

                    </div>


                </div> 

              
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
    $(document).ready(function(){
        $(".load-more").on('click',function(){
            var _totalCurrentResult=$(".comment-box").length;
            // Ajax Reuqest
            $.ajax({
                url:'{{ route('load-more-comments') }}',
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
{{-- Ajax Script End --}}
@endsection

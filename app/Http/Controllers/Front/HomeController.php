<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\Generalsetting;
use App\Models\Partner;
use App\Models\PgAbout;
use App\Models\PgOther;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\Reply;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Routing\Route;


class HomeController extends Controller
{
    public function index()
    {
        $top_banner = Banner::where('slug','top-banner')->first();
        $bottom_banner = Banner::where('slug','bottom-banner')->first();
        $sliders=Slider::where('status',1)->get();
        $blog_latest=Article::where('status',1)->orderBy('id', 'desc')->take(4)->get();
        $blog_popular=Article::where('status',1)->orderBy('views', 'desc')->take(4)->get();
        $courses=SubCategory::where('category_id',1)->where('status',1)->get();
        $cuisines=SubCategory::where('category_id',2)->where('status',1)->get();

        $partners=Partner::all();
        $about = PgAbout::findOrFail(1);
        $date = today()->format('Y-m-d');

        $recipes=Recipe::where('status',1)->where('publish_date','<=',$date)->orderBy('id', 'desc')->take(10)->get();

    	return view('front.home',compact('top_banner','bottom_banner','sliders','blog_latest','blog_popular','courses','cuisines','partners','about','recipes'));
    }
    public function recipedetail($slug)
    {
        $date = today()->format('Y-m-d');
    	$data=Recipe::where('publish_date','<=',$date)->where('slug','=',$slug)->where('status',1)->first();
        if($data){
           $data->views = $data->views + 1;
           $data->update(); 
        }
    	return view('front.recipe-detail',compact('data'));
    }

    public function printpage($slug)
    {
        $date = today()->format('Y-m-d');
        $data=Recipe::where('publish_date','<=',$date)->where('slug','=',$slug)->where('status',1)->first();
        return view('front.recipe-print',compact('data'));
    }    

    public function blog($slug='')
    {   
        if($slug){
            $bcat=BlogCategory::where('slug',$slug)->where('status',1)->first();
            $datas=Article::where('category_id',$bcat->id)->where('status',1)->paginate(16);
            $bslg=$bcat->slug;
        }
        else{
            $datas=Article::where('status',1)->paginate(16);
            $bslg='All';
        }
        
        $b_cats=BlogCategory::where('status',1)->get();

    	return view('front.blog',compact('datas','b_cats','bslg'));
    }

    public function page($slug)
    {   
        $data=PgOther::where('slug',$slug)->where('status',1)->first();
        if($data){
           return view('front.about',compact('data')); 
        }
        else{
            return view('errors.404');
        }

        

    }

    public function blogdetail($slug)
    {  


    	$data=Article::where('slug',$slug)->where('status',1)->first();
        if($data){
           $data->views = $data->views + 1;
           $data->update(); 
        }
        
    	return view('front.blog-detail',compact('data'));
    }



    public function contact()
    {    	
    	return view('front.contact');
    }


    public function contactemail(Request $request)
    {   

        $gs = Generalsetting::findOrFail(1);


        $rules =
        [
            'name' => 'required',
            'email' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
            
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        $details = [
          'title' => 'Mail from'.$gs->web_name.' ',
          'subject' =>$request->subject ,
          'to' => $gs->to_email,
          'name' => $request->name,
          'phone' => $request->phone,
          'from' => $request->email,
          'msg' => $request->text,
         ];

        \Mail::to($gs->to_email)->send(new \App\Mail\GeniusMailer($details));        

        // Login Section Ends

        // Redirect Section
        return response()->json("Email Received.We will shortly reply you !");
    }





    public function category()
    {     
        if(\Route::current()->getName() == 'front.cuisine'){
        $datas=SubCategory::where('category_id',2)->where('status',1)->paginate(30);
        }
        else{
        $datas=SubCategory::where('category_id',1)->where('status',1)->paginate(30); 
        }
        
          
        return view('front.category',compact('datas'));
    }



    public function categorydetail($slug='')
    {   $date = today()->format('Y-m-d');
        if(\Route::current()->getName() == 'front.recipe.all'){
            $datas=Recipe::where('publish_date','<=',$date)->where('status',1)->paginate(10);
            $cat='';
            return view('front.category-detail',compact('datas','cat'));
        }

        $sub=SubCategory::where('slug',$slug)->first();
        $cat=$sub->name;
        $datas='';        
        if ($sub) {                          
            $ids=[];
            if(\Route::current()->getName() == 'front.cuisine.detail'){
               $recipes=Recipe::where('publish_date','<=',$date)->where('cuisines_id','!=',null)->where('cuisines_id','!=','')->get();
            }
            else{
               $recipes=Recipe::where('publish_date','<=',$date)->where('recipes_id','!=',null)->where('recipes_id','!=','')->get();
            }
                              
                foreach ($recipes as $data) {
                    if(\Route::current()->getName() == 'front.cuisine.detail'){
                    $r_id=json_decode($data->cuisines_id);
                    }
                    else{
                       $r_id=json_decode($data->recipes_id); 
                    }

                    if($r_id && in_array($sub->id,$r_id)){
                    $ids[]=$data->id ;                                       
                }                  
            }       
            $datas=Recipe::where('status',1)->whereIn('id',$ids)->paginate(10);
          
          }
        return view('front.category-detail',compact('datas','cat'));
    }

    public function RecipeSearch(Request $request)
    {
        $date = today()->format('Y-m-d');
       $search=$request->search;
       $datas=Recipe::where('publish_date','<=',$date)->where('name', 'like', '%' . $search . '%')->where('status',1)->paginate(10);
            $cat='';

       return view('front.category-detail',compact('datas','cat','search'));
    }
    public function about()
    {      
        $data=PgAbout::first(); 
        return view('front.about',compact('data'));
    }

    // ------------------ Rating SECTION --------------------

        public function reviewsubmit(Request $request,$id)
        {  

                $prev = Rating::where('email','=',$request->email)->get();
                if(count($prev) > 0)
                {
                return response()->json(array('errors' => [ 0 => 'You Have Reviewed Already with this email.' ]));
                }
                $Rating = new Rating;
                $input = $request->all();
                $input['recipe_id'] = $id;
                $Rating->fill($input)->save();
                $data[0] = 'Your Rating Submitted Successfully.';
                // $data[1] = Rating::rating($request->product_id);
                return response()->json($data);

        }

    // -------------------------------- PRODUCT COMMENT SECTION ----------------------------------------

        public function commentsubmit(Request $request,$id)
        {


            $prev = Comment::where('email','=',$request->email)->get();
                if(count($prev) > 0)
                {
                return response()->json(array('errors' => [ 0 => 'You Have Commented Already with this email.' ]));
                }

            $comment = new Comment;
            $input = $request->all();
            $input['blog_id'] = $id;
            $comment->fill($input)->save();
            $comments = Comment::where('blog_id','=',$id)->where('status',1)->get()->count();

            $data[0] = url('assets/front/img/recip/user9.png');
            $data[1] = $comment->name;
            $data[2] = $comment->created_at->diffForHumans();
            $data[3] = $comment->comment;
            $data[4] = $comments;
            
            return response()->json($data);
        }

        function more_data(Request $request){
            if($request->ajax()){
                $skip=$request->skip;
                $take=6;
                $comments=Comment::where('blog_id','=',$request->id)->where('status',1)->skip($skip)->take($take)->get();                
                $output='';

                foreach($comments as $key=>$data){
                    $items = Array('user1.png','user2.png','user3.png','user4.png','user5.png','user6.png','user7.png','user8.png','user9.png');
                    $image = url('assets/front/img/recip/'.$items[array_rand($items)]);
                    $output.='<div class="ps-block--comment comment-box"><div class="ps-block__thumbnail"><img src="'.$image.'" alt=""></div><div class="ps-block__content"><h5>'. $data->name .'<small class="sp-txt">'. $data->created_at->format('M d, Y ') .'</small></h5><p class="sp-txt">'.$data->comment.'</p></div></div>';
                }
                return response()->json($output);
            }else{
                return response()->json('Direct Access Not Allowed!!');
            }
        }

        function more_reviews(Request $request){
            if($request->ajax()){
                $skip=$request->skip;
                $take=6;
                $reviews=Rating::where('recipe_id','=',$request->id)->where('status',1)->skip($skip)->take($take)->get();                
                $output='';

                foreach($reviews as $key=>$data){
                    $rat=$data->rating*20;
                    $items = Array('user1.png','user2.png','user3.png','user4.png','user5.png','user6.png','user7.png','user8.png','user9.png');
                    $image = url('assets/front/img/recip/'.$items[array_rand($items)]);
                    $output.='<div class="ps-block--comment comment-box"><div class="ps-block__thumbnail"><img src="'.$image.'" alt=""></div><div class="ps-block__content"><h5>'. $data->name .'<small class="sp-txt">'. $data->created_at->format('M d, Y ') .'</small></h5>
                          <div class="form-group__rating mb-10">              
                              <div class="ratings">
                                <div class="empty-stars"></div>
                                <div class="full-stars" style="width:'.$rat.'%"></div>
                              </div>           
                            </div>
                        <p class="sp-txt">'.$data->review.'</p><a  data-toggle="modal" data-target="#exampleModal" class="ps-block__reply sp-txt reply-btn"  data-href="'.route('recipe.reply',$data->id).'">Reply</a>
                                <div class="chain-reply">';
                    foreach($data->replies as $reply){
                        $image = url('assets/front/img/recip/'.$items[array_rand($items)]);
                        $output.='<hr><div class="ps-block--comment"><div class="ps-block__thumbnail"><img src="'.$image.'" alt=""></div><div class="ps-block__content"><h5>'. $reply->name .'<small class="sp-txt">'. $reply->created_at->format('M d, Y ') .'</small></h5><p class="sp-txt">'.$reply->text.'</p><a  data-toggle="modal" data-target="#exampleModal" class="ps-block__reply sp-txt reply-btn"  data-href="'.route('recipe.reply',$data->id).'">Reply</a></div>
                                    </div>';
                    }

                   $output.= '</div></div></div>';
                }
                return response()->json($output);
            }else{
                return response()->json('Direct Access Not Allowed!!');
            }
        }





        public function reply(Request $request,$id)
        {
            $reply = new Reply;
            $input = $request->all();
            $input['rating_id'] = $id;
            $reply->fill($input)->save();
            $data[0] =url('assets/front/img/recip/user9.png');
            $data[1] = $reply->name;
            $data[2] = $reply->created_at->diffForHumans();
            $data[3] = $reply->text;
            // $data[4] = route('product.reply.delete',$reply->id);
            // $data[5] = route('product.reply.edit',$reply->id);;
            return response()->json($data);
        }

// -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
        return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json('You Have Subscribed Successfully.');
    }



}

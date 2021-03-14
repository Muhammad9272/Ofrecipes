<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Childcategory;
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
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Newsletter;
use Validator;
// use Illuminate\Routing\Route;


class HomeController extends Controller
{  
    

    public function index()
    {
        
        $time=get_local_time();
        $top_banner = Banner::where('slug','top-banner')->first();
        $bottom_banner = Banner::where('slug','bottom-banner')->first();
        $sliders=Slider::where('status',1)->get();

        $blog_latest=Article::where('status',1)->where('post_schedule','<=',$time)->where('publish_check',1)->where('publish_date','!=',null)->orderBy('publish_date','desc')->take(4)->get();

        


        $courses=SubCategory::where('category_id',1)->where('status',1)->get();
        $cuisines=SubCategory::where('category_id',2)->where('status',1)->get();

        $partners=Partner::all();
        $about = PgAbout::findOrFail(1);

        $recipes=Recipe::where('is_featured',1)->where('post_schedule','<=',$time)->where('status',1)->orderBy('publish_date', 'asc')->get();


        $recipe_latest=Recipe::where('is_featured',1)->where('post_schedule','<=',$time)->where('status',1)->where('publish_check',1)->where('publish_date','!=',null)->orderBy('publish_date','desc')->get();

         $page_no=1;
        return view('front.home',compact('top_banner','bottom_banner','sliders','blog_latest','recipe_latest','courses','cuisines','partners','about','recipes','page_no'));
    }


    public function category($slug)
    {     

        $data=Category::where('slug',$slug)->first();
        $datas=SubCategory::where('category_id',$data->id)->where('status',1)->paginate(30); 

        $page_no=2; 
        if($datas)  {
            $ad_check=$data->id==1?1:2;
            return view('front.category',compact('datas','data','page_no','ad_check'));
        }  
        else{
            return view('errors.404');
        }            
        
    }



    public function categorydetail($slug2='')
    {   
        $time=get_local_time();
        if(\Route::current()->getName() == 'front.recipe.all'){
            $datas=Recipe::where('post_schedule','<=',$time)->where('status',1)->orderBy('publish_date','desc')->paginate(10);
            $data='';
            $ad_check=1;
            return view('front.category-detail',compact('datas','data','ad_check'));
        }

        
        $sub=SubCategory::where('slug',$slug2)->first();
        $slug1=$sub->category->slug;
        $main_cat=Category::where('slug',$slug1)->first();
        $data=$sub;

        $datas='';        
        if ($sub) {                          
            $ids=[];
                
                if($main_cat->id==2){ 
                   $recipes=Recipe::where('post_schedule','<=',$time)->where('cuisines_id','!=',null)->where('cuisines_id','!=','')->get();

                    foreach ($recipes as $datawise) {
                        $r_id=json_decode($datawise->cuisines_id);

                        if($r_id && in_array($sub->id,$r_id)){
                        $ids[]=$datawise->id ;                                       
                        }
                    }

                    $ad_check=2;                  
                }
                else{

                       $recipes=Recipe::where('post_schedule','<=',$time)->where('recipes_id','!=',null)->where('recipes_id','!=','')->get();

                        foreach ($recipes as $datawise) {

                            $r_id=json_decode($datawise->recipes_id); 

                            if($r_id && in_array($sub->id,$r_id)){
                            $ids[]=$datawise->id ;                                       
                            }                  
                        } 
                    $ad_check=1;
                }
      
            $datas=Recipe::where('post_schedule','<=',$time)->where('status',1)->orderBy('publish_date','desc')->whereIn('id',$ids)->paginate(10);
          
          }
          
          if($datas){
            $page_no=3;
            return view('front.category-detail',compact('datas','data','page_no','ad_check'));
          }
          else{
            return view('errors.404');
          }
        
    }


    public function childcategorydetail($slug1,$slug2='')
    {   
        $time=get_local_time();
        if(\Route::current()->getName() == 'front.recipe.all'){
            $datas=Recipe::where('post_schedule','<=',$time)->where('status',1)->orderBy('publish_date','desc')->paginate(10);
            $data='';
            $ad_check=1;
            return view('front.category-detail',compact('datas','data','ad_check'));
        }


        

        $childcat=Childcategory::where('slug',$slug2)->first();
        $data=$childcat;
        $main_cat=$childcat->subcategory->category;
        if($main_cat->id==2){
         $ad_check=2;
        }
        else{
            $ad_check=1;
        }


        $datas='';        
                                 
               $ids=[];
               $recipes=Recipe::where('post_schedule','<=',$time)->where('childcat_id','!=',null)->where('childcat_id','!=','')->get();
               
                    foreach ($recipes as $datawise) {
                        $r_id=json_decode($datawise->childcat_id);

                        if($r_id && in_array($childcat->id,$r_id)){
                        $ids[]=$datawise->id ;                                       
                        }
                    }                
                   $datas=Recipe::where('post_schedule','<=',$time)->where('status',1)->orderBy('publish_date','desc')->whereIn('id',$ids)->paginate(10);

          
          if($datas){
            $page_no=9;
            return view('front.childcategory-detail',compact('datas','data','page_no','ad_check'));
          }
          else{
            return view('errors.404');
          }
        
    }



    public function RecipeSearch(Request $request)
    {
      $time=get_local_time();

       $search=$request->search;
       $datas=Recipe::where('post_schedule','<=',$time)->where('name', 'like', '%' . $search . '%')->where('status',1)->paginate(10);
            $data='';
       if($datas){
        $ad_check=1;
        return view('front.category-detail',compact('datas','data','search','ad_check'));
       }
       
    }


    // public function recipedetail($slug)
    // { 
    //     $time=get_local_time();
    //     if(Auth::guard('admin')->check()){
    //        $data=Recipe::where('slug','=',$slug)->first(); 
    //     }
    //     else{
    //        $data=Recipe::where('post_schedule','<=',$time)->where('slug','=',$slug)->where('status',1)->first(); 
    //     }

        
    //     if($data){
    //        $data->views = $data->views + 1;
    //        $data->update();
    //        $page_no=4; 
    //        return view('front.recipe-detail',compact('data','page_no'));
    //     }
    //     else{
    //         return view('errors.404');
    //     }
        
    // }

    public function printpage($slug)
    {
        $time=get_local_time();
        if(Auth::guard('admin')->check()){
           $data=Recipe::where('slug','=',$slug)->first(); 
        }
        else{
           $data=Recipe::where('post_schedule','<=',$time)->where('slug','=',$slug)->where('status',1)->first(); 
        }

        if($data){
           return view('front.recipe-print',compact('data'));
        }
        else{
            return view('errors.404');
        }        
    }    


    public function page($slug,$slug2='')
    {   
        $data=PgOther::where('slug',$slug)->first();
        $data2=Recipe::where('slug','=',$slug)->first();
        $time=get_local_time();
        if(isset($data) && $data->id==5){
            if($slug2){
                $bcat=BlogCategory::where('slug',$slug2)->where('status',1)->first();
                $datas=Article::where('post_schedule','<=',$time)->where('category_id',$bcat->id)->where('status',1)->orderBy('publish_date','desc')->paginate(16);
                $bslg=$bcat->slug;                
            }
            else{
                $datas=Article::where('post_schedule','<=',$time)->where('status',1)->orderBy('publish_date','desc')->paginate(16);
                $bslg='All';
            } 
            $page_no=5;           
            $b_cats=BlogCategory::where('status',1)->get();
            return view('front.blog',compact('datas','b_cats','bslg','page_no'));

        }

        else if(isset($data) && $data->status==1){
           $page_no=8;  
           return view('front.about',compact('data','page_no')); 
        }


        

        else if(isset($data2)){
               
                if(Auth::guard('admin')->check()){
                   $data=Recipe::where('slug','=',$slug)->first(); 
                }
                else{
                   $data=Recipe::where('post_schedule','<=',$time)->where('slug','=',$slug)->where('status',1)->first(); 
                }

                
                if($data){
                   $data->views = $data->views + 1;
                   $data->update();
                   $page_no=4; 
                   return view('front.recipe-detail',compact('data','page_no'));
                }

        }
        else{
            return view('errors.404');
        }

        

    }

    public function blogdetail($slug)
    {  
        $time=get_local_time();
        if(Auth::guard('admin')->check()){
           $data=Article::where('slug',$slug)->first(); 
        }
        else{
           $data=Article::where('post_schedule','<=',$time)->where('slug',$slug)->where('status',1)->first();
        }

        if($data){
           $page_no=6;
           $data->views = $data->views + 1;
           $data->update(); 
           return view('front.blog-detail',compact('data','page_no'));
        }
        else{
            return view('errors.404');
        }

        
        
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
            'captcha' => 'required|captcha'
            
        ];

        $customs = [
               'captcha.captcha' => 'Invalid captcha code '
                   ];




        $validator = Validator::make($request->all(), $rules, $customs);

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






    public function about()
    {      
        $data=PgAbout::first(); 
        $page_no=7;
        return view('front.about',compact('data','page_no'));
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
            $data[5] ="Comment created Successfully!";
            
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
                    foreach($data->replies->where('status',1) as $reply){
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
            $data[4] = "Reply Created Successfully!";
            // $data[5] = route('product.reply.edit',$reply->id);;
            return response()->json($data);
        }

// -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        // $data=Newsletter::getMember();
        // dd($data);
        $fname=$request->name;
        $lname=$request->lname;

        if (! Newsletter::isSubscribed($request->email) ) 
        {
            Newsletter::subscribeOrUpdate($request->email,['FNAME'=>$fname, 'LNAME'=>$lname]);

            $subs = Subscriber::where('email','=',$request->email)->first();
            if(!isset($subs)){        
            $subscribe = new Subscriber;
            $subscribe->fill($request->all());
            $subscribe->save();
            }
            // $api = Newsletter::getApi();
            // $data=Newsletter::getLastError();
            // dd($api);
            return response()->json('You Have Subscribed Successfully.');
        }
        else{
            return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
        }


       // if ( ! Newsletter::isSubscribed($request->email) ) 
       //  {

       //      Newsletter::subscribePending($request->email, ['FNAME'=>$request->name, 'LNAME'=>$request->lname]);
       //      return response()->json('You Have Subscribed Successfully.');
       //  }
       //  else{
       //      return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
       //  }
        // return redirect('newsletter')->with('failure', 'Sorry! You have already subscribed ');

        // $subs = Subscriber::where('email','=',$request->email)->first();
        // if(isset($subs)){
        //  return response()->json(array('errors' => [ 0 =>  'This Email Has Already Been Taken.']));
        // }
        // $subscribe = new Subscriber;
        // $subscribe->fill($request->all());
        // $subscribe->save();
        // return response()->json('You Have Subscribed Successfully.');
    }
    public function loadCaptcha($value='')
    {
        return response()->json(['captcha'=> captcha_img()]);
    }



}

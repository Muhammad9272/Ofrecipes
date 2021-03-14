<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\Generalsetting;
use App\Models\PgOther;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
class ArticleController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
     //*** JSON Request
    public function datatables()
    {
         $datas = Article::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                             ->editColumn('title', function(Article $data) {
                                $name = mb_strlen(strip_tags($data->title),'utf-8') > 50 ? mb_substr(strip_tags($data->title),0,50,'utf-8').'...' : strip_tags($data->title);
                                return 
                                '<a class="text-black" href="'. route('admin-article-edit',$data->id) .'">'.$name.'</a>';
                            })
                                ->editColumn('publish_date', function(Article $data) {
                                if($data->publish_check==1){
                                    return $data->publish_date;
                                
                                }
                                else{
                                    return '';
                                }
                                
                            })
                            ->addColumn('select', function(Article $data) {
                                return 
                                '<label class="mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" class="sub_select" data-id="'.$data->id.'" > 
                                    <span></span>
                                </label>';
                            })
                            ->editColumn('category_id', function(Article $data) {
                                
                                return $data->category->name;;
                            })
                            ->editColumn('photo', function(Article $data) {
                                $photo = $data->photo ? url('assets/images/articles/'.$data->photo):url('assets/images/noimage.png');
                                return '<img style="width:100px" class="img-thumbnail img-responsive" src="' . $photo . '" alt="Image">';
                            })
                            ->addColumn('status', function(Article $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-sm btn-circle process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-article-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-article-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('action', function(Article $data) {
                                return '<div class="action-list d-inline-flex">
                                <a href="' . route('front.blog.detail',$data->slug) . '" class="btn btn-outline  btn-sm green"> <i class="fa fa-eye"></i>Preview</a>
                                <a href="' . route('admin-article-edit',$data->id) . '" class="btn btn-outline  btn-sm blue"> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-article-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            }) 
                            ->rawColumns(['title','select','status','photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function index()
    {
        $datas = Article::orderBy('id','desc')->get();
        $blog_cats = BlogCategory::all();
        return view('admin.blog.index',compact('datas','blog_cats'));
    }

    //*** GET Request
    public function create()
    {   $cats = BlogCategory::all();
        return view('admin.blog.create',compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {

        $slug = $request->slug;
        $main = array('home','faq','contact','about');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }
        $rules = ['slug' => 'unique:articles'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $rules = [
               'photo'      => 'required:mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        //--- Logic Section
        $data = new Article();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/articles',$name);           
            $input['photo'] = $name;
        } 
        $input['publish_check']=$request->publish_check;
        $input['updated_check']=$request->updated_check;

        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Article::findOrFail($id);
        $cats = BlogCategory::all();
        return view('admin.blog.edit',compact('data','cats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Article::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/articles',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/articles/'.$data->photo)) {
                        unlink(public_path().'/assets/images/articles/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            }
 
        $input['publish_check']=$request->publish_check;
        $input['updated_check']=$request->updated_check;

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        $data[0]=1;
        $data[1]=$msg;
        $data[2]=route('front.blog.detail',$data->slug);
        return response()->json($data);      
        //--- Redirect Section Ends            
    }


    public function bulkedit(Request $request)
    {   
        $action=$request->bulkEditRadios;
        $ids = explode(',',$request->data_ids);
        if($ids && $action){
            if($action==1){
                 $data=Article::whereIn('id',$ids)
                 ->update([
                    'category_id' =>$request->category_id,                     
                ]);
             }

            if($action==2){
                 $data=Article::whereIn('id',$ids)->update(['status' =>$request->status ]);
             }


            if($action==3){
                 $data=Article::whereIn('id',$ids)
                 ->update([
                    'publish_check' =>$request->publish_check==9?0:1,
                    'publish_date' => $request->publish_date,
                ]);
             }

            if($action==4){
                 $data=Article::whereIn('id',$ids)
                 ->update([
                    'updated_check' =>$request->updated_check==9?0:1,
                    'updated_date' => $request->updated_date,
                ]);
             }
             if($action==5){

                 $data=Article::whereIn('id',$ids)
                 ->update([
                    'post_schedule' =>$request->post_schedule                    
                ]);
             }

            if($action==6){

                    $datas=Article::whereIn('id',$ids)->get();
                    foreach ($datas as $key => $data) {
                        if($data->comments->count() > 0)
                        {
                            foreach ($data->comments  as $gal) {
                                $gal->delete();
                            }
                        }
                        $data->delete();
                    }
                    
                 
             }


            $msg = 'Data Updated Successfully.';
            return response()->json($msg); 
         }  
         else{
             return response()->json(array('errors' =>'Something Went Wrong ! '));
         }     
       
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Article::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();    
        }
        // If Photo Exist
        if (file_exists(public_path().'/assets/images/articles/'.$data->photo)) {
            unlink(public_path().'/assets/images/articles/'.$data->photo);
        }
        if($data->comments->count() > 0)
        {
            foreach ($data->comments  as $gal) {
                $gal->delete();
            }
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);  
    
        //--- Redirect Section Ends     
    }

      //*** GET Request Status
    public function status($id1,$id2)
    {
        $data = Article::findOrFail($id1);
        $data->status = $id2;
        $data->update();
       
    }
    //*** POST Request
    public function updateBlogSlug(Request $request)
    {

        //--- Validation Section Ends
        $slug = $request->slug;
        $id=5;
        //--- Validation Section
        $main = array('Home','home','faq','contact','about-us');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }        
        $rules = [
            
            'slug' => 'required:unique:pg_others,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
                 ];
        $customs = [
            
            'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        //--- Logic Section
        $data = PgOther::findOrFail(5);
        $input = $request->all();

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        
        $data=$request->slug;
        return response()->json($data);      
        //--- Redirect Section Ends   


    }
    //********************Blog Comments Section*************************//

    public function datatablesComment()
    {
         $datas = Comment::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                            ->editColumn('comment', function(Comment $data) {
                               
                                return 
                                '<div style="width:230px;display:block" ><p  class="text-black" style="width:100%" >'.$data->comment.'</p></div>';
                            })
                            ->editColumn('blog_id', function(Comment $data) {
                                return 
                                 $recipe =$data->blog?$data->blog->title:'Blog Deleted' ;
                                return  $recipe;
                            })

                            ->addColumn('select', function(Comment $data) {
                                return 
                                '<label class="mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" class="sub_select" data-id="'.$data->id.'" > 
                                    <span></span>
                                </label>';
                            })

                            ->addColumn('status', function(Comment $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-sm btn-circle process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-article-statusComment',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-article-statusComment',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('action', function(Comment $data) {
                                return '<div class="action-list d-inline-flex">
                                <a data-href="'.route('admin-article-deleteComment',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            }) 
                            ->rawColumns(['comment','select','status', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function indexComment()
    {

        return view('admin.blog.comments.index');
    }
    public function destroyComment($id)
    {
        $data = Comment::findOrFail($id);

        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);  
    
        //--- Redirect Section Ends     
    }

      //*** GET Request Status
    public function statusComment($id1,$id2)
    {
        $data = Comment::findOrFail($id1);
        $data->status = $id2;
        $data->update();
       
    }
    public function bulkeditComment(Request $request)
    {   
        $action=$request->bulkEditRadios;
        $ids = explode(',',$request->data_ids);
        if($ids && $action){

            if($action==2){
                 $data=Comment::whereIn('id',$ids)->update(['status' =>$request->status ]);
             }

            if($action==5){
                 $data=Comment::whereIn('id',$ids)->delete();
             }

            $msg = 'Data Updated Successfully.';
            return response()->json($msg); 
         }  
         else{
             return response()->json(array('errors' =>'Something Went Wrong ! '));
         }     
       
    }

}

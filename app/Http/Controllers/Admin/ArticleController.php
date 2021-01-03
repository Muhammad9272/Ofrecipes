<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\BlogCategory;
use App\Models\Generalsetting;
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
                            ->editColumn('photo', function(Article $data) {
                                $photo = $data->photo ? url('assets/images/articles/'.$data->photo):url('assets/images/noimage.png');
                                return '<img class="img-thumbnail img-responsive" src="' . $photo . '" alt="Image">';
                            })
                            ->addColumn('status', function(Article $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-sm btn-circle process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-article-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-article-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('action', function(Article $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-article-edit',$data->id) . '" class="btn btn-outline  btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-article-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            }) 
                            ->rawColumns(['status','photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function index()
    {
        $datas = Article::orderBy('id','desc')->get();
        return view('admin.blog.index',compact('datas'));
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
        // if ($file = $request->file('image')) 
        //  {      
        //     $name = time().$file->getClientOriginalName();
        //     $file->move('assets/images/articles/thumb',$name);           
        //     $input['image'] = $name;
        // }

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
 

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Article::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            // $msg = 'Data Deleted Successfully.';
            // return response()->json($msg); 
            // return redirect()->route('admin-article-index')->with('status', 'Data Deleted Successfully!');      
            //--- Redirect Section Ends     
        }
        // If Photo Exist
        if (file_exists(public_path().'/assets/images/articles/'.$data->photo)) {
            unlink(public_path().'/assets/images/articles/'.$data->photo);
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

}

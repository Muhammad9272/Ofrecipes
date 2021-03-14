<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Generalsetting;
use DataTables;
use Illuminate\Support\Facades\Input;
use Validator;

class CategoryController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Category::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(Category $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-circle btn-sm process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-cat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-cat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })

                            ->addColumn('action', function(Category $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-cat-edit',$data->id) . '" class="btn btn-outline btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                
                                </div>

                                ';
                            })
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    // *** GET Request
    public function index()
    {
        $datas = Category::orderBy('id','desc')->get();
        return view('admin.category.index',compact('datas'));
    }

    //*** GET Request
    public function create()
    {
        return view('admin.category.create');
    }

    //*** POST Request
    public function store(Request $request)
    {

        $slug = $request->slug;
        $main = array('home','faq','contact');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }
        $rules = ['slug' => 'unique:categories'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        //--- Logic Section
        $data = new Category();
        $input = $request->all();
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
        $data = Category::findOrFail($id);

        return view('admin.category.edit',compact('data'));
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
        $data = Category::findOrFail($id);
        $input = $request->all();
        if($request->seo_check!=1){
            $input['seo_check']=0;
        }
        $data->update($input);
        //--- Logic Section Ends
        
        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends            
    }
          //*** GET Request Status
      public function status($id1,$id2)
      {
          $data = Category::findOrFail($id1);
          $data->status = $id2;
          $data->update();
      }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        // if($data->attributes->count() > 0)
        // {
        // //--- Redirect Section
        // $msg = 'Remove the Attributes first !';
        // return response()->json($msg);
        // //--- Redirect Section Ends
        // }

        if($data->subs->count()>0)
        {
        //--- Redirect Section
        $msg = 'Remove the subcategories first !';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
        // if($data->products->count()>0)
        // {
        // //--- Redirect Section
        // $msg = 'Remove the products first !';
        // return response()->json($msg);
        // //--- Redirect Section Ends
        // }


        //If Photo Exist
        if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
            unlink(public_path().'/assets/images/categories/'.$data->photo);
        }
        if (file_exists(public_path().'/assets/images/categories/'.$data->image)) {
            unlink(public_path().'/assets/images/categories/'.$data->image);
        }
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);

        //If Photo Doesn't Exist
    }
}

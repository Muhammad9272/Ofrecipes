<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = SubCategory::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                            ->editColumn('name', function(SubCategory $data) {
                                return 
                                '<a class="text-black" href="'. route('admin-subcat-edit',$data->id) .'">'.$data->name.'</a>';
                            })
                            ->addColumn('select', function(SubCategory $data) {
                                return 
                                '<label class="mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" class="sub_select" data-id="'.$data->id.'" > 
                                    <span></span>
                                </label>';
                            })
                            ->addColumn('category', function(SubCategory $data) {
                                return $data->category->name;
                            })
                            ->addColumn('status', function(SubCategory $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-circle btn-sm process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-subcat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-subcat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })

                            ->addColumn('action', function(SubCategory $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-subcat-edit',$data->id) . '" class="btn btn-outline  btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-subcat-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            })
                            ->rawColumns(['name','select','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.subcategory.index');
    }

    //*** GET Request
    public function create()
    {
      	$cats = Category::where('status',1)->get();
        return view('admin.subcategory.create',compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'slug' => 'unique:subcategories|regex:/^[a-zA-Z0-9\s-]+$/'
                 ];
        $customs = [
            'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        //--- Logic Section
        $data = new SubCategory();
        $input = $request->all();

        $rules = [
            'photo' => 'required|mimes:jpeg,jpg,png,svg'
                ];
        $customs = [
            'photo.required' => 'SubCategory Image is required.',
            'photo.mimes' => 'SubCategory Image Type is Invalid.'
                ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        if ($file = $request->file('photo'))
        {
           $name = time().$file->getClientOriginalName();
           $file->move('assets/images/subcategories',$name);
           $input['photo'] = $name;
        }


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
    	$cats = Category::all();
        $data = SubCategory::findOrFail($id);
        return view('admin.subcategory.edit',compact('data','cats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
        	'photo' => 'mimes:jpeg,jpg,png,svg',
        	'slug' => 'unique:subcategories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
        		 ];
        $customs = [
        	'photo.mimes' => 'Icon Type is Invalid.',
        	'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
        		   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = SubCategory::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/subcategories',$name);
            if($data->photo != null)
            {
                if (file_exists(public_path().'/assets/images/subcategories/'.$data->photo)) {
                    unlink(public_path().'/assets/images/subcategories/'.$data->photo);
                }
            }
        $input['photo'] = $name;
        }

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        $data[0]=1;
        $data[1]=$msg;
        $data[2]=route('front.category.detail',['slug1'=>$data->category->slug,'slug2'=>$data->slug]);
        return response()->json($data);      
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = SubCategory::findOrFail($id1);
            $data->status = $id2;
            $data->update();
        }

    //*** GET Request
    public function load($id)
    {
        $cat = Category::findOrFail($id);
        return view('load.subcategory',compact('cat'));
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = SubCategory::findOrFail($id);

        // if($data->products->count()>0)
        // {
        // //--- Redirect Section
        // $msg = 'Remove the products first !';
        // return response()->json($msg);
        // //--- Redirect Section Ends
        // }


        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function bulkedit(Request $request)
    {   
        $action=$request->bulkEditRadios;
        $ids = explode(',',$request->data_ids);
        if($ids && $action){
            if($action==1){
                 $data=SubCategory::whereIn('id',$ids)
                 ->update([
                    'category_id' =>$request->category_id,                     
                ]);
             }

            if($action==2){
                 $data=SubCategory::whereIn('id',$ids)->update(['status' =>$request->status ]);
             }

            // if($action==5){
            //      $data=Article::whereIn('id',$ids)->delete();
            //  }


            $msg = 'Data Updated Successfully.';
            return response()->json($msg); 
         }  
         else{
             return response()->json(array('errors' =>'Something Went Wrong ! '));
         }     
       
    }

}

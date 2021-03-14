<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class ChildCategoryController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = Childcategory::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                            ->addColumn('category', function(Childcategory $data) {
                                return $data->subcategory->category->name;
                            })
                            ->addColumn('subcategory', function(Childcategory $data) {
                                return $data->subcategory->name;
                            })
                            ->addColumn('status', function(Childcategory $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-circle btn-sm process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-childcat-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-childcat-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })

                            ->addColumn('action', function(Childcategory $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-childcat-edit',$data->id) . '" class="btn btn-outline  btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-childcat-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            })


                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    //*** GET Request
    public function index()
    {
        return view('admin.childcategory.index');
    }

    //*** GET Request
    public function create()
    {
      	$cats = Category::all();
        return view('admin.childcategory.create',compact('cats'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'slug' => 'unique:childcategories|regex:/^[a-zA-Z0-9\s-]+$/',
            'image' => 'required|mimes:jpeg,jpg,png,svg',
                 ];
        $customs = [
            'image.required' => 'Feature Image is required.',
            'image.mimes' => 'Feature Image Type is Invalid.',
            'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Childcategory();
        $input = $request->all();

        if ($file = $request->file('image'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/childcategories',$name);
            $input['image'] = $name;
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
        $subcats = Subcategory::all();
        $data = Childcategory::findOrFail($id);
        return view('admin.childcategory.edit',compact('data','cats','subcats'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {

        //--- Validation Section
        $rules = [
            
            'slug' => 'unique:childcategories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
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
        $data = Childcategory::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('image'))
        {
           $rules = [
                'image' => 'mimes:jpeg,jpg,png,svg'
                    ];
            $customs = [
                'image.mimes' => 'Feature Image Type is Invalid.',
                'image.required' => 'Feature Image is required.'
                    ];
            $validator = Validator::make($request->all(), $rules, $customs);

            if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }

            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/childcategories',$name);
            if($data->image != null)
            {
                if (file_exists(public_path().'/assets/images/childcategories/'.$data->image)) {
                    unlink(public_path().'/assets/images/childcategories/'.$data->image);
                }
            }
        $input['image'] = $name;
        }

        if($request->seo_check!=1){
            $input['seo_check']=0;
        }

        $data->update($input);
        //--- Logic Section Ends


        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        $data[0]=1;
        $data[1]=$msg;
        $data[2]=route('front.childcategory.detail',['slug1'=>$data->subcategory->slug,'slug2'=>$data->slug]);
        return response()->json($data); 
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
        {
            $data = Childcategory::findOrFail($id1);
            $data->status = $id2;
            $data->update();

        }

    //*** GET Request
    public function load($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Childcategory::findOrFail($id);


        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}

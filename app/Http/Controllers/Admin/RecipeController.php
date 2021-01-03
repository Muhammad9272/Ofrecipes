<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DataTables;
use Validator;
class RecipeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }


     //*** JSON Request
    public function datatables()
    {
         $datas = Recipe::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                            ->editColumn('photo', function(Recipe $data) {
                                $photo = $data->photo ? url('assets/images/recipe/'.$data->photo):url('assets/images/noimage.png');
                                return '<img class="img-thumbnail img-responsive" src="' . $photo . '" alt="Image">';
                            })
                            ->addColumn('status', function(Recipe $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-sm btn-circle process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-recipe-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-recipe-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('action', function(Recipe $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-recipe-edit',$data->id) . '" class="btn btn-outline  btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-recipe-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            }) 
                            ->rawColumns(['status','photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function index()
    {
        $datas = Recipe::orderBy('id','desc')->get();
        return view('admin.recipe.index',compact('datas'));
    }

    public function create($value='')
    {   
    	$courses=SubCategory::where('category_id',1)->where('status',1)->get();
    	$cuisines=SubCategory::where('category_id',2)->where('status',1)->get();
    	return view('admin.recipe.create',compact('courses','cuisines'));
    }

    public function store(Request $request)
    {   
        

        $rules = ['slug' => 'unique:recipes'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $rules = [
                   'photo'      => 'mimes:jpeg,jpg,png,svg',
                   'video'  => 'mimes:mp4,mov,ogg | max:20000',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        //--- Logic Section
        $data = new Recipe();
        $input = $request->all();

        
        if ($file = $request->file('photo')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/recipe',$name);           
            $input['photo'] = $name;
        } 
        if ($file = $request->file('video')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/recipe_video',$name);           
            $input['video'] = $name;
        }
        if($request->cuisines_id){
            $input['cuisines_id'] = json_encode($request->cuisines_id);
        }
        else{
            $input['cuisines_id']=null;
        }
        if($request->recipes_id){
            $input['recipes_id'] = json_encode($request->recipes_id);
        }
        else{
            $input['recipes_id']=null;
        }



        
        
        $data->fill($input)->save();
        //--- Logic Section Ends

        $ingredients=[];
        if($request->input('group-b')){
             foreach($request->input('group-b') as $value){
                if($value['ingrdient_name']){
                    $values['amount']=$value['ingredient_amount'];
                    $values['unit']=$value['ingrdient_unit'];         
                    $values['name']=$value['ingrdient_name'];

                    $ingredients[]=$values;
                }
                
            }
            $data->ingredients()->createMany($ingredients);   
        }
        

        //--- Redirect Section        
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends   

    }
    //*** GET Request
    public function edit($id)
    {
        $data = Recipe::findOrFail($id);
        $recipes=SubCategory::where('category_id',1)->where('status',1)->get();
        $cuisines=SubCategory::where('category_id',2)->where('status',1)->get();
        return view('admin.recipe.edit',compact('data','recipes','cuisines'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {   
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
               'slug' => 'unique:recipes,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/',
               'video'  => 'mimes:mp4,mov,ogg | max:20000',

                ];
        $customs = [
            
            'slug.unique' => 'This slug has already been taken.',
            'slug.regex' => 'Slug Must Not Have Any Special Characters.'
                   ];

        $validator = Validator::make($request->all(), $rules,$customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Recipe::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/recipe',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/recipe/'.$data->photo)) {
                        unlink(public_path().'/assets/images/recipe/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            }

            if ($file = $request->file('video')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/recipe_video',$name);
                if($data->image != null)
                {
                    if (file_exists(public_path().'/assets/images/recipe_video/'.$data->video)) {
                        unlink(public_path().'/assets/images/recipe_video/'.$data->video);
                    }
                }            
            $input['video'] = $name;
            } 
            if($request->video_link){
                $input['video'] = null;
            }

            if($request->cuisines_id){
                $input['cuisines_id'] = json_encode($request->cuisines_id);
            }
            else{
                $input['cuisines_id']=null;
            }
            if($request->recipes_id){
                $input['recipes_id'] = json_encode($request->recipes_id);
            }
            else{
                $input['recipes_id']=null;
            }




        $data->update($input);
        //--- Logic Section Ends
        $data->ingredients()->delete();
        $ingredients=[];
        if($request->input('group-b')){
             foreach($request->input('group-b') as $value){
                if($value['ingrdient_name']){
                    $values['amount']=$value['ingredient_amount'];
                    $values['unit']=$value['ingrdient_unit'];         
                    $values['name']=$value['ingrdient_name'];

                    $ingredients[]=$values;
                }
                
            }
            $data->ingredients()->createMany($ingredients);   
        }



        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends                 
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Recipe::findOrFail($id);

        // If Photo Exist
        if (file_exists(public_path().'/assets/images/articles/'.$data->photo)) {
            unlink(public_path().'/assets/images/articles/'.$data->photo);
        }
        $data->ingredients()->delete();
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);  
    
        //--- Redirect Section Ends     
    }

      //*** GET Request Status
    public function status($id1,$id2)
    {
        $data = Recipe::findOrFail($id1);
        $data->status = $id2;
        $data->update();
       
    }



}

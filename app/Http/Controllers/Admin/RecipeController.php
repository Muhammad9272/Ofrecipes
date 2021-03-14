<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Recipe;
use App\Models\SubCategory;
use App\Models\Subscriber;
use DataTables;
use Illuminate\Http\Request;
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
                            ->editColumn('name', function(Recipe $data) {
                                return 
                                '<a class="text-black" href="'. route('admin-recipe-edit',$data->id) .'">'.$data->name.'</a>';
                            })
                            ->editColumn('publish_date', function(Recipe $data) {
                                if($data->publish_check==1){
                                    return $data->publish_date;
                                
                                }
                                else{
                                    return '';
                                }
                                
                            })
                            ->addColumn('select', function(Recipe $data) {
                                return 
                                '<label class="mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" class="sub_select" data-id="'.$data->id.'" > 
                                    <span></span>
                                </label>';
                            })
                            ->editColumn('cuisines_id', function (Recipe $data) {
                                 $cuisine_id=json_decode($data->cuisines_id);
                                 if($cuisine_id){
                                    $data=SubCategory::whereIn('id',$cuisine_id)->get();
                                         return $data->map(function(Subcategory $data) {
                                
                                        return $data->name;
                                    
                                    })->implode(',');
                                 }
                                 else{
                                    return "Not added";
                                 }
                               
                            })
                            ->editColumn('recipes_id', function (Recipe $data) {
                                 $recipes_id=json_decode($data->recipes_id);
                                 if($recipes_id){
                                    $data=SubCategory::whereIn('id',$recipes_id)->get();
                                         return $data->map(function(Subcategory $data) {
                                
                                        return $data->name;
                                    
                                    })->implode(',');
                                 }
                                 else{
                                    return "Not added";
                                 }
                               
                            })
                            ->editColumn('photo', function(Recipe $data) {
                                $photo = $data->photo ? url('assets/images/recipe/'.$data->photo):url('assets/images/noimage.png');
                                return '<img class="img-thumbnail img-responsive" src="' . $photo . '" alt="Image">';
                            })
                            
                            // ->editColumn('cuisines_id', function(Recipe $data) {
                            //     $photo = $data->photo ? url('assets/images/recipe/'.$data->photo):url('assets/images/noimage.png');
                            //     return '<img class="img-thumbnail img-responsive" src="' . $photo . '" alt="Image">';
                            // })
                            ->addColumn('status', function(Recipe $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-sm btn-circle process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-recipe-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-recipe-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                            ->addColumn('action', function(Recipe $data) {
                                    return
                                    '<div class="action-list rc-action-btn">
                                        <div class="btn-group ">
                                            <button class="btn blue-hoki dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <i class="icon-settings"></i> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="'. route('front.recipe',$data->slug) .'">
                                                        <i class="fa fa-eye"></i> Preview </a>
                                                </li>
                                                <li>
                                                    <a href="'. route('admin-recipe-edit',$data->id) .'">
                                                        <i class="fa fa-trash-o"></i> Edit </a>
                                                </li>
                                                <li>
                                                    <a class="delete-data" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" data-href="'.route('admin-recipe-delete',$data->id).'" >
                                                        <i class="fa fa-times"></i> Delete </a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li >
                                                    <a data-toggle="modal" class="feature" href="#small" data-href="'.route('admin-recipe-highlight',$data->id).'"> Highlight Recipe </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>';

                            }) 
                            ->rawColumns(['select','name','status','photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side


                             
                            
    }


    //*** GET Request
    public function index()
    {
        $datas = Recipe::orderBy('id','desc')->get();
        $coursess=SubCategory::where('category_id',1)->get();
        $cuisiness=SubCategory::where('category_id',2)->get();
        
        return view('admin.recipe.index',compact('datas','coursess','cuisiness'));
    }

    public function create($value='')
    {   
        $childcats=Childcategory::where('status',1)->get();
    	$courses=SubCategory::where('category_id',1)->where('status',1)->get();
    	$cuisines=SubCategory::where('category_id',2)->where('status',1)->get();
    	return view('admin.recipe.create',compact('courses','cuisines','childcats'));
    }

    public function ImageUpload($value='')
    {
        // if ($_FILES['file']['name']) {
        //   if (!$_FILES['file']['error']) {
        //     $name = md5(rand(100, 200));
        //     $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        //     $filename = $name.
        //     '.'.$ext;
        //     $destination = '/assets/images/'.$filename; //change this directory
        //     $location = $_FILES["file"]["tmp_name"];
        //     move_uploaded_file($location, $destination);
        //     return 'http://test.yourdomain.al/images/'.$filename; //change this URL
        //   } else {
        //     echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
        //   }
        // }
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
        if($request->childcat_id){
            $input['childcat_id'] = json_encode($request->childcat_id);
        }
        else{
            $input['childcat_id']=null;
        }
        $input['publish_check']=$request->publish_check;
        $input['updated_check']=$request->updated_check;


 
       
        
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
        


        $msg = 'Data Added Successfully.';
        $data[0]=99;
        $data[1]=$msg;
        $data[2]=route('admin-recipe-edit',$data->id);

        return response()->json($data);      
        //--- Redirect Section Ends   

    }

    //*** GET Request
    public function edit($id)
    {
        $data = Recipe::findOrFail($id);
        $recipes=SubCategory::where('category_id',1)->where('status',1)->get();
        $cuisines=SubCategory::where('category_id',2)->where('status',1)->get();
        $childcats=Childcategory::where('status',1)->get();
        return view('admin.recipe.edit',compact('data','recipes','cuisines','childcats'));
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
                if($data->video != null)
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
            if($request->childcat_id){
                $input['childcat_id'] = json_encode($request->childcat_id);
            }
            else{
                $input['recipes_id']=null;
            }
            $input['publish_check']=$request->publish_check;
            $input['updated_check']=$request->updated_check;




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


        // dd($data->slug);
        //--- Redirect Section     
        $msg = 'Data Updated Successfully.';
        $data[0]=1;
        $data[1]=$msg;
        $data[2]=route('front.recipe',$data->slug); 
        return response()->json($data);     
        //--- Redirect Section Ends                 
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Recipe::findOrFail($id);
       
       if($data->photo != null)
        {
            if (file_exists(public_path().'/assets/images/recipe/'.$data->photo)) {
                unlink(public_path().'/assets/images/recipe/'.$data->photo);
            }
        } 
        if($data->video != null)
        {
            if (file_exists(public_path().'/assets/images/recipe_video/'.$data->video)) {
                unlink(public_path().'/assets/images/recipe_video/'.$data->video);
            }
        }    

        $data->ingredients()->delete();

        if($data->reviews->count() > 0)
        {
            foreach ($data->reviews  as $elements) {
                if($elements->replies->count() > 0)
                {
                    foreach ($elements->replies  as $gal) {
                        $gal->delete();
                    }
                }
                $elements->delete();
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
        $data = Recipe::findOrFail($id1);
        $data->status = $id2;
        $data->update();
       
    }

      //*** GET Request Status
    public function highlight($id)
    {
        $data = Recipe::findOrFail($id);
        return view('admin.recipe.highlight',compact('data'));
       
    }


    public function highlightupdate(Request $request,$id)
    {

        $data = Recipe::findOrFail($id);
         $input = $request->all();
            if($request->is_featured == "")
            {
                $input['is_featured'] = 0;
            }
            if($request->is_trending == "")
            {
                $input['is_trending'] = 0;
            }
        $data->update($input);
        $msg = 'Highlight Updated Successfully.';
        return response()->json($msg);
       
    }



    public function bulkedit(Request $request)
    {   

        $action=$request->bulkEditRadios;
        $ids = explode(',',$request->data_ids);
        if($ids && $action){
            if($action==1){
                 $data=Recipe::whereIn('id',$ids)
                 ->update([
                    'author_check' =>$request->author_check,
                     'author_name' => $request->author_name,
                     'author_link' => $request->author_link,
                ]);
             }

            if($action==2){
                 $data=Recipe::whereIn('id',$ids)
                 ->update([
                    'serving' =>$request->serving,
                    'serving_text' => $request->serving_text,
                ]);
             }
            if($action==3){
                 $data=Recipe::whereIn('id',$ids)->update(['status' =>$request->status ]);
             }


            if($action==4){
                 $data=Recipe::whereIn('id',$ids)
                 ->update([
                    'publish_check' =>$request->publish_check==9?0:1,
                    'publish_date' => $request->publish_date,
                ]);

             }

            if($action==5){

                 $data=Recipe::whereIn('id',$ids)
                 ->update([
                    'updated_check' =>$request->updated_check==9?0:1,
                    'updated_date' => $request->updated_date,
                ]);
             }
            if($action==6){

                 $data=Recipe::whereIn('id',$ids)
                 ->update([
                    'post_schedule' =>$request->post_schedule                    
                ]);
             }
            if($action==7){
                 $data=Recipe::whereIn('id',$ids)
                 ->update([
                    'is_featured' =>$request->is_featured?1:0,
                    'is_trending' => $request->is_trending?1:0,
                ]);
             }
            if($action==8){

               $datas=Recipe::whereIn('id',$ids)->get();
                foreach ($datas  as $data) {
                   if($data->reviews->count() > 0)
                    {
                        foreach ($data->reviews  as $elements) {
                            if($elements->replies->count() > 0)
                            {
                                foreach ($elements->replies  as $gal) {
                                    $gal->delete();
                                }
                            }
                            $elements->delete();
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


}

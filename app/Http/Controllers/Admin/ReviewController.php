<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use DataTables;
class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request
    public function datatables()
    {

         $datas = Rating::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)

                            ->editColumn('rating', function(Rating $data) {
                                $star1=$data->rating>0?'checked':'';
                                $star2=$data->rating>1?'checked':'';
                                $star3=$data->rating>2?'checked':'';
                                $star4=$data->rating>3?'checked':'';
                                $star5=$data->rating>4?'checked':'';





                                return  '<div class="rc-rt-st">
                                        <span class="fa fa-star '.$star1.' "></span>
                                        <span class="fa fa-star '.$star2.'"></span>
                                        <span class="fa fa-star '.$star3.'"></span>
                                        <span class="fa fa-star '.$star4.'"></span>
                                        <span class="fa fa-star '.$star5.'"></span>
                                </div>';
                            })

                            ->editColumn('recipe_id', function(Rating $data) {
                                $recipe =$data->recipe->name?$data->recipe->name:'Recipe Deleted' ;
                                return  $recipe;
                            })
                            ->addColumn('status', function(Rating $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-circle btn-sm process  select droplinks '.$class.'"><option data-val="1" value="'. route('admin-recipe-review-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-recipe-review-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })
                           ->addColumn('action', function(Rating $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-recipe-review-edit',$data->id) . '" class="btn btn-outline btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-recipe-review-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a>
                                </div>';
                            })
                            ->rawColumns(['rating','status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.recipe.review.index');
    }

    // //*** GET Request
    // public function create()
    // {
    //     return view('admin.review.create');
    // }

    // //*** POST Request
    // public function store(Request $request)
    // {
    //     //--- Validation Section
    //     $rules = [
    //            'photo'      => 'required|mimes:jpeg,jpg,png,svg',
    //             ];

    //     $validator = Validator::make(Input::all(), $rules);
        
    //     if ($validator->fails()) {
    //       return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
    //     }
    //     //--- Validation Section Ends

    //     //--- Logic Section
    //     $data = new Review();
    //     $input = $request->all();
    //     if ($file = $request->file('photo')) 
    //      {      
    //         $name = time().$file->getClientOriginalName();
    //         $file->move('assets/images/reviews',$name);           
    //         $input['photo'] = $name;
    //     } 
    //     $data->fill($input)->save();
    //     //--- Logic Section Ends

    //     //--- Redirect Section        
    //     $msg = 'New Data Added Successfully.';
    //     return response()->json($msg);      
    //     //--- Redirect Section Ends    
    // }

    //*** GET Request
    public function edit($id)
    {
        $data = Rating::findOrFail($id);
        return view('admin.recipe.review.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {

        //--- Logic Section
        $data = Rating::findOrFail($id);
        $input = $request->all();

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
        $data = Rating::findOrFail($id);
        //If Photo Doesn't Exist
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
      //*** GET Request Status
    public function status($id1,$id2)
    {
        $data = Rating::findOrFail($id1);
        $data->status = $id2;
        $data->update();
       
    }    


}

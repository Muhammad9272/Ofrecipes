<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PgOther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use DataTables;
class PgOtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //*** JSON Request

     //*** JSON Request
    public function datatables()
    {
         $datas = PgOther::orderBy('id','desc')->where('id','!=',5)->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)

                            ->editColumn('title', function(PgOther $data) {
                                $title = strlen(strip_tags($data->title)) > 25 ? substr(strip_tags($data->title),0,25).'...' : strip_tags($data->title);
                                return  $title;
                            })
                            ->addColumn('status', function(PgOther $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-circle process btn-sm select droplinks '.$class.'"><option data-val="1" value="'. route('admin-pgother-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-pgother-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })

                            ->addColumn('action', function(PgOther $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-pgother-edit',$data->id) . '" class="btn btn-outline  btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-pgother-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** GET Request
    public function index()
    {
        
        return view('admin.pages.other.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.pages.other.create');
    }

    //*** POST Request
    public function store(Request $request)
    {

        $slug = $request->slug;
        $main = array('home','faq','contact','blog','about-us');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }
        $rules = ['slug' => 'unique:pg_others'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        //--- Logic Section
        $data = new PgOther();
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
        $data = PgOther::findOrFail($id);

        return view('admin.pages.other.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {

        //--- Validation Section Ends
        $slug = $request->slug;
        //--- Validation Section
        $main = array('home','faq','contact','blog','about-us');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));          
        }        
        $rules = [
            
            'slug' => 'unique:pg_others,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/'
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
        $data = PgOther::findOrFail($id);
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
        $data = PgOther::findOrFail($id);

        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);    
;   
        //--- Redirect Section Ends     
    }

    public function status($id1,$id2)
    {
        $data = PgOther::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

}

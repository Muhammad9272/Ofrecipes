<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PgFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use DataTables;
class PgFaqController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

     //*** JSON Request
    public function datatables()
    {
         $datas = PgFaq::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return DataTables::of($datas)
                            ->addColumn('status', function(PgFaq $data) {
                                $class = $data->status == 1 ? 'green' : 'red';
                                $s = $data->status == 1 ? 'selected' : '';
                                $ns = $data->status == 0 ? 'selected' : '';
                                return '<div class="action-list"><select class="btn btn-circle process btn-sm select droplinks '.$class.'"><option data-val="1" value="'. route('admin-faqs-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-faqs-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            })

                            ->addColumn('action', function(PgFaq $data) {
                                return '<div class="action-list">
                                <a href="' . route('admin-faqs-edit',$data->id) . '" class="btn btn-outline  btn-sm blue""> <i class="fa fa-edit"></i>Edit</a>
                                <a data-href="'.route('admin-faqs-delete',$data->id).'" class="btn btn-outline delete-data  btn-sm red" data-toggle="confirmation" data-placement="top" data-popout="true" data-id="'.$data->id.'" >
                                    <i class="fa fa-trash"></i> Delete </a></div>';
                            }) 
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        
        return view('admin.pages.faq.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.pages.faq.create');
    }

    //*** POST Request
    public function store(Request $request)
    {

        //--- Logic Section
        $data = new PgFaq();
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
        $data = PgFaq::findOrFail($id);

        return view('admin.pages.faq.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {

        //--- Logic Section
        $data = PgFaq::findOrFail($id);
        $input = $request->all();

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
        $data = PgFaq::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }    

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = PgFaq::findOrFail($id);

        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);     

        //--- Redirect Section Ends     
    }
}

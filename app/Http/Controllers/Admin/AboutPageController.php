<?php

namespace App\Http\Controllers\Admin;

use App\Models\PgAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class AboutPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    // Spcial Settings All post requests will be done in this method
    public function update(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg,gif',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Logic Section
        $input = $request->all(); 
        $data = PgAbout::findOrFail(1); 
        if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/about',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/about/'.$data->photo)) {
                        unlink(public_path().'/assets/images/about/'.$data->photo);
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


    public function index()
    {
    	$data = PgAbout::findOrFail(1);
        return view('admin.pages.about.index',compact('data'));
    }

    
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use InvalidArgumentException;
use Validator;

class AdminController extends Controller
{
	public function __construct()
    {
      $this->middleware('auth:admin');
    }
    public function index()
    {
    	return view('admin.dashboard');
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section

        $rules =
        [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'email' => 'unique:admins,email,'.Auth::guard('admin')->user()->id
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = Auth::guard('admin')->user();
            if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/admins/',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/admins/'.$data->photo)) {
                        unlink(public_path().'/assets/images/admins/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }
        $data->update($input);
        $msg = 'Successfully updated your profile';
        return response()->json($msg);
    }
    public function gsedit()
    {
        // $data = Generalsetting::find(1);
        return view('admin.generalsettings');
    }

    public function gsupdate(Request $request)
    {
        //--- Validation Section

        $rules =
        [
            'favicon' => 'mimes:jpeg,jpg,png,svg',
            
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = Generalsetting::find(1);
            if ($file = $request->file('favicon'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/',$name);
                if($data->favicon != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$data->favicon)) {
                        unlink(public_path().'/assets/images/'.$data->favicon);
                    }
                }
            $data->favicon = $name;
            }
            if ($file = $request->file('logo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/recipe/logo/',$name);
                if($data->logo != null)
                {
                    if (file_exists(public_path().'/assets/images/recipe/logo/'.$data->logo)) {
                        unlink(public_path().'/assets/images/recipe/logo/'.$data->logo);
                    }
                }
            $data->logo = $name;
            }


         $data->title=$request->title;   
         $data->to_email=$request->email;   
         $data->author_name=$request->author_name;   
         $data->author_link=$request->author_link;
         $data->recipe_tag=$request->recipe_tag;
         $data->eCookbook=$request->eCookbook;
         $data->copyright=$request->copyright;
         $data->newsletter=$request->newsletter;

        $data->update();
        $msg = 'Successfully updated data';
        return response()->json($msg);
    }

    public function profile()
    {
        $data = Auth::guard('admin')->user();
        return view('admin.profile',compact('data'));
    }

    public function passwordreset()
    {
        $data = Auth::guard('admin')->user();
        return view('admin.password',compact('data'));
    }
    public function changepass(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if ($request->cpass){
            if (Hash::check($request->cpass, $admin->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    return response()->json(array('errors' => [ 0 => 'Confirm password does not match.' ]));
                }
            }else{
                return response()->json(array('errors' => [ 0 => 'Current password Does not match.' ]));
            }
        }
        $admin->update($input);
        $msg = 'Password Changed Successfully';
        return response()->json($msg);
    }
    



    public function keywords()
    {
        $tool = Generalsetting::find(1);
        return view('admin.seotool.meta-keywords',compact('tool'));
    }

    public function keywordsupdate(Request $request)
    {
        $tool = Generalsetting::findOrFail(1);
        $tool->meta_keys=$request->meta_keys;
        $tool->update();
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);  
    }



}

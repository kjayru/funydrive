<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Workshop;
use App\Workshoporder;
use App\Register;
use App\Service;


class EnvironmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
        
    }
   
    public function index()
    {
        $user_id = Auth::id();
        $mirol = User::navigation();

        $admin = User::find($user_id)->first();
        $servicios = Service::with('childs')->where('parent_id',NULL)->get();

        $serviceall = Service::with('childs')->where('parent_id',NULL)->get();

        return view('admin.super.entorno',['usuario'=>$mirol,'servicios'=>$servicios,'admin_id'=>$user_id,'servall'=>$serviceall,'admin'=>$admin]);
    }

    
    public function update(Request $request, $id)
    {

        if (!(Hash::check($request->oldpassword, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->oldpassword, $request->password) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $this->validate($request,[
            
            'email' => 'required|email|max:255',
            'oldpassword' => 'required|min:3',
            'password' => 'required|min:3',
            'npassword' => 'required|min:3|same:password'
        ],
        [
            'required' => 'Este campo es Obligatorio',
            
        ]);
        
        $user = User::find($id)->first();

        $admin = User::find($id);
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
       
        

        return response()->json(['rpta'=>'ok']);
    }

    

}

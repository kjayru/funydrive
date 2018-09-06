<?php
namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Workshoporder;
use App\Workshopassociationorders;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
   

   
    
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index(){
        dd("inicio ");
    }
   


    public function registrowork(Request $request){
        
      $order_id = Workshoporder::random_str('20');
      $user_id = Auth::id();
   
      $workshop = new Workshoporder;

        $workshop->user_id = $user_id;   
        $workshop->user_name = $request->user_name;
        $workshop->phone_number = $request->phone_number;
        
        $workshop->order_id = $order_id;
        $workshop->cause = $request->service;
        $workshop->detail_cause = $request->nota;
        $workshop->detail = $request->nota;
        $workshop->request_date = $request->fechaservicio;
        
        $workshop->status = '1';
        $workshop->valoration = $request->price;
        $workshop->amount= $request->price;
        $workshop->latitude = $request->latitud;
        $workshop->longitude = $request->longitud;
        /*$workshop->picture_1 = $order_id;
        $workshop->picture_2 = $order_id;
        $workshop->picture_3 = $order_id;
        $workshop->picture_4 = $order_id;
        $workshop->picture_5 = $order_id;*/

        $workshop->save();

      return response()->json(['rpta'=>'registro paso satisfactorio']);
     
    }

}

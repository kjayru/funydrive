<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Workshop;
use App\Workshoporder;
use App\Register;
use Socialite;
use App\Client;
use App\Role;
use App\UserSocialAccount;


class AdminController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user_id  = Auth::id();
        
        $user = User::where('id',$user_id)->first();
        
        $mirol    = $user->role['name'];
        
        //$request->user()->authorizeRoles(['admin','asociado','cliente']);
        if($mirol =="admin"){
           
            $numasociado = DB::table('users')->where('role_id','2')->count();
            $numcliente = DB::table('users')->where('role_id','3')->count();    
            $cerrados = Workshoporder::where('status','Cerrado')->count();
            $solicitados = Workshoporder::where('status','Solicitado')->count();

          
           
            return view('admin.home',[
									'usuario'      => $mirol,
									'numasociados' => $numasociado,
									'numclientes'  => $numcliente,
									'cerrados'     => $cerrados,
									'solicitados'  => $solicitados
			]);
        }
		

        if($mirol=="associated"){
         
           
                return redirect()->route('admin.dashboard',['usuario'=>$mirol]);
            
            
        }

        if($mirol=="client"){
            
            if(session('peticion')){
                return redirect()->route('admin.registrojob',['usuario'=>$mirol]);
            }else{
                return view('admin.usuario',['usuario'=>$mirol]);
            }
            
        }
         
    }
	
	
	public function estado(Request $request, $id){
		
		$admin = Admin::find($id);
		
		$admin->status = $request->estado;
		
		$admin->save();
		
		return response()->json(["rpta"=>"ok"]);
	}

}

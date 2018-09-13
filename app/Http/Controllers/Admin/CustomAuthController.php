<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use App\Admin;
use App\Role;
use Socialite;
use App\Requirement;

class CustomAuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');	
    }
    public function showRegisterForm()
    {
        return view('custom.register');
    }

    public function register(Request $request)
    {
        $this->validation($request);
        $admin = new Admin;
        $admin->name = $request->name;
        //$admin->lastname = $request->lastname;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        
        $admin->save();
       
        $role = Role::find($request->role);
        $role->admins()->attach($admin->id);
         
        $admin->roles()->attach(Role::where('name', 'user')->first());
		Session::put('mensaje','estas registrado');
        return redirect('/admin/ingresar')->with('mensaje','estas registrado');
    }

    public function showLoginForm()
    {
		$mensaje = Session::get('mensaje');

        return view('custom.login',['mensaje'=>$mensaje]);
    }

    public function login(Request $request)
    {
		
        $this->validate($request,[
            
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);
        $credentials = $request->only('email','password');
      
       if (Auth::guard('admin')->attempt($credentials)) {
			//validando
		if(Auth::user()){
				$user_id = Auth::id();
				$user_rol= Admin::where('id',$user_id)->with('roles')->first();
				$mirol = $user_rol->roles[0]->name;
				
				$user = Admin::where('id',$user_id)->first();
				
				//$solicitud = new 
				Session()->put('mirol',$mirol);
				Session()->put('estado',$user->status);
	
				$request->user()->authorizeRoles(['admin','asociado','cliente']);
				
			//dd($user->status." ".$user_id." ".Session::get('comercio_id'));

			if($user->status==2){
				
					if($mirol =="admin"){
						
						$mensaje = "Solo el Cliente puede solicitar un servicio";			
						return view('admin.home',['usuario'=>$mirol,'mensaje'=>$mensaje]);
					}
	
					if($mirol=="asociado"){
					
						$mensaje = "Solo el Cliente puede solicitar un servicio";
						return view('admin.asociado',['usuario'=>$mirol,'mensaje'=>$mensaje]);
					}
	
					if($mirol=="cliente"){
					  if(Session::get('comercio_id')){	
						$req = new Requirement;
						$req->admin_id = $user_id;
						$req->profile_id = Session::get('comercio_id');
						$req->state = 2;
						$req->detail ="";
		
						$req->save();
					  }
					
						return redirect('admin/solicitudes');
	
					
					}
					dd("no hay rol");
			}else{
				Auth::guard()->logout();
                $request->session()->invalidate();
				$mensaje = "Su usuario no esta activado aun.";
				return redirect('admin/ingresar')->with('mensaje',$mensaje);
			}
		}
			//endvalid
			   ///return redirect()->intended('/admin');	  
		}
		Session::put('mensaje','Tu usuario tiene que ser activado');
			return redirect('/admin')->with('mensaje','Tu usuario tiene que ser activado');
    }

    public function validation($request){
        return $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

	public function redirectToProvider()
	{
		return Socialite::driver('google')->redirect();
	}
	
	public function handleProviderCallback()
	{
		try{
			$usersocial =  Socialite::driver('google')->user();
		}catch(Exception $e){
			return redirect('/');	
		}
		
		//$authUser = $this->findOrCreateUser($usersocial);

		//return redirect()->intended('/admin');
		
		$finduser = Admin::where('email',$usersocial->email)->first();
		
		
		if($finduser){
			$credentials = array('email'=>$finduser->email);
			
			
			//dd(Auth::guard('admin')->attempt($credentials));
			
			$credentials = array('email'=>$usersocial->email,'password'=>$usersocial->id);
       
		   if (Auth::guard('admin')->attempt($credentials)) {
				return redirect()->intended('/admin');
			}
			
		    
		
		}else{
			return view('admin.registergoogle',['usersocial'=>$usersocial]);
		}
	
			
	}

	private function ambientes()
	{
		if(Auth::user()){
            $user_id = Auth::id();
            $user_rol= Admin::find($user_id)->roles()->first();
            $mirol = $user_rol->name;


            //$solicitud = new 
			$request->session()->put('mirol',$mirol);
			$request->session()->put('estado',$user_rol->status);

			$request->user()->authorizeRoles(['admin','asociado','cliente']);
			
			if($user_rol->status==2){
				if($mirol =="admin"){
				
					$mensaje = "Solo el Cliente puede solicitar un servicio";
				
					return view('admin.home',['usuario'=>$mirol,'mensaje'=>$mensaje]);
				}

				if($mirol=="asociado"){
					
					$mensaje = "Solo el Cliente puede solicitar un servicio";
					return view('admin.asociado',['usuario'=>$mirol,'mensaje'=>$mensaje]);
				}

				if($mirol=="cliente"){
                
                $req = new Requirement();
                $req->admin_id = $user_id;
                $req->profile_id = Session::get('comercio_id');
                $req->state = 2;
                $req->detail ="";

                $req->save();

               
                return redirect('admin/solicitudes');

                
			}
		  }else{
			$mensaje = "Su usuario no esta activado aun.";
			return redirect('admin/ingresar')->with('mensaje',$mensaje);
		  }
		}
	}
	
	/*public function findOrCreateUser($user)
	{
		$authUser = Admin::where('google_id',$user->id)->first();
		
		if($authUser){
			return $authUser;
		}

			$admin = new Admin;
			$admin->name = $user->name;

			$admin->email = $user->email;
			$admin->google_id = $user->id;

			$admin->password = bcrypt($user->id);

			$admin->save();

			$role = Role::find($user->role);
			$role->admins()->attach($admin->id);

			$admin->roles()->attach(Role::where('name', 'user')->first());
			
		return $admin;
		
		
	}
	*/
	
	public function updategoogle(Request $request){
		
	$finduser = Admin::where('email',$request->email)->first();
		
		
	if($finduser){
			
			
		$credentials = array('email'=>$finduser->email);
			
		    if (Auth::guard('admin')->attempt($credentials)) {
		   		return redirect()->intended('/admin');
        	}
			
			
			
		}else{
			
			
			$admin = new Admin;
			$admin->name = $request->name;

			$admin->email = $request->email;
			$admin->google_id = $request->google_id;

			$admin->password = bcrypt($request->google_id);

			$admin->save();

			$role = Role::find($request->role);
			
			$role->admins()->attach($admin->id);

			$admin->roles()->attach(Role::where('name', 'user')->first());

			$credentials = array('email'=>$request->email,'password'=>$request->google_id);
       
		   if (Auth::guard('admin')->attempt($credentials)) {
				return redirect()->intended('/admin');
			}
			
		}
		
	}


}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\Client;
use App\UserSocialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function logout(Request $request){
        auth()->logout();
        session()->flush();

        return redirect('/login');
    }

    public function redirectToProvider(string $driver){

        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback(string $driver){
        if(!request()->has('code') || request()->has('denied')){
            session()->flash('message',['danger',__('Inicio de sesión cancelado')]);
            return redirect('login');
        }
        $socialUser = Socialite::driver($driver)->user();

        $user = null;
        $success = true;
        $email = $socialUser->email;
        $check = User::where('email',$email)->first();
        
        if($check){
            $user=$check;
        }else{
            \DB::beginTransaction();
            try{
               

                $user =   new User();
              
                $user->name = $socialUser->name;
                $user->email = $email;
                $user->role_id = 3;
                $user->save();

             
                $social =  new UserSocialAccount();
                $social->user_id = $user->id;
                $social->provider = $driver;
                $social->provider_uid = $socialUser->id;
                $social->save();
              
                $client = new Client();
                $cliente->user_id = $user_id;
                
                $client->save();

                Mail::to($email)->send(new NewUser($user));

            }catch(\Exception $exception){
                $success = $exception->getMessage();
                \DB::rollback();
            }
        }
    
        if($success === true){
            \DB::commit();
            auth()->LoginUsingId($user->id);
            return redirect(route('admin'));
        }
        session()->flash('message',['danger',$success]);
        return redirect('login');
    }
}

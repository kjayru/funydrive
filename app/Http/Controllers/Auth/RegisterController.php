<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewUser;
use App\User;
use App\Workshopassociationorder;
use App\Workshoporder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Gestor;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'role_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $email = $request->email;
        $this->guard()->login($user);
        if (session('peticion')) {

            $datos = session('peticion');

            $user_id = Auth::id();

            $user = User::find($user_id);

            $workshop = new Workshoporder;

            $workshop->user_id = $user_id;
            $workshop->user_name = $user->name . " " . $user->lastname;
            $workshop->phone_number = $datos[0]['phone_number'];

            $workshop->order_id = $datos[0]['order_id'];
            $workshop->cause = $datos[0]['cause'];
            $workshop->detail_cause = $datos[0]['detail_cause'];
            $workshop->detail = $datos[0]['detail'];
            $workshop->request_date = $datos[0]['request_date'];

            $workshop->status = $datos[0]['status'];
            $workshop->type = $datos[0]['type'];
            $workshop->amount = $datos[0]['amount'];
            $workshop->latitude = $datos[0]['latitude'];
            $workshop->longitude = $datos[0]['longitude'];
            $workshop->storename = $datos[0]['storename'];

            $iduserservice = $datos[0]['iduserservice'];

            if ($datos[0]['picture1']) {

                $workshop->picture_1 = $datos[0]['picture1'];
            }
            if ($datos[0]['picture2']) {

                $workshop->picture_2 = $datos[0]['picture2'];

            }
            if ($datos[0]['picture3']) {

                $workshop->picture_3 = $datos[0]['picture3'];
            }
            if ($datos[0]['picture4']) {

                $workshop->picture_4 = $datos[0]['picture4'];
            }
            if ($datos[0]['picture5']) {

                $workshop->picture_5 = $datos[0]['picture5'];
            }

            $workshop->save();

            $asociado = new Workshopassociationorder;

            $asociado->order_id = $datos[0]['order_id'];
            $asociado->ws_id = $datos[0]['iduserservice'];

            $asociado->save();

            $reg_id = Gestor::keysearch($email);
            
            if($reg_id){
                //send notification
                $res =  Gestor:: sendNotification(
                        $reg_id,
                        'Nueva Solicitud', 
                        'Su solicitud ha sido registrada, a partir de ahora comenzará a recibir respuesta de los talleres asociados.'
                        );
                }else{
                    $res="No tiene instalado Aplicación";
                }
        }

        /*if (session('peticion')) {
            $datos = session('peticion');

            $user_id = Auth::id();

            $user = User::find($user_id);

            $workshop = new Workshoporder;

            $workshop->user_id = $user_id;
            $workshop->user_name = $user->name . " " . $user->lastname;
            $workshop->phone_number = $datos[0]['phone_number'];

            $workshop->order_id = $datos[0]['order_id'];
            $workshop->cause = $datos[0]['cause'];
            $workshop->detail_cause = $datos[0]['detail_cause'];
            $workshop->detail = $datos[0]['detail'];
            $workshop->request_date = $datos[0]['request_date'];

            $workshop->status = $datos[0]['status'];
            $workshop->type = $datos[0]['type'];
            $workshop->amount = $datos[0]['amount'];
            $workshop->latitude = $datos[0]['latitude'];
            $workshop->longitude = $datos[0]['longitude'];
            $workshop->storename = $datos[0]['storename'];

            $iduserservice = $datos[0]['iduserservice'];

            if ($datos[0]['picture1']) {

                $workshop->picture_1 = $datos[0]['picture1'];
            }
            if ($datos[0]['picture2']) {

                $workshop->picture_2 = $datos[0]['picture2'];

            }
            if ($datos[0]['picture3']) {

                $workshop->picture_3 = $datos[0]['picture3'];
            }
            if ($datos[0]['picture4']) {

                $workshop->picture_4 = $datos[0]['picture4'];
            }
            if ($datos[0]['picture5']) {

                $workshop->picture_5 = $datos[0]['picture5'];
            }

            $workshop->save();

            $asociado = new Workshopassociationorder;

            $asociado->order_id = $datos[0]['order_id'];
            $asociado->ws_id = $datos[0]['iduserservice'];

            $asociado->save();
        }*/
        return $this->registered($request, $user)
        ?: redirect($this->redirectPath())->with(compact($res));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);
        Mail::to($data['email'])->send(new NewUser($user));
        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        /*
        User::create([
        'name' => $user->name,
        'email' => $user->email,
        'role_id' => $user->role_id,
        'password' => Hash::make($user->password),
        ]);*/

        return redirect('/admin');
    }
}

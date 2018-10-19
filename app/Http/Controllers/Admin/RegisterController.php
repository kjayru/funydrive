<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CambioFecha;
use App\Mail\Rechazo;
use App\Mail\Talleres;
use App\User;
use App\Workshopassociationorder;
use App\Workshoporder;
use App\Workshopresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Edujugon\PushNotification\PushNotification;

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
        $this->middleware('auth');
    }

    public function index()
    {
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

        return redirect('/admin/solicitudes');
    }

    public function registrowork(Request $request)
    {

        $order_id = Workshoporder::random_str('20');
        $user_id = Auth::id();

        $user = User::find($user_id);

        $workshop = new Workshoporder;

        $workshop->user_id = $user_id;
        $workshop->user_name = $user->name . " " . $user->lastname;
        $workshop->phone_number = $request->phone_number;

        $workshop->order_id = $order_id;
        $workshop->cause = $request->anotacion;
        $workshop->detail_cause = $request->service;
        $workshop->detail = $request->subservice;
        $workshop->request_date = $request->datework;

        $workshop->status = '1';
        $workshop->type = "consulta";
        $workshop->amount = '';
        $workshop->latitude = $request->latitud;
        $workshop->longitude = $request->longitud;
        $workshop->storename = $request->namestore;

        $iduserservice = $request->iduserservice;

        if ($iduserservice == 0) {
            $iduserservice = 5;
        }

        $destinationPath = public_path('/photos');

        if ($request->file('picture1')) {
            $file = $request->file('picture1');

            $input['imagename1'] = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $input['imagename1']);
            $workshop->picture_1 = $input['imagename1'];
        }
        if ($request->file('picture2')) {
            $file2 = $request->file('picture2');

            $input['imagename2'] = uniqid() . '.' . $file2->getClientOriginalExtension();

            $file2->move($destinationPath, $input['imagename2']);
            $workshop->picture_2 = $input['imagename2'];

        }
        if ($request->file('picture3')) {
            $file3 = $request->file('picture3');

            $input['imagename3'] = uniqid() . '.' . $file3->getClientOriginalExtension();

            $file3->move($destinationPath, $input['imagename3']);
            $workshop->picture_3 = $input['imagename3'];
        }
        if ($request->file('picture4')) {
            $file4 = $request->file('picture4');

            $input['imagename4'] = uniqid() . '.' . $file4->getClientOriginalExtension();

            $file4->move($destinationPath, $input['imagename4']);
            $workshop->picture_4 = $input['imagename4'];
        }
        if ($request->file('picture5')) {

            $file5 = $request->file('picture5');

            $input['imagename5'] = uniqid() . '.' . $file5->getClientOriginalExtension();

            $file5->move($destinationPath, $input['imagename5']);
            $workshop->picture_5 = $input['imagename5'];
        }

        $workshop->save();

        $asociado = new Workshopassociationorder;

        $asociado->order_id = $order_id;
        $asociado->ws_id = $iduserservice;

        $asociado->save();

        return redirect('/admin/solicitudes');

    }

    public function responderJob(Request $request)
    {

        $res = new Workshopresponse;

        $res->ws_id = $request->asociado_id;
        $res->type = $request->type;
        $res->order_id = $request->order_id;
        $res->response_detail = $request->respuesta;

        //$res->response_days = $request->duracion;
        $res->response_price = $request->precio;

       
        $res->save();

        $fecha = $request->dias." ".$request->horas.":".$request->minutos." ".$request->tiempos;
        

        Workshoporder::where('order_id', $request->order_id)
        ->update([
            'status' => 2,
            'request_date' => $fecha
            ]);
        //data Asociado

        $socio = User::where('id',$request->asociado_id)->first();

        Mail::to($socio->email)->send(new Talleres($socio));

        $push = new PushNotification;
        $response =  $push->setMessage([
             'notification' => [
                     'title'=>'talleres',
                     'body'=>'Se Acepto el trabajo',
                     'sound' => 'default'
                     ],
             'data' => [
                     'tipo' => 'Notificacion',
                     'notificacion' => 'Mensaje desde wavy backend'
                     ]
             ])
             ->setApiKey('AIzaSyD7ol5aQp8Y4RA7R275JqK8elm1tlbdmzA')
             ->setDevicesToken(['APA91bGrNFlbgNJCpl0dAEIcFv5eyPe24TH77cNwXhu7IrKano4a_WaidcaVmhvPhcNvEyCMvUagaMnxguNJ_XWUumz-SYOg-wmt5VMUK6zusHzb1trTOak'])
             ->send();
 

        return response()->json(['rpta' => 'ok']);

    }

    public function rechazarJob(Request $request)
    {
        $res = new Workshopresponse;
        $res->ws_id = $request->asociado_id;
        $res->type = $request->type;
        $res->order_id = $request->order_id;
        $res->response_detail = $request->motivo;


        $res->save();

        Workshoporder::where('order_id', $request->order_id)->update(['status' => 5]);

        $socio = User::where('id',$request->cliente_id)->first();


        Mail::to($socio->email)->send(new Rechazo($socio));
        return response()->json(['rpta' => 'ok']);

        $push = new PushNotification;
       $response =  $push->setMessage([
            'notification' => [
                    'title'=>'talleres',
                    'body'=>'Se rechazo el trabajo',
                    'sound' => 'default'
                    ],
            'data' => [
                    'tipo' => 'Notificacion',
                    'notificacion' => 'Mensaje desde wavy backend'
                    ]
            ])
            ->setApiKey('AIzaSyD7ol5aQp8Y4RA7R275JqK8elm1tlbdmzA')
            ->setDevicesToken(['APA91bGrNFlbgNJCpl0dAEIcFv5eyPe24TH77cNwXhu7IrKano4a_WaidcaVmhvPhcNvEyCMvUagaMnxguNJ_XWUumz-SYOg-wmt5VMUK6zusHzb1trTOak'])
            ->send();

    }

    public function editarJob(Request $request, $id)
    {
        $res = Workshopresponse::where('order_id', $id)->get();
        return response()->json(['rpta' => 'ok', "res" => $res]);
    }

    public function updateJob(Request $request, $order)
    {
        $res = Workshopresponse::where('order_id', $order)
            ->update([
                'response_detail' => $request->respuesta,
                'response_days' => $request->duracion,
                'response_price' => $request->precio
          

            ]);

        //cambio de fecha
        Mail::to($data['email'])->send(new RespondeMensaje($res));

        $push = new PushNotification;
        $response =  $push->setMessage([
             'notification' => [
                     'title'=>'talleres',
                     'body'=>'Se actualizaron el procedimiento de trabajo',
                     'sound' => 'default'
                     ],
             'data' => [
                     'tipo' => 'Notificacion',
                     'notificacion' => 'Mensaje desde wavy backend'
                     ]
             ])
             ->setApiKey('AIzaSyD7ol5aQp8Y4RA7R275JqK8elm1tlbdmzA')
             ->setDevicesToken(['APA91bGrNFlbgNJCpl0dAEIcFv5eyPe24TH77cNwXhu7IrKano4a_WaidcaVmhvPhcNvEyCMvUagaMnxguNJ_XWUumz-SYOg-wmt5VMUK6zusHzb1trTOak'])
             ->send();


        return response()->json(['rpta' => 'ok']);

    }

    public function getFecha($id){

        $fecha = Workshoporder::where('order_id',$id)->first();

        return response()->json($fecha);
    }

    public function actualizarFecha(Request $request, $order){


        $fecha = $request->dia." ".$request->hora.":".$request->minuto." ".$request->tiempos;
        
        $res = Workshoporder::where('order_id', $order)
        ->update([
            'request_date' => $fecha
        ]);

        $mailcliente = User::where('id',$request->cliente_id)->first();
       
    //cambio de fecha
        Mail::to($mailcliente->email)->send(new CambioFecha($res));

        $push = new PushNotification;
        $response =  $push->setMessage([
             'notification' => [
                     'title'=>'talleres',
                     'body'=>'Se ha actualizado la fecha del trabajo',
                     'sound' => 'default'
                     ],
             'data' => [
                     'tipo' => 'Notificacion',
                     'notificacion' => 'Mensaje desde wavy backend'
                     ]
             ])
             ->setApiKey('AIzaSyD7ol5aQp8Y4RA7R275JqK8elm1tlbdmzA')
             ->setDevicesToken(['APA91bGrNFlbgNJCpl0dAEIcFv5eyPe24TH77cNwXhu7IrKano4a_WaidcaVmhvPhcNvEyCMvUagaMnxguNJ_XWUumz-SYOg-wmt5VMUK6zusHzb1trTOak'])
             ->send();

        return response()->json(['rpta'=>'ok']);
    }

}

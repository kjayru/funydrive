<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostalCode;
use App\Poblacion;
use App\Provincia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mapper;
use App\MakeYear;
use App\Modelo;
use App\Service;

use App\User;
use App\Workshoporder;
use App\Workshopassociationorder;
use App\Workshopresponse;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Edujugon\PushNotification\PushNotification;
use App\Gestor;


class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $list1 = DB::table('makes')
                ->offset(0)
                ->limit(33)->orderBy('name', 'asc')->get();
        
        $list2 = DB::table('makes')
                ->offset(34)
                ->limit(59)->orderBy('name', 'asc')->get();
                
        $list3 = DB::table('makes')
                ->offset(60)
                ->limit(85)->orderBy('name', 'asc')->get();

        $list4 = DB::table('makes')
                ->offset(86)
                ->limit(144)->orderBy('name', 'asc')->get();

        $servicios = Service::whereNull('parent_id')->orderBy('name','asc')->get();
                
        return view('home',['list1'=>$list1,'list2'=>$list2,'list3'=>$list3,'list4'=>$list4,'servicios'=>$servicios]);
    }

    public function getPostal($code){

        $postal = DB::table('postal_codes')
            ->join('provincias','postal_codes.provinciaid','=','provincias.provinciaid')
            ->join('poblacions',[
                ['postal_codes.poblacionid','=','poblacions.poblacionid'],
                ['provincias.provinciaid','=','poblacions.provinciaid']
                ])
            ->where('postal_codes.codigopostalid',$code)->get();
            
       

        if($postal){
           
            
            $datos = ['rpta'=>'ok','postal'=>$postal];
           
            return response()->json($datos);

        }else{
            
           
            return response()->json(['rpta'=>'error','mensaje'=>'Your Mechanic does not yet service your area']);
        }

        return response()->json(['rpta'=>'error','mensaje'=>'no existe el codigo postal']);
    }

    public function getModel(Request $request){

        $dato = MakeYear::where([
            ['year','=',$request->year],
            ['make_id','=',$request->idmake]
        ])->first();
           
        if(!is_null($dato)){
        $modelos = Modelo::where('makeyear_id',$dato->id)->get();

            if(count($modelos)>0){
                return response()->json(['rpta'=>'ok','data'=>$modelos]);
            }else{
                return response()->json(['rpta'=>'error','mensaje'=>'no existe modelos para el año elegido']);
            }
       
        }else{
            return response()->json(['rpta'=>'error','mensaje'=>'no existe modelos para el año elegido']);  
        }

        
    }

    public function getservice($id){
        $subservices = Service::where('parent_id',$id)
            ->where('status',2)
            ->get();

        if(count($subservices)>0){
            return response()->json(['rpta'=>'ok','data'=>$subservices]);
        }else{
            return response()->json(['rpta'=>'error','mensaje'=>'NO CONTIENE SERVICIOS']);
        }
    }

    public function verifyUser(Request $request){

        if(Auth::id()){
            

            $order_id = Workshoporder::random_str('20');
            $user_id = Auth::id();
         
            $user = User::find($user_id);
            $email = $user->email;
         
      
            $workshop = new Workshoporder;
      
              $workshop->user_id = $user_id;   
              $workshop->user_name = $user->name." ".$user->lastname;
              $workshop->phone_number = $request->phone_number;
              
              $workshop->order_id = $order_id;
              $workshop->cause = $request->anotacion;
              $workshop->detail_cause = $request->service;
              $workshop->detail = $request->subservice;
              $workshop->request_date = $request->datework;
              
              $workshop->status = '1';
              $workshop->type="consulta";
              $workshop->amount= '';
              $workshop->latitude = $request->latitud;
              $workshop->longitude = $request->longitud;
              $workshop->storename = $request->namestore;
      
              $iduserservice = $request->iduserservice;
      
              if($iduserservice==0){
                  $iduserservice=5;
              }
              
              $destinationPath = public_path('/photos');
      
          if($request->file('picture1')){
              $file = $request->file('picture1');
              
              $input['imagename1'] = uniqid().'.'.$file->getClientOriginalExtension();   
              $file->move($destinationPath, $input['imagename1']);
              $workshop->picture_1 = $input['imagename1'];
          }
          if($request->file('picture2')){
              $file2 = $request->file('picture2');
              
              $input['imagename2'] = uniqid().'.'.$file2->getClientOriginalExtension();
             
              $file2->move($destinationPath, $input['imagename2']);
              $workshop->picture_2 = $input['imagename2'];
              
          }
          if($request->file('picture3')){   
              $file3 = $request->file('picture3');
              
              $input['imagename3'] = uniqid().'.'.$file3->getClientOriginalExtension();
             
              $file3->move($destinationPath, $input['imagename3']);
              $workshop->picture_3 = $input['imagename3'];
          }   
          if($request->file('picture4')){
              $file4 = $request->file('picture4');
              
              $input['imagename4'] = uniqid().'.'.$file4->getClientOriginalExtension();
             
              $file4->move($destinationPath, $input['imagename4']);
              $workshop->picture_4 = $input['imagename4'];
          }
          if($request->file('picture5')){  
      
              $file5 = $request->file('picture5');
              
              $input['imagename5'] = uniqid().'.'.$file5->getClientOriginalExtension();
             
              $file5->move($destinationPath, $input['imagename5']);
              $workshop->picture_5 = $input['imagename5'];
          } 
      
              $workshop->save();
      
      
             $asociado =  new Workshopassociationorder;
      
             $asociado->order_id = $order_id;
             $asociado->ws_id    = $iduserservice;
            
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


           return redirect('/admin/solicitudes')->with(compact($res));


        }else{
           
            $order_id = Workshoporder::random_str('20');

            $ids = $request->iduserservice;

            if($ids==0){
                $ids=5;
            }

            //archivos
            $destinationPath = public_path('/photos');
      
            if($request->file('picture1')){
                $file = $request->file('picture1');
                
                $input['imagename1'] = uniqid().'.'.$file->getClientOriginalExtension();   
                $file->move($destinationPath, $input['imagename1']);
                $picture_1 = $input['imagename1'];
            }
            if($request->file('picture2')){
                $file2 = $request->file('picture2');
                
                $input['imagename2'] = uniqid().'.'.$file2->getClientOriginalExtension();
               
                $file2->move($destinationPath, $input['imagename2']);
                $picture_2 = $input['imagename2'];
                
            }
            if($request->file('picture3')){   
                $file3 = $request->file('picture3');
                
                $input['imagename3'] = uniqid().'.'.$file3->getClientOriginalExtension();
               
                $file3->move($destinationPath, $input['imagename3']);
                $picture_3 = $input['imagename3'];
            }   
            if($request->file('picture4')){
                $file4 = $request->file('picture4');
                
                $input['imagename4'] = uniqid().'.'.$file4->getClientOriginalExtension();
               
                $file4->move($destinationPath, $input['imagename4']);
                $picture_4 = $input['imagename4'];
            }
            if($request->file('picture5')){  
        
                $file5 = $request->file('picture5');
                
                $input['imagename5'] = uniqid().'.'.$file5->getClientOriginalExtension();
               
                $file5->move($destinationPath, $input['imagename5']);
                $picture_5 = $input['imagename5'];
            } 

            $registro = array(
                
                'phone_number' => $request->phone_number,
                
                'order_id' => $order_id,
                'cause' => $request->anotacion,
                'detail_cause' => $request->service,
                'detail' => $request->subservice,
                'request_date' => $request->datework,
                
                'status' => '1',
                'type'=>"consulta",
                'amount'=> '',
                'latitude' => $request->latitud,
                'longitude' => $request->longitud,
                'storename' => $request->namestore,
        
                'iduserservice' => $ids,
                'picture1'=>@$picture_1,
                'picture2'=>@$picture_2,
                'picture3'=>@$picture_3,
                'picture4'=>@$picture_4,
                'picture5'=>@$picture_5
            );
            
            \Session::push('peticion',$registro);
            \Session::save();
            
            return redirect('/login');
        }
    }


    public function buscarservicio(Request $request){
        

        $resultado = Service::where('name', 'like', '%' . $request->words . '%')
            ->where('status',2)    
            ->get();

        return response()->json(['resultado'=>$resultado]);
    }


    public function pruebdesarrollo(){
    //Selecciona lista de usuario registrados
  
    
     /* $con = Gestor::conexion();
      echo "<pre>";
      print_r($con);
      echo "</pre>";*/

/*
     $usuarios =array
                (
                    array
                        (
                            "email" => "info.funydrive@gmail.com",
                            "reg_id" => "APA91bE5cgw5FmVR4KCo2uW84dkgGOiYANX0uOvItBo7LghZYzqL6pByBlDltUNDMQLOvemqA4947Wv8umN7sFMzAb218cyv2U8T4HXbRNVs2Sx62QdSTIg"
                        ),

                    array
                        (
                            "email" => "silvialoboblazquez@gmail.com",
                            "reg_id" => "APA91bGmtIi9wocqmf6n89zAJe19fOMyGmVa5Z24wTVFbXKYwYO0metCSLRITn08BFo6kfzZQf5PiiRBYuB9-rF8PQ-teGmSbxjhUl3NAipTGB7OV_kEEwA"
                        ),

                    array
                        (
                            "email" => "carlagmairena@gmail.com",
                            "reg_id" => "APA91bGRFiEH7PKD5fMQVbsBNLdQ1dX_RWudElQxtha_ODcTcO1j2BTGqv2gM5CW4_QEW4n6QB5cMwWwAApN3DKyZ1xjiDS_erLRtOH-656mdYYAgqgQos0"
                        ),

                    array
                        (
                            "email" => "wiltinoco@gmail.com",
                            "reg_id" => "APA91bGrNFlbgNJCpl0dAEIcFv5eyPe24TH77cNwXhu7IrKano4a_WaidcaVmhvPhcNvEyCMvUagaMnxguNJ_XWUumz-SYOg-wmt5VMUK6zusHzb1trTOak"
                        )

                );
           */   
           
            
    }
}

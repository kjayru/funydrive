<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Workshoporder;
use App\workshopresponse;
use App\Register;
use App\Requirement;
use App\Estado;
use App\Conversation;
use App\ConversationReply;

class ListrequestController extends Controller
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
    public function index()
    {
       

        $mirol    = User::navigation();

        $solicitudes = Requirement::all();
        return view('admin.super.solicitudes',['usuario'=>$mirol,'solicitudes' => $solicitudes]);
    }

    
    public function estados()
    {
        $user_id = Auth::id();
        $mirol    = User::navigation();
        /* $trabajos = DB::table('WorkShopOrders')
                    ->where('user_work_id',$user_id)
                    ->join('estados','WorkShopOrders.order_id','=','estados.order_id')
                    ->get();*/
        $trabajos = workshoporder::where('user_work_id',$user_id)->with('estado')->get();

        
      
        return view('admin.asociados.estado',['usuario'=>$mirol,'user_id'=>$user_id,'trabajos'=>$trabajos]);
    }


    public function cambioestado(Request $request, $order_id){
        
        $findorder = Estado::where('order_id',$order_id)->count();

        if($findorder>0){

            $result = Estado::where('order_id',$order_id)->first();

            $result->status = $request->estado;
            $result->save();

        }else{

            $result = new Estado();
            $result->order_id = $order_id;
            $result->status = $request->estado;
            $result->save();
        }

        return response()->json(['rpta'=>'ok']);

        
    }


    public function getmensajes(){
        $user_id = Auth::id();
        $mirol    = User::navigation();
        $trabajos = workshoporder::where('user_id',$user_id)->get();
 
        return view('admin.asociados.valorar',['user_id'=>$user_id,'trabajos'=>$trabajos]);
    }

    public function mensajeAdmin(){
        $user_id = Auth::id();
        $mirol    = User::navigation();
        $trabajos = workshoporder::all();
 
        return view('admin.super.valorar',['user_id'=>$user_id,'trabajos'=>$trabajos]);
    }

    

    public function setvalorar(Request $request, $order_id){
        //valoration workshoporder
        $work = workshoporder::where('order_id',$order_id)->first();
       
        //notas in response
        $work->valoration = $request->valorar;
        $work->save();

        $note = workshopresponse::where('order_id',$order_id)->first();
        $note->response_notes = $request->nota;
        $note->save();

        return response()->json(['rpta'=>'ok']);

    }


}

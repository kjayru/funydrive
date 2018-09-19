<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
Use \DB;
use Illuminate\Http\Request;

use App\Modelo;
use App\Make;
use App\MakeYear;
use App\Workshopassociationorder;
use App\Workshoporder;
class DashAsociadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');	
    }

    /*status 1 = SOLICITADA, 2 = RESPONDIDA, 3 = ASIGNADA, 4 = FINALIZADA
    
    Número de Peticiones Activas			Se selecciona de WorkShopOrder con status 'Solicitada'
Número de Peticiones Respondidas			Se selecciona de WorkShopOrder con status 'Respondida'
Número de Peticiones Asignadas			Se selecciona de WorkShopOrder con status 'Asignada' and ws_id Y user_work_id es igual al del asociado
Número de Peticiones Finalizadas			Se selecciona de WorkShopOrder con status 'Finalizada' and ws_id y user_work_id es igual al del asociado
Importe de Peticiones Finalizadas			Suma de todos los orde_id de WorkShopOrder con status 'Finalizada' and ws_id  y  user_work_id es igual al del asociado
*/

    public function index(){
        $user_id = Auth::id();
       
        $activa = workshoporder::where([['user_work_id','=',$user_id],['status','=',1]])->count();
     
        $respondida =  workshoporder::where([['user_work_id','=',$user_id],['status','=',2]])->count();
        $asignada =  workshoporder::where([['user_work_id','=',$user_id],['status','=',3]])->count();
        $finalizada =  workshoporder::where([['user_work_id','=',$user_id],['status','=',4]])->count();
        $importeFinal = DB::table('workshoporders')
        ->select( DB::raw('SUM(amount) as total'))
        ->where('status', '=', 4)
        ->get();
       
       
        $trabajos = workshoporder::where('user_work_id',$user_id)->get();
       
       
        return view('admin.asociados.dashboard',['user_id'=>$user_id,'activa'=>$activa,'respondida'=>$respondida,'asignada'=>$asignada,'finalizada'=>$finalizada,'importeFinal'=>$importeFinal,'trabajos'=>$trabajos]);
    }
}

<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Modelo;
use App\Make;
use App\MakeYear;

class DashAsociadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');	
    }

    /*Número de Peticiones Activas			Se selecciona de WorkShopOrder con status 'Solicitada'
Número de Peticiones Respondidas			Se selecciona de WorkShopOrder con status 'Respondida'
Número de Peticiones Asignadas			Se selecciona de WorkShopOrder con status 'Asignada' and ws_id es igual al del asociado
Número de Peticiones Finalizadas			Se selecciona de WorkShopOrder con status 'Finalizada' and ws_id es igual al del asociado
Importe de Peticiones Finalizadas			Suma de todos los orde_id de WorkShopOrder con status 'Finalizada' and ws_id es igual al del asociado
*/

    public function index(){

        $activa = 1;
        $respondida = 2;
        $asignada = 1;
        $finalizada = 5;
        $importeFinal = 200;

        

        return view('admin.asociados.dashboard',['activa'=>$activa,'respondida'=>$respondida,'asignada'=>$asignada,'finalizada'=>$finalizada,'importeFinal'=>$importeFinal]);
    }
}

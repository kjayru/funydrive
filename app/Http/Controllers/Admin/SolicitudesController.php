<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Requirement;
use App\User;
use App\Register;
use App\Workshoporder;
class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
       
    }
   
    public function index()
    {
        $user_id = Auth::id();
      
        $mirol = User::navigation();
  
        $solicitudes = Workshoporder::where('user_id',$user_id)->get();
      
        return view('admin.usuarios.solicitudes',['solicitudes'=>$solicitudes,'usuario'=>$mirol]);
    }

    public function destroy($id)
    {
        $solicitud = Workshoporder::find($id);
        $solicitud->delete();

        return response()->json(['rpta'=>'ok']);
    }
}

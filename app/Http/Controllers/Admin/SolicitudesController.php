<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Requirement;
use App\Admin;
use App\Register;

class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
      
        $mirol = User::navigation();
  
        $solicitudes = Requirement::where('user_id',$user_id)->get();
      
        return view('admin.usuarios.solicitudes',['solicitudes'=>$solicitudes,'usuario'=>$mirol]);
    }

    public function destroy($id)
    {
        $solicitud = Requirement::find($id);
        $solicitud->delete();

        return response()->json(['rpta'=>'ok']);
    }
}
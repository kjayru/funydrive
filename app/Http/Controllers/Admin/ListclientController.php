<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Workshop;
use App\Workshoporder;
use App\Register;

class ListclientController extends Controller
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
   
        $mirol    = User::navigation();
     
        
		$clientes = User::where('role_id',3)->get();
		
        return view('admin.super.clientes',['usuario'=>$mirol,'clientes'=>$clientes]);
    }

    
    public function show($id)
    {
        $cliente = User::find($id);

        return response()->json(['cliente'=>$cliente]);
    }

    
    public function update(Request $request, $id)
    {
        $cliente = User::find($id);
        $cliente->name = $request->nombre;
        $cliente->email = $request->email;
        $cliente->save();

        return response()->json(['rpta'=>'ok']);
    }

   
}

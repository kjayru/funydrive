<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostalCode;
use App\Poblacion;
use App\Provincia;
class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('home');
    }

    public function getPostal($code){

        $postal = PostalCode::where('codigopostalid',$code)->first();
        
        if($postal){
            $poblacion = $postal->poblacion->poblacion;
            $provincia = $postal->provincia->provincia;
            
            $datos = ['rpta'=>'ok','poblacion'=>$poblacion,'provincia'=>$provincia];
           
            return response()->json($datos);

        }else{
            
           
            return response()->json(['rpta'=>'error','mensaje'=>'Your Mechanic does not yet service your area']);
        }

        return response()->json(['rpta'=>'error','mensaje'=>'no existe el codigo postal']);
    }
}

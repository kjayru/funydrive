<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostalCode;
use App\Poblacion;
use App\Provincia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mapper;

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


                
        return view('home',['list1'=>$list1,'list2'=>$list2,'list3'=>$list3,'list4'=>$list4]);
    }

    public function getPostal($code){

        $postal = PostalCode::where('codigopostalid',$code)->first();
        
        if($postal){
            $poblacion = $postal->poblacion->poblacion;
            $provincia = $postal->provincia->provincia;
            $ineid = $postal->poblacion->ineid;
            $lat = $postal->poblacion->lat;
            $lon = $postal->poblacion->lon;
            
            $datos = ['rpta'=>'ok','poblacion'=>$poblacion,'provincia'=>$provincia,'ineid'=>$ineid,'lat'=>$lat,'lon'=>$lon];
           
            return response()->json($datos);

        }else{
            
           
            return response()->json(['rpta'=>'error','mensaje'=>'Your Mechanic does not yet service your area']);
        }

        return response()->json(['rpta'=>'error','mensaje'=>'no existe el codigo postal']);
    }
}

<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modelo;
use App\Make;
use App\MakeYear;

class CarController extends Controller
{
    public function index(){
        $marcas = Make::paginate(30);

        return view('admin.marca',['marcas'=>$marcas]);
    }

    public function modelcar(){
        $modelos = Modelo::paginate(30);
        return view('admin.modelo',['modelos'=>$modelos]);
    }
}

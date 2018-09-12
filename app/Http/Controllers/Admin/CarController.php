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

    public function getmarca($id){

        $marcas = Make::find($id);
        return view('admin.marca',['marcas'=>$marcas]);
    }

    public function editmarca($id){
        $marcas = Make::find($id);

        $years = $marcas->makeyears;
       
        return response()->json(['marcas'=>$marcas,'years'=>$years]);
    }

    public function updatemarca(Request $request, $id){
       
        $marcas =  Make::find($id);
        $marcas->name = $request->name;

        $marcas->save();

       if($request->yearmake){

        $marcas = MakeYear::where('make_id',$id)->delete();
        

           for($i=0; $i<count($request->yearmake);$i++){

            

               $makeyear = new MakeYear;
               $makeyear->make_id = $id;
               $makeyear->year = $request->yearmake[$i];
               $makeyear->save();
               
           }
       }
      
     return response()->json(["rpta"=>"ok"]);
    }

    public function storemarca(Request $request){

        
         $marcas = new Make;
         $marcas->name = $request->name;

         $marcas->save();

        if($request->yearmake){
            for($i=0; $i<count($request->yearmake);$i++){

                $makeyear = new MakeYear;
                $makeyear->make_id = $marcas->id;
                $makeyear->year = $request->yearmake[$i];
                $makeyear->save();
                
            }
        }
       

         return response()->json(["rpta"=>"ok"]);

    }

    public function deletemarca($id){
        $marcas = Make::find($id);
        $marcas->delete();

        return redirect('admin\marcas');
    }

    public function modelcar(){
        $modelos = Modelo::paginate(30);
        return view('admin.modelo',['modelos'=>$modelos]);
    }


    public function getmodelo($id){
        $modelos = Modelo::find($id);
        
        return view('admin.modelo',['modelos'=>$modelos]);
    }

    public function editmodelo($id){
        $modelos = Modelo::find($id);
        
        return view('admin.modelo',['modelos'=>$modelos]);
    }

    public function updatemodelo(Request $request, $id){
        $modelo = Modelo::find($id);
        $modelo->name = $request->name;
        $modelo->makeyear_id = $request->makeyear_id;

        $modelo->save();

        return redirect('admin/modelo');
    }

    public function storemodelo(Request $request){
        $modelo =  new Modelo;
        $modelo->name = $request->name;
        $modelo->makeyear_id = $request->makeyear_id;

        $modelo->save();

        return redirect('admin/modelo');

    }
    public function deletemodelo($id){
        $modelo = Modelo::find($id);
        $modelo->delete();

        return redirect('admin/modelo');
    }
}


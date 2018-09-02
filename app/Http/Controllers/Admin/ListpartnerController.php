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
use App\Profile;

use App\Photo;
use App\Phone;
use App\Dayhour;
use App\Vacation;


class ListpartnerController extends Controller
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

        $socios = User::where('role_id',2)->get();
      
        return view('admin.super.asociados',['usuario'=>$mirol,'socios'=>$socios]);
    }

    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $socio = Profile::where('admin_id',$id)->first();
        if(!$socio){
        return response()->json(['socio'=>"vacio"]);
        }else{
        return response()->json(['socio'=>$socio]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$socio = Profile::find($id)->first();
        if(!$socio){
        return response()->json(['socio'=>"vacio"]);
        }else{
        return response()->json(['socio'=>$socio]);
        }*/
		
		
		$usuario='admin';
        
        $profile = Profile::where('admin_id',$id)->first();
        $photos = Photo::where('admin_id',$id)->get();
        $phones = Phone::where('admin_id',$id)->get();
        $dias = Dayhour::where('admin_id',$id)->get();
        $vacaciones = Vacation::where('admin_id',$id)->get();
        
        return View('admin.super.detallesocio',['usuario'=>$usuario,'socio_id'=>$id,'profile'=>$profile,'photos'=>$photos,'phones'=>$phones,'dias'=>$dias,'vacaciones'=>$vacaciones]);
		
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     	$this->validate($request,[
            
            'tradename' => 'required|max:255',
            'contact' => 'required|max:255',
			'email' => 'required|email',
			'address' => 'required'
        ],
		[
			'tradename.required'=> 'Ingrese el nombre comercial',
			'contact.required' => 'Ingrese el nombre del contacto',
			'email.required' => 'Ingrese el correo válido',
			'address.required' => 'Ingrese una dirección',
		]
		);
		
		
		
		$profile = Profile::where('admin_id',$id)->first();

        if ($profile === null) {         
           $profile = new Profile();
           
         }

        $profile->admin_id  = $request->socio_id;
        $profile->tradename = $request->tradename;
        $profile->contact   = $request->contact;
        $profile->email     = $request->email;
        $profile->website   = $request->website;
        $profile->address   = $request->address;
        $profile->latitud   = $request->latitud;
        $profile->longitud  = $request->longitud;

        $profile->save();

        $iphone = Phone::where('admin_id',$request->socio_id)->delete();

		if($request->file('photo')){
			if(count($request->file('photo'))>0){
				foreach ($request->file('photo') as $photo) {
					$file = $photo;

					$input['imagename'] = time().'.'.$file->getClientOriginalExtension();
					$destinationPath = public_path('/photos');
					$file->move($destinationPath, $input['imagename']);

					$image = new Photo();
					$image->admin_id = $request->socio_id;
					$image->name = $input['imagename'];
					$image->save();

				}
			}
		}

		if($request->phone){
			foreach ($request->phone as $phone) {

				$fono = new  Phone();
				$fono->admin_id = $request->socio_id;
				$fono->phone = $phone;
				$fono->save();
			}
		}
      
       

		//diasemana

		Dayhour::where('admin_id',$request->socio_id)->delete();

		//for($i=0;$i<7;$i++){
		foreach ($request->day as $key => $day) {

			 $dayhour = new Dayhour();
			 $dayhour->admin_id = $request->socio_id;
			 $dayhour->day = $day;
			 $dayhour->starhour = $request['apertura'][$key];
			 $dayhour->endhour =  $request['cierre'][$key];
			 $dayhour->save();
		}  
		//vacaciones
		Vacation::where('admin_id',$request->socio_id)->delete();

		//for($j=0;$j<4;$j++){
		foreach ($request->vacacion as $vacas) {
			$vaca = new Vacation();
			$vaca->admin_id = $request->socio_id;
			$vaca->startdate = $vacas;


			$vaca->save();
		}
    
        return redirect('/admin/listasociados');
		
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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
use App\Requirement;

class ListrequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');	
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $mirol    = User::navigation();

        $solicitudes = Requirement::all();
        return view('admin.super.solicitudes',['usuario'=>$mirol,'solicitudes' => $solicitudes]);
    }

    

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
class SubserviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
       
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $mirol = User::navigation();
        return view('admin/asociados/subservicio',['usuario'=>$mirol]);
    }

   
}

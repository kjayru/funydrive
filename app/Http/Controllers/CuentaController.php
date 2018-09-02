<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google;
use Google_Client;
class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function test()
    {
        $googleClient = Google::getClient();
        
        $googleClient->setAccessType("true");
        $googleClient->setIncludeGrantedScopes(true);
       // $cliente->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
       /* $client->setAuthConfig('client_secrets.json');
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/cuenta/test');*/
        return view('landing.sesion');
    }
    
}

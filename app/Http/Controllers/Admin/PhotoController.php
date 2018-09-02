<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;

class PhotoController extends Controller
{
   
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
    }
}

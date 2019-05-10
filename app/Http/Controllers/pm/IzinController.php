<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IzinController extends Controller
{
     public function index()
    {
    	//list cuti dari user yg login
    	$izins = Izin::where('soft_delete',0)->get();

        return view('admin.cuti_izin.izin.index',['izins'=>$izins]);
    }
}

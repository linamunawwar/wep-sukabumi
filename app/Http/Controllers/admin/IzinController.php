<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Izin;

class IzinController extends Controller
{
    public function index()
    {
    	$izins = Izin::where('soft_delete',0)->get();

        return view('admin.cuti_izin.izin.index',['izins'=>$izins]);
    }
}

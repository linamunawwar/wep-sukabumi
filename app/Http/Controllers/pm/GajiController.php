<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gaji;

class GajiController extends Controller
{
    public function index()
    {
    	$gajis = Gaji::whereHas('pegawai',function ($q){
	            $q->where('is_active', 1);
	        })->get();

        return view('pm.gaji.index', ['gajis'=>$gajis]);
    }
}

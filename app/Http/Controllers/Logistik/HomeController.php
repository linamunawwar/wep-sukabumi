<?php

namespace App\Http\Controllers\Logistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests;
use App\Pegawai;
use App\Models\LogMaterial;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //admin
        if(Auth::user()->role_id == 6){
            $materials = LogMaterial::where('soft_delete',0)->count();
            return view('logistik.admin.home',['materials'=>$materials]);
        }
        
        if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4)){
            $materials = LogMaterial::where('soft_delete',0)->count();
            return view('logistik.manager.home',['materials'=>$materials]);
        }

        if(Auth::user()->role_id == 5){
            $materials = LogMaterial::where('soft_delete',0)->count();
            return view('logistik.pm.home',['materials'=>$materials]);
        }

        if(Auth::user()->role_id == 2){
            $materials = LogMaterial::where('soft_delete',0)->count();
            return view('logistik.user.home',['materials'=>$materials]);
        }
    }
}

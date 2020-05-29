<?php

namespace App\Http\Controllers\Logistik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests;
use App\Pegawai;
use App\Models\LogMaterial;
use App\Models\LogPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //admin
        if(Auth::user()->role_id == 6){
            $materials = LogMaterial::where('soft_delete',0)->count();
            $permintaan = LogPermintaanMaterial::where('soft_delete',0)->count();
            $permintaan_disetujui = LogPermintaanMaterial::where('soft_delete',0)
            ->where('is_pm',1)
            ->count();
            return view('logistik.admin.home',['materials'=>$materials,'permintaan'=>$permintaan,'permintaan_disetujui'=>$permintaan_disetujui]);
        }
        
        if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4)){
            $materials = LogMaterial::where('soft_delete',0)->count();
            return view('logistik.manager.home',['materials'=>$materials]);
        }

        if((Auth::user()->role_id == 2) && ((Auth::user()->pegawai->posisi_id == 45) || (Auth::user()->pegawai->posisi_id == 46))){
            $materials = LogMaterial::where('soft_delete',0)->count();
            return view('logistik.pelaksana.home',['materials'=>$materials]);
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

    public function setPage($page){
        session(['page'=>$page]);
    }

    public function setSessionProses(){
        session(['proses'=>0]);
    }
}

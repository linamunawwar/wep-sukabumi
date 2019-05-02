<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Izin;

class IzinController extends Controller
{
    public function index()
    {
    	$izins = Izin::whereHas('pegawai',function ($q){
	            $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
	        })->get();

        return view('manager.cuti_izin.izin.index',['izins'=>$izins]);
    }

    public function approve($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

       $izin['is_verif_mngr'] = 1;
       $izin['verif_mngr_by'] = \Auth::user()->id;
       $izin['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Izin::where('id',$id)->update($izin);
       
       return redirect('/manager/izin');
    }
}

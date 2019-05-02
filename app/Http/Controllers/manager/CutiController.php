<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cuti;
use App\Pegawai;

class CutiController extends Controller
{
    public function index()
    {
    	if(\Auth::user()->pegawai->kode_bagian == 'SA'){
	        $cutis = Cuti::get();
	      }else{
	        $cutis = Cuti::whereHas('pegawai',function ($q){
	            $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
	        })->get();

	      }
        return view('manager.cuti_izin.cuti.index',['cutis'=>$cutis]);
    }

    public function approve($id)
    {
    	$cuti = Cuti::find($id);

        return view('manager.cuti_izin.cuti.approve',['cuti'=>$cuti]);
    }

    public function postApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

     	 $cuti['ket_manager'] = \Input::get('ket_manager');
       $cuti['is_verif_mngr'] = 1;
       $cuti['verif_mngr_by'] = \Auth::user()->id;
       $cuti['verify_mngr_time'] = date('Y-m-d H:i:s');

       $update = Cuti::where('id',$id)->update($cuti);
       
       return redirect('/manager/cuti');
    }

    public function approveSDM($id)
    {
    	$cuti = Cuti::find($id);

        return view('manager.cuti_izin.cuti.approve_sdm',['cuti'=>$cuti]);
    }

    public function postApproveSDM($id)
    {
      $find = Cuti::where('id',$id)->first();
      date_default_timezone_set("Asia/Jakarta");

      if($find->pegawai->kode_bagian == 'SA'){
        $cuti['ket_manager'] = \Input::get('ket_manager');
        $cuti['is_verif_mngr'] = 1;
        $cuti['verif_mngr_by'] = \Auth::user()->id;
        $cuti['verify_mngr_time'] = date('Y-m-d H:i:s');

        $cuti['ket_sdm'] = \Input::get('ket_sdm');
        $cuti['is_verif_sdm'] = 1;
        $cuti['verif_sdm_by'] = \Auth::user()->id;
        $cuti['verify_sdm_time'] = date('Y-m-d H:i:s');

        $update = Cuti::where('id',$id)->update($cuti);
      }else{
         $cuti['ket_sdm'] = \Input::get('ket_sdm');
         $cuti['is_verif_sdm'] = 1;
         $cuti['verif_sdm_by'] = \Auth::user()->id;
         $cuti['verify_sdm_time'] = date('Y-m-d H:i:s');

         $update = Cuti::where('id',$id)->update($cuti);
      }
       return redirect('/manager/cuti');
    }
}

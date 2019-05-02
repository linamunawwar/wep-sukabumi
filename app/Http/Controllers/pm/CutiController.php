<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cuti;
use App\Pegawai;

class CutiController extends Controller
{
    public function index()
    {
    	$cutis = Cuti::get();

        return view('pm.cuti_izin.cuti.index',['cutis'=>$cutis]);
    }

    public function approve($id)
    {
    	$cuti = Cuti::find($id);

        return view('pm.cuti_izin.cuti.approve',['cuti'=>$cuti]);
    }

    public function postApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
      
       $cuti['is_accept_pm'] = \Input::get('accept');
       $cuti['is_verif_pm'] = 1;
       $cuti['verif_pm_by'] = \Auth::user()->id;
       $cuti['verify_pm_time'] = date('Y-m-d H:i:s');

       $update = Cuti::where('id',$id)->update($cuti);
      
       return redirect('/pm/cuti');
    }
}

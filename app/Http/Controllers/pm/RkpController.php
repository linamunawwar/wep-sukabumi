<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rkp;
use App\DetailRkp;

class RkpController extends Controller
{
    public function index()
    {
        $rkps = Rkp::where('soft_delete',0)->get();
        return view('pm.rkp.index',['rkps'=>$rkps]);
    }

    public function getApprove($id)
    {
        $rkp = Rkp::where('soft_delete',0)->where('id',$id)->first();
        $dt_rkps = DetailRkp::where('soft_delete',0)->where('id_rkp',$id)->get();
        return view('pm.rkp.approve',['rkp'=>$rkp,'dt_rkps'=>$dt_rkps]);
    }

    public function postApprove($id)
    {
        $rkp = Rkp::find($id);
        if($rkp){
            $data['is_verif_pm'] = 1;
            $data['verify_pm_time'] = date('Y-m-d H:i:s');
            $data['verif_pm_by'] = \Auth::user()->pegawai_id;

            $update = Rkp::where('id',$id)->update($data);
        }
        return redirect('pm/rkp');
    }
}

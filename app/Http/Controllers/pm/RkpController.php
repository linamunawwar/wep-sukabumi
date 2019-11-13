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
        return view('pm.rkp.index',['rkp'=>$rkp,'dt_rkps'=>$dt_rkps]);
    }
}

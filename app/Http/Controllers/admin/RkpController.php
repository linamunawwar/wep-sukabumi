<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rkp;
use App\DetailRkp;

class RkpController extends Controller
{
    public function index()
    {
    	$rkps = Rkp::where('soft_delete',0)->get();
        return view('admin.rkp.index',['rkps'=>$rkps]);
    }

    public function getDetail($id){
    	$rkp = Rkp::find($id);
    	$rkp->site = $rkp->kodeBagian->description;
    	$tanggal = explode(' ', $rkp->created_at->toDateTimeString());
    	$rkp->tanggal = konversi_tanggal($tanggal[0]);
    	$rkp->detail = DetailRkp::where('id_rkp',$id)->where('soft_delete',0)->get();

    	return $rkp;
    }
}

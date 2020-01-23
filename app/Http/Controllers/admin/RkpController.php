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

    public function getDelete(){
      $data = \Input::all();
      $del = Rkp::where('id',$data['id_rkp'])->update(['soft_delete'=>1]);
      $del2 = DetailRkp::where('id_rkp',$data['id_rkp'])->update(['soft_delete'=>1]);

      if($del && $del2){
        return redirect('admin/rkp');
      }

    }
}

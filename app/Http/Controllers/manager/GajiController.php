<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SlipGaji;
use App\Gaji;

class GajiController extends Controller
{
	 public function index()
    {
    	if(\Auth::user()->pegawai->kode_bagian == 'SA'){
	        $gajis = Gaji::where('soft_delete',0)->whereHas('pegawai',function ($q){
	            $q->where('is_active', 1);
	        })->get();
	      }else{
	        $gajis = Gaji::whereHas('pegawai',function ($q){
	            $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian)->where('is_active', 1);
	        })->get();
	      }
        return view('manager.gaji.index', ['gajis'=>$gajis]);
    }

    public function slipGaji()
    {
	    $slip_gajis = SlipGaji::where('soft_delete',0)->get();

        return view('manager.gaji.index_slip',['slip_gajis'=>$slip_gajis]);
    }

    public function approveSlipGaji($id)
    {
	    date_default_timezone_set("Asia/Jakarta");

       $slip_gaji['is_verif_sdm'] = 1;
       $slip_gaji['verif_sdm_by'] = \Auth::user()->id;
       $slip_gaji['verify_sdm_time'] = date('Y-m-d H:i:s');

       $update = SlipGaji::where('id',$id)->update($slip_gaji);
       
       return redirect('/manager/gaji/slip_gaji');
    }
}

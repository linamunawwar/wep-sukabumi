<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gaji;
use App\SlipGaji;
use App\Pegawai;

class GajiController extends Controller
{
    public function index()
    {
    	$gajis = Gaji::whereHas('pegawai',function ($q){
	            $q->where('is_active', 1);
	        })->get();

        return view('admin.gaji.index', ['gajis'=>$gajis]);
    }

    public function getListTransfer()
    {
        return view('admin.gaji.list_transfer');
    }

    public function getEdit($id)
    {
        $gaji = Gaji::find($id);
        return view('admin.gaji.edit',['gaji'=>$gaji]);
    }

    public function postEdit($id){
        $data = \Input::all();

        $find_gaji = Gaji::where('id',$id)->first();

       if($find_gaji){
           $gaji['gaji_pokok'] = $data['gaji_pokok'];
           $gaji['tunj_komunikasi'] = $data['tunj_komunikasi'];
           $gaji['tunj_transportasi'] = $data['tunj_transportasi'];
           $gaji['uang_makan'] = $data['uang_makan'];
           $gaji['tunj_pph21'] = $data['tunj_pph21'];
           $gaji['pph21'] = $data['pph21'];
           $gaji['user_id'] = \Auth::user()->id;
           $gaji['role_id'] = \Auth::user()->role_id;
            $update_gaji = Gaji::where('id',$id)->update($gaji);

            return redirect('/admin/gaji');
        }
    }

    public function slipGaji()
    {
        $slip_gajis = SlipGaji::where('soft_delete',0)->get();

        return view('admin.gaji.index_slip',['slip_gajis'=>$slip_gajis]);
    }

    public function getSlipGajiCreate()
    {
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('admin.gaji.create_slip',['pegawais'=>$pegawais]);
    }

    public function postSlipGajiCreate(){
        $data = \Input::all();
        
        $slip_gaji = new SlipGaji;
        $slip_gaji->nip = $data['nip'];
        $slip_gaji->bulan = $data['bulan'];
        $slip_gaji->tahun = $data['tahun'];
        $slip_gaji->keperluan = $data['keperluan'];
        $slip_gaji->user_id = \Auth::user()->id;
        $slip_gaji->role_id = \Auth::user()->role_id;
        
        $slip_gaji->save();

        return redirect('/admin/gaji/slip_gaji');
    }
}

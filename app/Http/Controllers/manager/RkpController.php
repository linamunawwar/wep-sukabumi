<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rkp;
use App\DetailRkp;


class RkpController extends Controller
{
    public function index()
    {
    	$rkps = Rkp::where('soft_delete',0)->get();
        return view('manager.rkp.index',['rkps'=>$rkps]);
    }
    
    public function getCreate()
    {
        return view('manager.rkp.create');
    }

    public function postCreate()
    {
    	$jml = \Input::get('jumlah_data');

    	$posisi = \Input::get('posisi');
        $tugas = \Input::get('tugas');
        $pendidikan = \Input::get('pendidikan');
        $tahun_kerja = \Input::get('tahun_kerja');
        $jenis_kerja = \Input::get('jenis_kerja');
        $tpa = \Input::get('tpa');
        $ept = \Input::get('ept');
        $jumlah = \Input::get('jumlah');
        $waktu = \Input::get('waktu');
        $jumlah_butuh = 0;
        for($i=0;$i< $jml;$i++){
        	$jumlah_butuh= $jumlah_butuh + (int)$jumlah[$i];
        }

        $rkp = new Rkp;
        $rkp->kode_bagian = \Auth::user()->pegawai->kode_bagian;
        $rkp->kebutuhan = $jumlah_butuh;
        $rkp->soft_delete = 0;

        if($rkp->save()){
        	$id_rkp = $rkp->id;
        	for($i=0;$i< $jml;$i++){
	        	$data['id_rkp']= $id_rkp;
	        	$data['jabatan']= $posisi[$i];
	        	$data['tugas']= $tugas[$i];
	        	$data['pendidikan']= $pendidikan[$i];
	        	$data['tahun_kerja']= $tahun_kerja[$i];
	        	$data['jenis_kerja']= $jenis_kerja[$i];
	        	$data['TPA']= $tpa[$i];
	        	$data['EPT']= $ept[$i];
	        	$data['jumlah_kurang']= $jumlah[$i];
	        	$data['waktu_penempatan']= $waktu[$i];
	        	$data['soft_delete']= 0;
	        	
	        	$save = DetailRkp::create($data);
	        	
	        	if($save){
	        		return redirect('manager/rkp');
	        	}
	        }
        }

        
    }

     
}

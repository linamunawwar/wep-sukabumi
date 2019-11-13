<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rkp;
use App\Posisi;
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
        if(\Auth::user()->pegawai->kode_bagian == 'SA'){
            $posisi = Posisi::where('soft_delete',0)->get();
        }else{
            $posisi = Posisi::where('soft_delete',0)->where('kode',\Auth::user()->pegawai->kode_bagian)->get();
        }
        return view('manager.rkp.create',['posisi'=>$posisi]);
    }

    public function postCreate()
    {
        date_default_timezone_set("Asia/Jakarta");
    	$jml = \Input::get('jumlah_data');

        $unit_kerja = \Input::get('unit_kerja');
        $kebutuhan = \Input::get('kebutuhan');
        $tersedia = \Input::get('tersedia');
        $kurang_lebih = \Input::get('kurang_lebih');
        $masuk = \Input::get('masuk');
        $keluar = \Input::get('keluar');
        $jumlah = \Input::get('jumlah');
        $rekrut = \Input::get('rekrut');
    	$posisi = \Input::get('unit_kerja');
        $tugas = \Input::get('tugas');
        $pendidikan = \Input::get('pendidikan');
        $tahun_kerja = \Input::get('tahun_kerja');
        $jenis_kerja = \Input::get('jenis_kerja');
        $tpa = \Input::get('tpa');
        $ept = \Input::get('ept');
        $butuh = \Input::get('butuh');
        $waktu = \Input::get('waktu');

        $rkp = new Rkp;
        $rkp->kode_bagian = \Auth::user()->pegawai->kode_bagian;
        $rkp->tanggal = date('Y-m-d');
        $rkp->soft_delete = 0;
        $rkp->user_id = \Auth::user()->id;
        $rkp->role_id = \Auth::user()->role_id;
        $rkp->is_verif_pm = 0;

        if($rkp->save()){
        	$id_rkp = $rkp->id;
        	for($i=0;$i< $jml;$i++){
                $data = new DetailRkp;

	        	$data->id_rkp= $id_rkp;
                $data->unit_kerja= $unit_kerja[$i];
                $data->kebutuhan= $kebutuhan[$i];
                $data->tersedia= $tersedia[$i];
                $data->kurang_lebih= $kurang_lebih[$i];
                $data->masuk= $masuk[$i];
                $data->keluar= $keluar[$i];
                $data->jumlah= $jumlah[$i];
                $data->rekrut= $rekrut[$i];
	        	$data->jabatan= $posisi[$i];
	        	$data->tugas= $tugas[$i];
	        	$data->pendidikan= $pendidikan[$i];
	        	$data->tahun_kerja= $tahun_kerja[$i];
	        	$data->jenis_kerja= $jenis_kerja[$i];
	        	$data->TPA= $tpa[$i];
	        	$data->EPT= $ept[$i];
	        	$data->jumlah_kurang= $butuh[$i];
	        	$data->waktu_penempatan= $waktu[$i];
	        	$data->soft_delete= 0;
                $data->user_id = \Auth::user()->id;
                $data->role_id = \Auth::user()->role_id;
	        	
	        	if($data->save()){
                    $simpan = 1;
                }else{
                    $simpan = 0;
                    die();
                }
	        }
            return redirect('manager/rkp');
        }

        
    }

     
}

<?php

namespace App\Http\Controllers\Logistik\Pelaksana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPengajuanPakai;
use App\Models\LogDetailPengajuanPakai;
use App\Models\LogMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;

class PengajuanPemakaianController extends Controller
{
    public function index()
    {
        $pengajuans = LogPengajuanPakai::where('soft_delete', 0)->where('user_id',\Auth::user()->id)->get();
        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->is_som != 1) {
                if ($pengajuan->is_som == null) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Proses Pengecekan";
                } elseif ($pengajuan->is_som == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SOM";
                }
            } elseif ($pengajuan->is_slem != 1) {
                if ($pengajuan->is_slem == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Accepted By SOM";
                } elseif ($pengajuan->is_slem == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SPLEM";
                }
            } elseif ($pengajuan->is_scarm != 1) {
                if ($pengajuan->is_scarm == null) {
                    $pengajuan->color = "";
                    $pengajuan->text = "Acepted By SPLEM";
                } elseif ($pengajuan->is_scarm == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SCARM";
                }
            } elseif ($pengajuan->is_pm != 1) {
                if ($pengajuan->is_pm == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Accepted By SPLEM";
                } elseif ($pengajuan->is_pm == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By PM";
                }
            } elseif ($pengajuan->is_pm == 1) {
                $pengajuan->color = "#74B9FF";
                $pengajuan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.pelaksana.pengajuan.index', ['pengajuans' => $pengajuans,'status'=>$status]);
    }

    public function beforePostPermintaan()
    {

        $materials = LogMaterial::where('soft_delete', 0)->get();
        $jenis_kerjas = Logjenis::where('soft_delete',0)->get();
    	$lokasis = LogLokasi::where('soft_delete',0)->get();
        return view('logistik.pelaksana.pengajuan.create', ['materials' => $materials,'jenis_kerjas'=>$jenis_kerjas,'lokasis'=>$lokasis]);
    }

    // public function cekData()
    // {
    // 	$kode_penerimaan = \Input::get('kode_penerimaan');
    	
    // 	$penerimaan = LogPenerimaanMaterial::where('kode_penerimaan',$kode_penerimaan)->where('soft_delete',0)->first();
    // 	if($waste){
    // 		$datas = LogWasteDetail::where('waste_id',$waste->id)->where('soft_delete',0)->get();
    // 	}else{
    // 		$datas = null;
    // 	}
    // 	if($datas){
	//     	foreach ($datas as $key => $data) {
	//     		$data->pelaksana_nama = $data->pelaksanaPegawai->nama;
	//     		$data->lokasi = $data->wasteLokasi->nama;
	//     	}
	//     }	
    // 	return json_encode($datas);
    // }
}

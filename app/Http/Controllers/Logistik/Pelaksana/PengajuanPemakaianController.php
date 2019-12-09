<?php

namespace App\Http\Controllers\Logistik\Pelaksana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogPengajuanPakai;
use App\Models\LogDetailPengajuanPakai;
use App\Models\LogMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;

class PengajuanPemakaianController extends Controller
{
    public function index()
    {
        $pengajuans = LogPengajuanPakai::where('soft_delete', 0)->get();
        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->is_som != 1) {
                if ($pengajuan->is_som == null) {
                    $status['color'] = "#D63031";
                    $status['text'] = "Proses Pengecekan";
                } elseif ($pengajuan->is_som == 0) {
                    $status['color'] = "#D63031";
                    $status['text'] = "Rejected By SOM";
                }
            } elseif ($pengajuan->is_slem != 1) {
                if ($pengajuan->is_slem == null) {
                    $status['color'] = "#74B9FF";
                    $status['text'] = "Accepted By SOM";
                } elseif ($pengajuan->is_slem == 0) {
                    $status['color'] = "#D63031";
                    $status['text'] = "Rejected By SPLEM";
                }
            } elseif ($pengajuan->is_scarm != 1) {
                if ($pengajuan->is_scarm == null) {
                    $status['color'] = "";
                    $status['text'] = "Acepted By SPLEM";
                } elseif ($pengajuan->is_scarm == 0) {
                    $status['color'] = "#D63031";
                    $status['text'] = "Rejected By SCARM";
                }
            } elseif ($pengajuan->is_pm != 1) {
                if ($pengajuan->is_pm == null) {
                    $status['color'] = "#74B9FF";
                    $status['text'] = "Accepted By SPLEM";
                } elseif ($pengajuan->is_pm == 0) {
                    $status['color'] = "#D63031";
                    $status['text'] = "Rejected By PM";
                }
            } elseif ($pengajuan->is_pm == 1) {
                $status['color'] = "#74B9FF";
                $status['text'] = "Accepted By SPLEM";
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
}

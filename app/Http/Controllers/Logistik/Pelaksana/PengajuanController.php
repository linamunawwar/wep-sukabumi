<?php

namespace App\Http\Controllers\Logistik\Pelaksana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogPengajuanMaterial;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogMaterial;
use App\Models\LogLokasi;
use App\Models\LogJenis;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = LogPengajuanMaterial::where('soft_delete', 0)->get();
        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->id_admin != 1) {
                if ($pengajuan->id_admin == null) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Proses Pengecekan";
                } elseif ($pengajuan->id_admin == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By Admin";
                }
            } elseif ($pengajuan->is_som != 1) {
                if ($pengajuan->is_som == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Accepted By ADMIN";
                } elseif ($pengajuan->is_som == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SOM";
                }
            } elseif ($pengajuan->id_splem != 1) {
                if ($pengajuan->id_splem == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Acepted By SOM";
                } elseif ($pengajuan->id_splem == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SPLEM";
                }
            } elseif ($pengajuan->id_splem == 1) {
                $pengajuan->color = "#74B9FF";
                $pengajuan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.user.pengajuan.index', ['pengajuans' => $pengajuans]);
    }

    public function getDetailByPengajuanId($id)
    {
        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'soft_delete' => 0])->get();
        return view('logistik.user.pengajuan.detail', ['details' => $details]);
    }

    public function beforePostPengajuan()
    {
        $kodePenerimaan = 
        $materials = LogMaterial::where('soft_delete', 0)->get();
        $jenisPekerjaan = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaan = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.user.pengajuan.create', ['materials' => $materials, 'jenisPekerjaan' => $jenisPekerjaan, 'lokasiPekerjaan' => $lokasiPekerjaan]);
    }

}

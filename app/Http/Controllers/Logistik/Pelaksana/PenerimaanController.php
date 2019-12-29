<?php

namespace App\Http\Controllers\Logistik\Pelaksana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPermintaanMaterial;
use App\Models\LogDetailPermintaanMaterial;

use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaans = LogPenerimaanMaterial::where('soft_delete', 0)->get();
        foreach ($penerimaans as $penerimaan) {
            if ($penerimaan->is_splem != 1) {
                if ($penerimaan->is_splem == null) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Proses Pengecekan";
                } elseif ($penerimaan->is_slem == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SPLEM";
                }
            } elseif ($penerimaan->is_pm != 1) {
                if ($penerimaan->is_pm == null) {
                    $penerimaan->color = "#74B9FF";
                    $penerimaan->text = "Accepted By SPLEM";
                } elseif ($penerimaan->is_pm == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By PM";
                }
            } elseif ($penerimaan->is_pm == 1) {
                $penerimaan->color = "#74B9FF";
                $penerimaan->text = "Accepted By PM";
            }
        }
        return view('logistik.pelaksana.penerimaan.index', ['penerimaans' => $penerimaans]);
    }

}

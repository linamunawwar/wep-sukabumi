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
        $penerimaans = LogPenerimaanMaterial::where('soft_delete', 0)
                                            ->whereHas('permintaan', function ($q) {
                                                $q->where('user_id', \Auth::user()->id);
                                            })
                                            ->get();
        foreach ($penerimaans as $penerimaan) {
            if ($penerimaan->is_splem != 1) {
                if ($penerimaan->is_splem == null) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Proses Pengecekan";
                } elseif ($penerimaan->is_splem == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SPLEM";
                }
            } elseif ($penerimaan->is_splem == 1) {
                $penerimaan->color = "#74B9FF";
                $penerimaan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.pelaksana.penerimaan.index', ['penerimaans' => $penerimaans]);
    }

    public function getDetailByPenerimaanId($id)
    {
        $details = LogDetailPenerimaanMaterial::where(['penerimaan_id' => $id, 'soft_delete' => 0])->get();
        $penerimaan = LogPenerimaanMaterial::find($id);
        $permintaan = LogPermintaanMaterial::where('kode_permintaan',$penerimaan->kode_permintaan)->first();
        if(\Auth::user()->id == $permintaan->user_id){
            $toUpdatePenerimaan['is_new'] = 0;

            $updatePenerimaan = LogPenerimaanMaterial::where('id',$id)->update($toUpdatePenerimaan);
        }
        session(['proses'=>1]);
        return view('logistik.pelaksana.penerimaan.detail', ['details' => $details]);
    }

}

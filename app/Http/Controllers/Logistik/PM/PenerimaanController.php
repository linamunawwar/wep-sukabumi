<?php

namespace App\Http\Controllers\Logistik\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPermintaanMaterial;
use App\Models\LogDetailPermintaanMaterial;

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
                } elseif ($penerimaan->is_splem == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SPLEM";
                }
            } elseif ($penerimaan->is_splem == 1) {
                $penerimaan->color = "#74B9FF";
                $penerimaan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.pm.penerimaan.index', ['penerimaans' => $penerimaans]);
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
        
        return view('logistik.pm.penerimaan.detail', ['details' => $details]);
    }

    // public function beforeApprovePenerimaan($id)
    // {
    //     $findPenerimaan = LogPenerimaanMaterial::where('id', $id)->where('soft_delete', 0)->first();
    //     if ($findPenerimaan) {
    //         $getDetailPenerimaan = logDetailPenerimaanMaterial::where('penerimaan_id', $findPenerimaan->id)->where('soft_delete', 0)->get();
    //     }

    //     return view('logistik.pm.penerimaan.approve', ['penerimaans' => $findPenerimaan, 'details' => $getDetailPenerimaan]);
    // }

    // public function approvePenerimaan($id)
    // {
    //     date_default_timezone_set("Asia/Jakarta");
    //     $find = LogPenerimaanMaterial::where('id', $id)->where('soft_delete', 0)->first();
    //     if ($find) {
    //         $cekApprove = \Input::get('approve');
    //         $cekReject = \Input::get('reject');
    //         if (\Auth::user()->pegawai->posisi_id == 1) { //pm
    //             if (isset($cekApprove)) {
    //                 $dt['is_pm'] = 1;
    //                 $dt['is_pm_at'] = date('Y-m-d H:i:s');
    //                 $dt['note_pm'] = \Input::get('note');
    //                 $dt['is_notif'] = 1;
    //             } elseif (isset($cekReject)) {
    //                 $dt['is_pm'] = 0;
    //                 $dt['is_pm_at'] = date('Y-m-d H:i:s');
    //                 $dt['note_pm'] = \Input::get('note');
    //             }
    //             $update = LogPenerimaanMaterial::where('id', $id)->update($dt);
    //         }
    //     }
    //     return redirect('Logistik/pm/penerimaan');
    // }
}

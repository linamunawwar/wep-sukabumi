<?php

namespace App\Http\Controllers\Logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogDetailPermintaanMaterial;
use App\Models\LogMaterial;
use App\Models\LogPermintaanMaterial;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaans = LogPermintaanMaterial::where('soft_delete', 0)->get();
        foreach ($permintaans as $permintaan) {
            if ($permintaan->is_som != 1) {
                if ($permintaan->is_som == NULL) {
                    $cekStatus = "Proses Pengecekan";
                } elseif ($permintaan->is_som == 0) {
                    $cekStatus = "Rejected By SOM";
                }
            } elseif ($permintaan->is_slem != 1) {
                if ($permintaan->is_slem == NULL) {
                    $cekStatus = "Accepted By SOM";
                } elseif ($permintaan->is_slem == 0) {
                    $cekStatus = "Rejected By SPLEM";
                }
            } elseif ($permintaan->is_scarm != 1) {
                if ($permintaan->is_scarm == NULL) {
                    $cekStatus = "Acepted By SPLEM";
                } elseif ($permintaan->is_scarm == 0) {
                    $cekStatus = "Rejected By SCARM";
                }
            } elseif ($permintaan->is_pm != 1) {
                if ($permintaan->is_pm == NULL) {
                    $cekStatus = "Accepted By SPLEM";
                } elseif ($permintaan->is_pm == 0) {
                    $cekStatus = "Rejected By PM";
                }
            } elseif ($permintaan->is_pm == 1) {
                $cekStatus = "Accepted By SPLEM";
            }
        }

        return view('logistik.admin.permintaan.index', ['permintaans' => $permintaans]);
    }

    public function beforePostPermintaan()
    {

        $materials = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.admin.permintaan.create', ['materials' => $materials]);
    }

    public function postPermintaan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
        $noPart = \Input::get('no_part');
        $volume = \Input::get('volume');
        $satuan = \Input::get('satuan');
        $keperluan = \Input::get('keperluan');

        $addPermintaan = new LogPermintaanMaterial;
        $addPermintaan->tanggal = date('Y-m-d');
        $addPermintaan->user_id = \Auth::user()->id;
        $addPermintaan->soft_delete = 0;
        $addPermintaan->created_at = date('Y-m-d');

        if ($addPermintaan->save()) {
            $permintaanId = $addPermintaan->id;
            $jmlPermintaan = \Input::get('jumlah_data');
            for ($i = 0; $i < $jmlPermintaan; $i++) {
                $addDetailPemintaanMaterial = new LogDetailPermintaanMaterial;
                $addDetailPemintaanMaterial->permintaan_id = $permintaanId;
                $addDetailPemintaanMaterial->material_id = $materialId[$i];
                $addDetailPemintaanMaterial->no_part = $noPart[$i];
                $addDetailPemintaanMaterial->volume = $volume[$i];
                $addDetailPemintaanMaterial->satuan = $satuan[$i];
                $addDetailPemintaanMaterial->keperluan = $keperluan[$i];
                $addDetailPemintaanMaterial->user_id = \Auth::user()->id;
                $addDetailPemintaanMaterial->soft_delete = 0;
                $addDetailPemintaanMaterial->created_at = date('Y-m-d');

                if ($addDetailPemintaanMaterial->save()) {
                    $saveStatus = 1;
                } else {
                    $saveStatus = 0;
                    die();
                }
            }
            
            return redirect('Logistik/admin/permintaan');

        }

    }
}

<?php

namespace App\Http\Controllers\Logistik\Manager;

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
                if ($permintaan->is_som == null) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Proses Pengecekan";
                } elseif ($permintaan->is_som == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SOM";
                }
            } elseif ($permintaan->is_slem != 1) {
                if ($permintaan->is_slem == null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Accepted By SOM";
                } elseif ($permintaan->is_slem == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SPLEM";
                }
            } elseif ($permintaan->is_scarm != 1) {
                if ($permintaan->is_scarm == null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Acepted By SPLEM";
                } elseif ($permintaan->is_scarm == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SCARM";
                }
            } elseif ($permintaan->is_pm != 1) {
                if ($permintaan->is_pm == null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Accepted By SPLEM";
                } elseif ($permintaan->is_pm == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By PM";
                }
            } elseif ($permintaan->is_pm == 1) {
                $permintaan->color = "#74B9FF";
                $permintaan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.manager.permintaan.index', ['permintaans' => $permintaans]);
    }

    public function beforePostPermintaan()
    {

        $materials = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.manager.permintaan.create', ['materials' => $materials]);
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
            return redirect('Logistik/manager/permintaan');
        }
    }

    public function getDetailByPermintaanId($id)
    {
        $details = LogDetailPermintaanMaterial::where(['permintaan_id' => $id, 'soft_delete' => 0])->get();
        return view('logistik.manager.permintaan.detail', ['details' => $details]);
    }

    public function getPermintaanById($id)
    {
        $permintaan = LogPermintaanMaterial::where('id', $id)->get();
        $detailPermintaan = LogDetailPermintaanMaterial::where(['permintaan_id' => $id, 'soft_delete' => 0])->get();
        $materials = LogMaterial::where('soft_delete', 0)->get();

        return view('logistik.manager.permintaan.edit', ['permintaan' => $permintaan, 'detail' => $detailPermintaan, 'materials' => $materials]);
    }

    public function updatePermintaan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
        $noPart = \Input::get('no_part');
        $volume = \Input::get('volume');
        $satuan = \Input::get('satuan');
        $keperluan = \Input::get('keperluan');

        $toUpdatePermintaan['updated_at'] = date('Y-m-d');
        $updatedPermintaan = LogPermintaanMaterial::where('id', $id)->update($toUpdatePermintaan);

        $jmlPermintaan = \Input::get('jumlah_data');
        for ($i = 0; $i < $jmlPermintaan; $i++) {
            $addDetailPemintaanMaterial = new LogDetailPermintaanMaterial;
            $addDetailPemintaanMaterial->permintaan_id = $id;
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
        return redirect('Logistik/manager/permintaan');
    }

    public function deleteDetailPermintaanMaterial($detail, $permintaan)
    {
        $deleteDetailPermintaan = LogDetailPermintaanMaterial::where('id', $detail)->update(['soft_delete' => 1]);

        return redirect('Logistik/manager/permintaan/edit/' . $permintaan . '');

    }

    public function deletePermintaan()
    {
        $dataDelete = \Input::all();
        $deletePermintaan = LogPermintaanMaterial::where('id', $dataDelete['id_permintaan'])->update(['soft_delete' => 1]);

        if ($deletePermintaan) {
            $deleteAllDetailPermintaan = LogDetailPermintaanMaterial::where('permintaan_id', $dataDelete['id_permintaan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/manager/permintaan');
        }
    }
}

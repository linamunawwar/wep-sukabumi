<?php

namespace App\Http\Controllers\Logistik\Manager;

use App\Http\Controllers\Controller;
use App\Models\LogDetailPermintaanMaterial;
use App\Models\LogMaterial;
use App\Models\LogPermintaanMaterial;

class PermintaanController extends Controller
{
    public function randomKey()
    {
        $panjang = 5;
        $Huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $Angka = "1234567890";
        $kodeHuruf = '';
        $kodeAngka = '';
        $kode = '';

        for ($i = 0; $i < $panjang; $i++) {
            $kodeHuruf .= $Huruf[rand(0, strlen($Huruf) - 1)];
            $kodeAngka .= $Angka[rand(0, strlen($Angka) - 1)];
        }

        $kode = $kodeHuruf . "" . $kodeAngka;
        return $kode;
    }
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
                $permintaan->text = "Accepted By PM";
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

        $kodePermintaan = PermintaanController::randomKey();
        $getKodePermintaan = LogPermintaanMaterial::where('kode_permintaan', $kodePermintaan)->get();
        while (empty($getKodePermintaan)) {
            $kodePermintaan = PermintaanController::randomKey();
        }

        $addPermintaan = new LogPermintaanMaterial;
        $addPermintaan->kode_permintaan = $kodePermintaan;
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
        $permintaan = LogPermintaanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();
        $detailPermintaan = LogDetailPermintaanMaterial::where(['permintaan_id' => $permintaan->id, 'soft_delete' => 0])->get();
        $materials = LogMaterial::where('soft_delete', 0)->get();

        return view('logistik.pm.permintaan.edit', ['permintaan' => $permintaan, 'detail' => $detailPermintaan, 'materials' => $materials]);
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

    public function beforeApprovePermintaan($id)
    {
        $findPermintaan = LogPermintaanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($findPermintaan) {
            $getDetailPermintaan = logDetailPermintaanMaterial::where('permintaan_id', $findPermintaan->id)->where('soft_delete', 0)->get();
        }

        return view('logistik.manager.permintaan.approve', ['permintaans' => $findPermintaan, 'details' => $getDetailPermintaan]);
    }

    public function approvePermintaan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $find = LogPermintaanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($find) {
            $cekApprove = \Input::get('approve');
            $cekReject = \Input::get('reject');
            if (\Auth::user()->pegawai->posisi_id == 8) { //splem
                if (isset($cekApprove)) {
                    $dt['is_som'] = 1;
                    $dt['is_som_at'] = date('Y-m-d H:i:s');
                    $dt['note_som'] = \Input::get('note');
                } elseif (isset($cekReject)) {
                    $dt['is_som'] = 0;
                    $dt['is_som_at'] = date('Y-m-d H:i:s');
                    $dt['note_som'] = \Input::get('note');
                }
                $update = LogPermintaanMaterial::where('id', $id)->update($dt);
            } elseif (\Auth::user()->pegawai->posisi_id == 7) { //sem
                if (isset($cekApprove)) {
                    $dt['is_slem'] = 1;
                    $dt['is_slem_at'] = date('Y-m-d H:i:s');
                    $dt['note_slem'] = \Input::get('note');
                } elseif (isset($cekReject)) {
                    $dt['is_slem'] = 0;
                    $dt['is_slem_at'] = date('Y-m-d H:i:s');
                    $dt['note_slem'] = \Input::get('note');
                }
                $update = LogPermintaanMaterial::where('id', $id)->update($dt);
            } elseif (\Auth::user()->pegawai->posisi_id == 5) { //scarm
                if (isset($cekApprove)) {
                    $dt['is_scarm'] = 1;
                    $dt['is_scarm_at'] = date('Y-m-d H:i:s');
                    $dt['note_scarm'] = \Input::get('note');
                } elseif (isset($cekReject)) {
                    $dt['is_scarm'] = 0;
                    $dt['is_scarm_at'] = date('Y-m-d H:i:s');
                    $dt['note_scarm'] = \Input::get('note');
                }
                $update = LogPermintaanMaterial::where('id', $id)->update($dt);
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

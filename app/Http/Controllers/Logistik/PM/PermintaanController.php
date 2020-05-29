<?php

namespace App\Http\Controllers\Logistik\PM;

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
                if ($permintaan->is_som == Null) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Proses Pengecekan";
                } elseif ($permintaan->is_som == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SOM";
                }
            } elseif ($permintaan->is_slem != 1) {
                if ($permintaan->is_slem == Null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Accepted By SOM";
                } elseif ($permintaan->is_slem == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SPLEM";
                }
            } elseif ($permintaan->is_scarm != 1) {
                if ($permintaan->is_scarm == Null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Acepted By SPLEM";
                } elseif ($permintaan->is_scarm == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SCARM";
                }
            } elseif ($permintaan->is_pm != 1) {
                if ($permintaan->is_pm == Null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Accepted By SCARM";
                } elseif ($permintaan->is_pm == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By PM";
                }
            } elseif ($permintaan->is_pm == 1) {
                $permintaan->color = "#74B9FF";
                $permintaan->text = "Accepted By PM";
            }

            if($permintaan->is_notif == 1) {
                $permintaan->notifColor = "#FF9800";
                $permintaan->notifStyle = 'margin-left:-22px; color:#0984E3;';
                $permintaan->notifIcon = "fa fa-star ";
            }else {
                $permintaan->notifColor = "#FF9800";
                $permintaan->notifStyle = "";
                $permintaan->notifIcon = "";
            }
        }
        return view('logistik.pm.permintaan.index', ['permintaans' => $permintaans]);
    }

    public function beforePostPermintaan()
    {

        $materials = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.pm.permintaan.create', ['materials' => $materials]);
    }

    public function postPermintaan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
        $noPart = \Input::get('no_part');
        $volume = \Input::get('volume');
        $satuan = \Input::get('satuan');
        $keperluan = \Input::get('keperluan');
        $keterangan = \Input::get('keterangan');

        if(\Input::get('jumlah_data') != 0){

            $kodePermintaan = PermintaanController::randomKey();
            $getKodePermintaan = LogPermintaanMaterial::where('kode_permintaan', $kodePermintaan)->get();
            while (empty($getKodePermintaan)) {
                $kodePermintaan = PermintaanController::randomKey();
            }

            if(\Input::hasfile('file')){
              $ori_file  = \Request::file('file');
             $tujuan = "upload/permintaan";
             $nama_file = $ori_file->getClientOriginalName();

            $ori_file->move($tujuan,$nama_file);
           }else{
                $nama_file='';
           }

            $addPermintaan = new LogPermintaanMaterial;
            $addPermintaan->kode_permintaan = $kodePermintaan;
            $addPermintaan->tanggal = date('Y-m-d');
            $addPermintaan->file = $nama_file;
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
                    $addDetailPemintaanMaterial->keterangan = $keterangan[$i];
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
                return redirect('Logistik/pm/permintaan');
            }
        }else{
            $materials = LogMaterial::where('soft_delete', 0)->get();
            return view('logistik.pm.permintaan.create', ['materials' => $materials,'message'=>'Material Belum Diisi']);
        }

    }

    public function getDetailByPermintaanId($id)
    {
        $notifPermintaan = LogPermintaanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();
        
        if($notifPermintaan->is_pm == 1) {
            $notifPermintaan['titleNamePm']  = 'PM';
            $dateTime = (explode(" ", $notifPermintaan->is_pm_at));
            $notifPermintaan['bodyDatePm']   = date('d F Y', strtotime($dateTime[0]));
            $notifPermintaan['bodyTimePm']   = $dateTime[1];
        }else{
            $notifPermintaan['titleNamePm']  = '-';
            $notifPermintaan['bodyDatePM']   = '-';
            $notifPermintaan['bodyTimePM']   = '-';
        }

        if($notifPermintaan->is_scarm == 1){
            $notifPermintaan['titleNameScarm']  = 'SCARM';
            $dateTime = (explode(" ", $notifPermintaan->is_scarm_at));
            $notifPermintaan['bodyDateScarm']   = date('d F Y', strtotime($dateTime[0]));
            $notifPermintaan['bodyTimeScarm']   = $dateTime[1];
        }else{
            $notifPermintaan['titleNameScarm']  = '-';
            $notifPermintaan['bodyDateScarm']   = '-';
            $notifPermintaan['bodyTimeScarm']   = '-';
        }

        if($notifPermintaan->is_slem == 1){
            $notifPermintaan['titleNameSlem']  = 'SPLEM';
            $dateTime = (explode(" ", $notifPermintaan->is_slem_at));
            $notifPermintaan['bodyDateSlem']   = date('d F Y', strtotime($dateTime[0]));
            $notifPermintaan['bodyTimeSlem']   = $dateTime[1];
        }else{
            $notifPermintaan['titleNameSlem']  = '-';
            $notifPermintaan['bodyDateSlem']   = '-';
            $notifPermintaan['bodyTimeSlem']   = '-';
        }
        
        if($notifPermintaan->is_som == 1){
            $notifPermintaan['titleNameSom']  = 'SOM';
            $dateTime = (explode(" ", $notifPermintaan->is_som_at));
            $notifPermintaan['bodyDateSom']   = date('d F Y', strtotime($dateTime[0]));
            $notifPermintaan['bodyTimeSom']   = $dateTime[1];
        }else{
            $notifPermintaan['titleNameSom']  = '-';
            $notifPermintaan['bodyDateSom']   = '-';
            $notifPermintaan['bodyTimeSom']   = '-';
        }

        $details = LogDetailPermintaanMaterial::where(['permintaan_id' => $id, 'soft_delete' => 0])->get();
        $permintaans = LogPermintaanMaterial::where('soft_delete',0)->get();
        foreach ($permintaans as $key => $permintaan) {
           if ($permintaan->id == $id) {
               $findPermintaan['nomor'] = $key+1;
           }
        }

        session(['proses'=>1]);
        
        return view('logistik.pm.permintaan.detail', ['details' => $details,'findPermintaan'=>$findPermintaan, 'notifPermintaan' => $notifPermintaan]);
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
        $keterangan = \Input::get('keterangan');

        $data_awal = LogPermintaanMaterial::find($id);
        if(\Input::hasfile('file')){
          if(file_exists('upload/permintaan/'.$data_awal->file))
          {
            unlink("upload/permintaan/".$data_awal->file);
          }
          $ori_file  = \Request::file('file');
         $tujuan = "upload/permintaan";
         $nama_file = $ori_file->getClientOriginalName();

        $ori_file->move($tujuan,$nama_file);
         $toUpdatePermintaan['file'] = $nama_file;
       }

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
            $addDetailPemintaanMaterial->keterangan = $keterangan[$i];
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
        return redirect('Logistik/pm/permintaan');
    }

    public function beforeApprovePermintaan($id)
    {
        $findPermintaan = LogPermintaanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($findPermintaan) {
            $getDetailPermintaan = logDetailPermintaanMaterial::where('permintaan_id', $findPermintaan->id)->where('soft_delete', 0)->get();
        }

        // dd($getDetailPermintaan);
        return view('logistik.pm.permintaan.approve', ['permintaans' => $findPermintaan, 'details' => $getDetailPermintaan]);
    }

    public function approvePermintaan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $find = LogPermintaanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($find) {
            $cekApprove = \Input::get('approve');
            $cekReject = \Input::get('reject');
            if (\Auth::user()->pegawai->posisi_id == 1) { //splem
                if (isset($cekApprove)) {
                    $dt['is_pm'] = 1;
                    $dt['is_pm_at'] = date('Y-m-d H:i:s');
                    $dt['note_pm'] = \Input::get('note');

                    $dt['is_notif'] = 1;
                } elseif (isset($cekReject)) {
                    $dt['is_pm'] = 0;
                    $dt['is_pm_at'] = date('Y-m-d H:i:s');
                    $dt['note_pm'] = \Input::get('note');
                }
                $update = LogPermintaanMaterial::where('id', $id)->update($dt);
            }
        }
        return redirect('Logistik/pm/permintaan');
    }

    public function deleteDetailPermintaanMaterial($detail, $permintaan)
    {
        // $deleteDetailPermintaan = LogDetailPermintaanMaterial::where('id', $detail)->update(['soft_delete' => 1]);
        $deleteDetailPermintaan = LogDetailPermintaanMaterial::where('id', $detail)->delete();

        return redirect('Logistik/pm/permintaan/edit/' . $permintaan . '');

    }

    public function deletePermintaan()
    {
        $dataDelete = \Input::all();
        $deletePermintaan = LogPermintaanMaterial::where('id', $dataDelete['id_permintaan'])->delete();
        // $deletePermintaan = LogPermintaanMaterial::where('id', $dataDelete['id_permintaan'])->update(['soft_delete' => 1]);

        if ($deletePermintaan) {
            $deleteAllDetailPermintaan = LogDetailPermintaanMaterial::where('permintaan_id', $dataDelete['id_permintaan'])->delete();
            // $deleteAllDetailPermintaan = LogDetailPermintaanMaterial::where('permintaan_id', $dataDelete['id_permintaan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/pm/permintaan');
        }
    }
}

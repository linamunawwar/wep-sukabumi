<?php

namespace App\Http\Controllers\Logistik\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;
use App\Models\LogMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;

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

    public function beforePostPengajuan()
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        $jenisPekerjaans = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaans = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.user.pengajuan.create', ['materials' => $materials, 'jenisPekerjaans' => $jenisPekerjaans, 'lokasiPekerjaans' => $lokasiPekerjaans]);
    }

    public function cekData()
    {
        $kode_penerimaan = \Input::get('kode_penerimaan');
        $penerimaans = LogPenerimaanMaterial::where(['kode_penerimaan' => $kode_penerimaan, 'soft_delete' => 0])->get();
        if ($penerimaans) {
            foreach ($penerimaans as $key => $val) {
                $datas = LogDetailPenerimaanMaterial::where('penerimaan_id', $val['id'])->where('soft_delete', 0)->get();
            }
        } else {
            $datas = null;
        }
        if ($datas) {
            foreach ($datas as $key => $data) {
                $data->material_nama = $data->material->nama;
                $data->material_satuan = $data->satuan;
                if ($penerimaans) {
                    foreach ($penerimaans as $key => $penerimaan) {
                        $material = LogDetailPenerimaanMaterial::where('penerimaan_id', $penerimaan->id)->where('material_id', $data->material_id)->where('soft_delete', 0)->first();
                    }
                }
            }
        }
        return json_encode($datas);
    }

    public function postPengajuan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $jml = \Input::get('jumlah_data');

        $kode_penerimaan = \Input::get('kodePenerimaan');
        $jenis_pekerjaan = \Input::get('jenisPekerjaan');
        $lokasi_pekerjaan = \Input::get('lokasiPekerjaan');
        $volume = \Input::get('volume');
        $no_wbs = \Input::get('no_wbs');

        $element_activity = \Input::get('element_activity');
        $material = \Input::get('material');
        $permintaan_satuan = \Input::get('permintaan_satuan');
        $permintaan_jumlah = \Input::get('permintaan_jumlah');

        $addPengajuan = new LogPengajuanMaterial;
        $addPengajuan->kode_penerimaan = $kode_penerimaan;
        $addPengajuan->tanggal = date('Y-m-d');
        $addPengajuan->jenis_pekerjaan_id = $jenis_pekerjaan;
        $addPengajuan->lokasi_kerja_id = $lokasi_pekerjaan;
        $addPengajuan->volume = $volume;
        $addPengajuan->no_wbs = $no_wbs;
        $addPengajuan->user_id = \Auth::user()->id;
        $addPengajuan->created_at = date('Y-m-d');

        echo $jml;

        if ($addPengajuan->save()) {
            $pengajuanId = $addPengajuan->id;
            for ($i = 0; $i < $jml; $i++) {
                $addDetailPengajuanMaterial = new LogDetailPengajuanMaterial;
                $addDetailPengajuanMaterial->pengajuan_id = $pengajuanId;
                $addDetailPengajuanMaterial->element_activity = $element_activity[$i];
                $addDetailPengajuanMaterial->material_id = $material[$i];
                $addDetailPengajuanMaterial->permintaan_satuan = $permintaan_satuan[$i];
                $addDetailPengajuanMaterial->permintaan_jumlah = $permintaan_jumlah[$i];
                $addDetailPengajuanMaterial->user_id = \Auth::user()->id;
                $addDetailPengajuanMaterial->created_at = date('Y-m-d');

                $addDetailPengajuanMaterial->save();
            }
        }
        return redirect('Logistik/user/pengajuan');
    }

    public function getDetailByPengajuanId($id)
    {
        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'soft_delete' => 0])->get();
        return view('logistik.user.pengajuan.detail', ['details' => $details]);
    }

    public function getPengajuanById($id)
    {
        $pengajuan = LogPengajuanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();
        $detailPengajuan = LogDetailPengajuanMaterial::where(['pengajuan_id' => $pengajuan->id, 'soft_delete' => 0])->get();
        $jenisPekerjaans = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaans = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.user.pengajuan.edit', ['pengajuan' => $pengajuan, 'details' => $detailPengajuan, 'jenisPekerjaans' => $jenisPekerjaans, 'lokasiPekerjaans' => $lokasiPekerjaans]);
    }

    public function updatePengajuan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $jml = \Input::get('jumlah_data');

        $kode_penerimaan = \Input::get('kodePenerimaan');
        $jenis_pekerjaan = \Input::get('jenisPekerjaan');
        $lokasi_pekerjaan = \Input::get('lokasiPekerjaan');
        $volume = \Input::get('volume');
        $no_wbs = \Input::get('no_wbs');

        $detailPengajuanId = \Input::get('detailPengajuanId');
        $element_activity = \Input::get('elementActivity');
        $material = \Input::get('material');
        $permintaan_satuan = \Input::get('permintaanSatuan');
        $permintaan_jumlah = \Input::get('permintaan_jumlah');

        $toUpdatePengajuanMaterial['jenis_pekerjaan_id'] = $jenis_pekerjaan;
        $toUpdatePengajuanMaterial['lokasi_kerja_id'] = $lokasi_pekerjaan;
        $toUpdatePengajuanMaterial['volume'] = $volume;
        $toUpdatePengajuanMaterial['no_wbs'] = $no_wbs;
        $toUpdatePengajuanMaterial['updated_at'] = date('Y-m-d');
        $updatedPengajuanMaterial = LogPengajuanMaterial::where(['id' => $id, 'kode_penerimaan' => $kode_penerimaan])->update($toUpdatePengajuanMaterial);

        for ($i=0; $i < $jml; $i++) { 
            $toUpdateDetailPengajuanMaterial['element_activity'] = $element_activity[$i];
            $toUpdateDetailPengajuanMaterial['material_id'] = $material[$i];
            $toUpdateDetailPengajuanMaterial['permintaan_satuan'] = $permintaan_satuan[$i];
            $toUpdateDetailPengajuanMaterial['permintaan_jumlah'] = $permintaan_jumlah[$i];

            $updatedDetailPengajuanMaterial = LogDetailPengajuanMaterial::where(['id' => $detailPengajuanId[$i], 'pengajuan_id' => $id])->update($toUpdateDetailPengajuanMaterial);
        }

        return redirect('Logistik/user/pengajuan');
    }

    public function deletePengajuan()
    {
        $dataDelete = \Input::all();
        $deletePermintaan = LogPengajuanMaterial::where('id', $dataDelete['id_pengajuan'])->update(['soft_delete' => 1]);

        if ($deletePermintaan) {
            $deleteAllDetailPermintaan = LogDetailPengajuanMaterial::where('pengajuan_id', $dataDelete['id_pengajuan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/user/pengajuan');
        }
    }
}

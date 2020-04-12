<?php

namespace App\Http\Controllers\Logistik\Manager;

use Illuminate\Http\Request;
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
        $pengajuans = LogPengajuanMaterial::where('soft_delete', 0)->orderBy('id')->get();
        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->is_som != 1) {
                if ($pengajuan->is_som == null) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Proses Pengecekan";
                } elseif ($pengajuan->is_som == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SOM";
                }
            } elseif ($pengajuan->is_splem != 1) {
                if ($pengajuan->is_splem == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Acepted By SOM";
                } elseif ($pengajuan->is_splem == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SPLEM";
                }
            } elseif ($pengajuan->is_splem == 1) {
                $pengajuan->color = "#74B9FF";
                $pengajuan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.manager.pengajuan.index', ['pengajuans' => $pengajuans]);
    }

    public function beforeApprovePengajuan($id)
    {
        $findPengajuan = LogPengajuanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($findPengajuan) {
            $getDetailPengajuan = LogDetailPengajuanMaterial::where('pengajuan_id', $findPengajuan->id)->where('soft_delete', 0)->get();
        }

        return view('logistik.manager.pengajuan.approve', ['pengajuan' => $findPengajuan, 'details' => $getDetailPengajuan]);
    }
    
    public function approvePengajuan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $find = LogPengajuanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($find) {
            $cekApprove = \Input::get('approve');
            $cekReject = \Input::get('reject');
            $jml = \input::get('jumlahData');
            $detailId = \input::get('detailId');
            $permintaanSatuan = \input::get('permintaanSatuan');
            $permintaanJumlah = \input::get('permintaanJumlah');
            
            if (\Auth::user()->pegawai->posisi_id == 8) { //splem
                if (isset($cekApprove)) {
                    $dt['is_som'] = 1;
                    $dt['is_som_at'] = date('Y-m-d H:i:s');
                    
                } elseif (isset($cekReject)) {
                    $dt['is_som'] = 0;
                    $dt['is_som_at'] = date('Y-m-d H:i:s');

                    $dt['is_admin'] = Null; 
                }
                $dt['note_som'] = \Input::get('note');
                $update = LogPengajuanMaterial::where('id', $id)->update($dt);
                if ($update) {
                    for ($i=0; $i < $jml; $i++) { 
                        $dp['permintaan_satuan'] = $permintaanSatuan[$i];
                        $dp['permintaan_jumlah'] = $permintaanJumlah[$i];

                        $updateDetail = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'id' => $detailId[$i]])->update($dp);
                    }
                }
            }elseif (\Auth::user()->pegawai->posisi_id == 7) {
                if (isset($cekApprove)) {
                    $dt['is_splem'] = 1;
                    $dt['is_splem_at'] = date('Y-m-d H:i:s');
                    $dt['is_notif'] = 1;
                } elseif (isset($cekReject)) {
                    $dt['is_splem'] = 0;
                    $dt['is_splem_at'] = date('Y-m-d H:i:s');
                }
                $dt['note_splem'] = \Input::get('note');
                $update = LogPengajuanMaterial::where('id', $id)->update($dt);
                if ($update) {
                    for ($i=0; $i < $jml; $i++) { 
                        $dp['permintaan_satuan'] = $permintaanSatuan[$i];
                        $dp['permintaan_jumlah'] = $permintaanJumlah[$i];

                        $updateDetail = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'id' => $detailId[$i]])->update($dp);
                    }
                }
            }
        }
        return redirect('Logistik/manager/pengajuan');
    }

    public function getDetailByPengajuanId($id)
    {
        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'soft_delete' => 0])->get();
        return view('logistik.manager.pengajuan.detail', ['details' => $details]);
    }

    public function getPengajuanById($id)
    {
        $pengajuan = LogPengajuanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();
        $detailPengajuan = LogDetailPengajuanMaterial::where(['pengajuan_id' => $pengajuan->id, 'soft_delete' => 0])->get();
        $jenisPekerjaans = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaans = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.manager.pengajuan.edit', ['pengajuan' => $pengajuan, 'details' => $detailPengajuan, 'jenisPekerjaans' => $jenisPekerjaans, 'lokasiPekerjaans' => $lokasiPekerjaans]);
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
        // $penyerahan_satuan = \Input::get('permintaanSatuan');
        // $penyerahan_jumlah = \Input::get('pemyerahanJumlah');

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
            $toUpdateDetailPengajuanMaterial['penyerahan_satuan'] = $penyerahan_satuan[$i];
            $toUpdateDetailPengajuanMaterial['pemyerahan_jumlah'] = $penyerahan_jumlah[$i];

            $updatedDetailPengajuanMaterial = LogDetailPengajuanMaterial::where(['id' => $detailPengajuanId[$i], 'pengajuan_id' => $id])->update($toUpdateDetailPengajuanMaterial);
        }

        return redirect('Logistik/manager/pengajuan');
    }

    public function deletePengajuan()
    {
        $dataDelete = \Input::all();
        $deletePengajuan = LogPengajuanMaterial::where('id', $dataDelete['id_pengajuan'])->update(['soft_delete' => 1]);

        if ($deletePengajuan) {
            $deleteAllDetailPengajuan = LogDetailPengajuanMaterial::where('pengajuan_id', $dataDelete['id_pengajuan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/admin/pengajuan');
        }
    }
}

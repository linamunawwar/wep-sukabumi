<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\LogMaterial;
use App\Models\LogDetailPengajuanPakai;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogDetailPenerimaanMaterial;


class SearchMaterialController extends Controller
{
    public function index()
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        foreach ($materials as $key => $val) {
            $detailPermintaan = LogDetailPenerimaanMaterial::where(['material_id' => $val->id, 'soft_delete' => 0])
                                                    ->orderBy('id', 'desc')
                                                    ->first();
            if ($detailPermintaan) {
                $val->jumlahStok = $detailPermintaan->sisa_stok;
            }else{
                $val->jumlahStok = 0;
            }
        }
        return view('logistik.admin.search_material.index', ['materials' => $materials]);
    }

    public function getDetailBySearchMaterialId($id)
    {
        $detailMaterial = LogDetailPenerimaanMaterial::where(['material_id' => $id, 'soft_delete' => 0])
                                                    ->select('material_id', 'sisa_stok')
                                                    ->orderBy('id', 'desc')
                                                    ->first();
        
        $detailLaporanMasuk = LogDetailPenerimaanMaterial::
                                                        join('users', 'users.id', '=', 'log_tr_penerimaan_detail.user_id')
                                                        ->where(['material_id' => $id, 'soft_delete' => 0])
                                                        ->select('*','users.name as penerimaMasuk')
                                                        ->orderBy('log_tr_penerimaan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();

        $detailLaporanKeluar = LogDetailPengajuanMaterial::
                                                        join('users', 'users.id', '=', 'log_tr_pengajuan_detail.user_id')
                                                        ->where(['material_id' => $id, 'soft_delete' => 0])
                                                        ->select('*','log_tr_pengajuan_detail.updated_at as tanggal_keluar', 'users.name as penerimaKeluar')
                                                        ->orderBy('log_tr_pengajuan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();
        
        $detailLaporanMaterial = array_merge($detailLaporanMasuk, $detailLaporanKeluar);

        // dd($detailLaporanMaterial);
        return view('logistik.admin.search_material.detail', ['material' => $detailMaterial, 'details' => $detailLaporanMaterial]);
    }
}

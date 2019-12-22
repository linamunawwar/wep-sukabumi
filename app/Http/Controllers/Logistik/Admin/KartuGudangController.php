<?php

namespace App\Http\Controllers\logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogMaterial;
use DB;

class KartuGudangController extends Controller
{
    public function index()
    {
        $bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
        $getMaterial = LogMaterial::where('soft_delete', 0)->get();
        $getJoinGudang = DB::table('log_tr_penerimaan')
            ->select('log_tr_penerimaan.tanggal', 'log_tr_penerimaan_detail.volume', 'log_tr_pengajuan_detail.pemyerahan_jumlah')
            ->join('log_tr_penerimaan_detail', 'log_tr_penerimaan_detail.penerimaan_id', '=', 'log_tr_penerimaan.id')
            ->join('log_tr_pengajuan', 'log_tr_pengajuan.kode_penerimaan', '=', 'log_tr_penerimaan.kode_penerimaan')            
            ->join('log_tr_pengajuan_detail', 'log_tr_pengajuan_detail.pengajuan_id', '=', 'log_tr_pengajuan.id')            
            ->get();

        return view('logistik.admin.laporan_kartu_gudang.index', ['bln' => $bln, 'materials' => $getMaterial, 'kartuGudangs' => $getJoinGudang]);
    }
}

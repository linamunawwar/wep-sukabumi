<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogWaste;
use App\Models\LogWasteDetail;
use App\Models\LogWastePengajuan;
use App\Models\LogPengajuanMaterial;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;
use App\Pegawai;

class WasteMaterialController extends Controller
{
    public function index()
    {
        $wastes = LogWaste::where('soft_delete', 0)->get();
        return view('logistik.admin.waste.index', ['wastes' => $wastes]);
    }

    public function beforePostWaste()
    {
    	$jenis_kerjas = Logjenis::where('soft_delete',0)->get();
    	$lokasis = LogLokasi::where('soft_delete',0)->get();
    	$pelaksanas = Pegawai::where('soft_delete',0)
                                ->where('is_active',1)
                                ->where('posisi_id',46)
                                ->orwhere('posisi_id',45)
                                ->where('soft_delete',0)
                                ->where('is_active',1)
                                ->get();
        return view('logistik.admin.waste.create',['jenis_kerjas'=>$jenis_kerjas,'lokasis'=>$lokasis,'pelaksanas'=>$pelaksanas]);
    }

    public function cekData()
    {
    	$bulan = \Input::get('bulan');
    	$tahun = \Input::get('tahun');
    	$periode = $tahun.$bulan;
    	$lokasi_id = \Input::get('lokasi');
    	$jenis_id = \Input::get('jenis_kerja');    

        $details = LogDetailPengajuanMaterial::whereHas('detailPengajuan',function ($q) use ($bulan,$jenis_id,$lokasi_id){
                                                                  $q->whereMonth('tanggal','=',$bulan);
                                                                  $q->where('jenis_pekerjaan_id',$jenis_id);
                                                                  $q->where('lokasi_kerja_id',$lokasi_id);
                                                                  $q->where('soft_delete',0);
                                                                })
                                                                ->get();
        $materials = [];
        $count = count($materials);
        foreach ($details as $key => $value) {
            if(array_search($value->material_id, array_column($materials,'material_id')) !== false){
                $index = array_search($value->material_id, array_column($materials,'material_id'));
                $materials[$index]['pemakaian'] = (int)$materials[$index]['pemakaian'] + (int)$value->pemyerahan_jumlah;
            }else{
                $materials[$count]['material_id'] = $value->material_id;
                $materials[$count]['material'] = $value->detailPengajuanMaterial->nama;
                $materials[$count]['sat'] = $value->detailPengajuanMaterial->satuan;
                $materials[$count]['pemakaian'] = $value->pemyerahan_jumlah;
                $count++;
            }
           
        }
    	return json_encode($materials);
    }

    public function postWaste()
    {
        date_default_timezone_set("Asia/Jakarta");
    	$jml = \Input::get('jumlah_data');

        $jenis_pekerjaan_id = \Input::get('jenis_kerja_id');
        $lokasi_id = \Input::get('lokasi_id');
        $bulan = \Input::get('bulan');
        $tahun = \Input::get('tahun');
        $periode = $tahun.$bulan;

        $material = \Input::get('material');
        $satuan = \Input::get('satuan');
        $vol_app = \Input::get('vol_app');
        $progress_persen = \Input::get('progress_persen');
        $vol_progress = \Input::get('vol_progress');
        $pemakaian = \Input::get('pemakaian');
        $deviasi_vol = \Input::get('deviasi_vol');
        $deviasi = \Input::get('deviasi');
    	$rencana_waste = \Input::get('rencana_waste');
        $realisasi = \Input::get('realisasi');

        
    	$logWaste = new LogWaste;
        $logWaste->material_id = $material_id;
        $logWaste->periode = $periode;
        $logWaste->jenis_pekerjaan_id = $jenis_pekerjaan_id;
        $logWaste->volume_pekerjaan = $volume_pekerjaan;
        $logWaste->user_id = \Auth::user()->id;
        
        if($logWaste->save()){
            $logWasteID = $logWaste->id;
        	for($i=0;$i< $jml;$i++){
                $data = new LogWasteDetail;

            	$data->waste_id= $logWasteID;
                $data->material_id= $material[$i];
                $data->satuan= $satuan[$i];
                $data->vol_app= $vol_app[$i];
                $data->progress_persen= $progress_persen[$i];
                $data->vol_progress= $vol_progress[$i];
                $data->pemakaian= $pemakaian[$i];
                $data->deviasi_vol= $deviasi_vol[$i];
                $data->deviasi= $deviasi[$i];
            	$data->rencana_waste= $rencana_waste[$i];
            	$data->realisasi= $realisasi[$i];
            	$data->soft_delete= 0;
                $data->user_id = \Auth::user()->id;
            	
            	if($data->save()){
                    $simpan = 1;
                }else{
                    $simpan = 0;
                    die();
                }
            }
        }
        return redirect('Logistik/admin/waste');
    }

    public function getWasteById($id)
    {
        $waste = LogWaste::where('id', $id)->where('soft_delete',0)->first();
        
        $datas = LogWasteDetail::where(['waste_id' => $id, 'soft_delete' => 0])->get();
        
        return view('logistik.admin.waste.edit', ['waste' => $waste, 'datas' => $datas]);
    }

    public function updateWaste($id)
    {

        $toUpdatePenerimaan['updated_at'] = date('Y-m-d');
        $updatedPenerimaan = LogPenerimaanMaterial::where('id', $id)->update($toUpdatePenerimaan);
        $kode_permintaan = \Input::get('kode_permintaan');
        $kode_penerimaan = \Input::get('kode_penerimaan');
        $supplier = \Input::get('supplier');
        $penerima = \Input::get('penerima');
        $jmlPermintaan = \Input::get('jumlah_data');
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
        $tanggal_terima = \Input::get('tanggal_terima');
        $vol_lalu = \Input::get('vol_lalu');
        $vol_saat_ini = \Input::get('vol_saat_ini');
        $vol_jumlah = \Input::get('vol_jumlah');
        $vol_sisa = \Input::get('vol_sisa');
        $satuan = \Input::get('satuan');
        $harga_satuan = \Input::get('harga_satuan');
        $status = \Input::get('status');
        $keterangan = \Input::get('keterangan');
        $kode_permintaan = \Input::get('kode_permintaan');
        $find_permintaan = LogPermintaanMaterial::where('kode_permintaan',$kode_permintaan)->where('soft_delete',0)->first();
        //delete data lama
        $delete = LogDetailPenerimaanMaterial::where('penerimaan_id',$id)->where('soft_delete',0)->delete();
        if ($delete) {
            $jmlPenerimaann = \Input::get('jumlah_data');
            for ($i = 0; $i < $jmlPenerimaann; $i++) {
                //if(($vol_saat_ini[$i] != '') || ($vol_saat_ini[$i] != 0)){
                    $addDetail = new LogDetailPenerimaanMaterial;
                    $addDetail->penerimaan_id = $id;
                    $addDetail->material_id = $materialId[$i];
                    $addDetail->tanggal_terima = $tanggal_terima[$i];
                    $addDetail->vol_lalu = $vol_lalu[$i];
                    if($vol_saat_ini[$i] == ''){
                        $vol_saat_ini[$i] =0;
                    }
                    $addDetail->vol_saat_ini = $vol_saat_ini[$i];
                    $addDetail->vol_jumlah = $vol_jumlah[$i];
                    $addDetail->vol_sisa = $vol_sisa[$i];
                    $addDetail->sisa_stok = $vol_jumlah[$i];
                    $addDetail->harga = $harga_satuan[$i];
                    $addDetail->satuan = $satuan[$i];
                    $addDetail->user_id = \Auth::user()->id;
                    $addDetail->soft_delete = 0;
                    $addDetail->created_at = date('Y-m-d');

                    if ($addDetail->save()) {
                        $saveStatus = 1;
                    } else {
                        $saveStatus = 0;
                        die();
                    }
                //}
                
                if($status && array_key_exists($i, $status)){
                    if($status[$i] == 1){
                        $update = LogDetailPermintaanMaterial::where('material_id',$materialId[$i])->where('permintaan_id',$find_permintaan->id)->update(['is_sesuai'=> 1,'is_sesuai_at'=>date('Y-m-d H:i:s')]);
                    }else{
                        $update = LogDetailPermintaanMaterial::where('material_id',$materialId[$i])->where('permintaan_id',$find_permintaan->id)->update(['is_sesuai'=> 0,'is_sesuai_at'=>'0000-00-00 00:00:00']);
                    }
                }else{
                    $update = LogDetailPermintaanMaterial::where('material_id',$materialId[$i])->where('permintaan_id',$find_permintaan->id)->update(['is_sesuai'=> 0,'is_sesuai_at'=>date('0000-00-00 00:00:00')]);
                }
            }

            //cek apakah ini edit atau koreksi
            $cekKoreksi = \Input::get('koreksi');
            if (isset($cekKoreksi)) {
                $dt['is_admin'] = 1;
                $dt['is_admin_at'] = date('Y-m-d H:i:s');
                $dt['is_splem'] = null;
                $koreksi = LogPenerimaanMaterial::where('kode_penerimaan',$kode_penerimaan)->where('soft_delete',0)->update($dt);
            }
            //cek apakah semua barang permintaan sudah sesuai
            $all_detail_permintaan = LogDetailPermintaanMaterial::where('permintaan_id',$find_permintaan->id)->where('soft_delete',0)->get();
            $semua_sesuai = 0;
            foreach ($all_detail_permintaan as $key => $dt) {
                if(($dt->is_sesuai == null) || ($dt->is_sesuai == 0) || ($dt->is_sesuai == '')){
                    $semua_sesuai = 0;
                    break;
                }else{
                    $semua_sesuai = 1;
                }
            }

            $update_penerimaan = LogPenerimaanMaterial::where('kode_penerimaan',$kode_penerimaan)->where('soft_delete',0)->update(['supplier'=>$supplier,'penerima'=>$penerima]);

            if($semua_sesuai == 1){
                $update_permintaan = LogPermintaanMaterial::where('id',$find_permintaan->id)->where('soft_delete',0)->update(['is_sesuai'=> 1,'is_sesuai_at'=>date('Y-m-d H:i:s')]);
            }else{
                $update_permintaan = LogPermintaanMaterial::where('id',$find_permintaan->id)->where('soft_delete',0)->update(['is_sesuai'=> 0,'is_sesuai_at'=>'0000-00-00 00:00:00']);
            }
        }
        return redirect('Logistik/admin/penerimaan');
    }

    public function deleteWaste()
    {
    	$id = \Input::get('id_waste');
    	$find = LogWaste::find($id);
    	$find_detail = LogWasteDetail::where('waste_id',$id)->where('soft_delete',0)->get();
    	if($find){
    		$update_waste = LogWaste::where('id',$id)->update(['soft_delete'=>1]);
    		$update_detail_waste = LogWasteDetail::where('waste_id',$id)->update(['soft_delete'=>1]);
    	}

    	return redirect('Logistik/admin/waste');
    }

}

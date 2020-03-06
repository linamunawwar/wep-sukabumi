<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogWaste;
use App\Models\LogWasteDetail;
use App\Models\LogWastePengajuan;
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
    	$materials = LogMaterial::where('soft_delete',0)->get();
    	$jenis_kerjas = Logjenis::where('soft_delete',0)->get();
    	$lokasis = LogLokasi::where('soft_delete',0)->get();
    	$pelaksanas = Pegawai::where('soft_delete',0)
                                ->where('is_active',1)
                                ->where('posisi_id',46)
                                ->orwhere('posisi_id',45)
                                ->where('soft_delete',0)
                                ->where('is_active',1)
                                ->get();
        return view('logistik.admin.waste.create',['materials'=>$materials,'jenis_kerjas'=>$jenis_kerjas,'lokasis'=>$lokasis,'pelaksanas'=>$pelaksanas]);
    }

    public function cekData()
    {
    	$bulan = \Input::get('bulan');
    	$tahun = \Input::get('tahun');
    	$periode = $tahun.$bulan;
    	$material_id = \Input::get('material');
    	$jenis_id = \Input::get('jenis_kerja');
    	$waste = LogWaste::where('periode',$periode)->where('material_id',$material_id)->where('jenis_pekerjaan_id',$jenis_id)->first();
    	if($waste){
    		$datas = LogWasteDetail::where('waste_id',$waste->id)->where('soft_delete',0)->get();
    	}else{
    		$datas = null;
    	}
    	if($datas){
	    	foreach ($datas as $key => $data) {
	    		$data->pelaksana_nama = $data->pelaksanaPegawai->nama;
	    		$data->lokasi = $data->wasteLokasi->nama;
	    	}
	    }	
    	return json_encode($datas);
    }

    public function postWaste()
    {
        date_default_timezone_set("Asia/Jakarta");
    	$jml = \Input::get('jumlah_data');

        $material_id = \Input::get('material_id');
        $jenis_pekerjaan_id = \Input::get('jenis_kerja_id');
        $volume_pekerjaan = \Input::get('volume_pekerjaan');
        $bulan = \Input::get('bulan');
        $tahun = \Input::get('tahun');
        $periode = $tahun.$bulan;
        $lokasi = \Input::get('lokasi');
        $pelaksana = \Input::get('pelaksana');
        $progress_persen = \Input::get('progress_persen');
        $progress_vol = \Input::get('progress_vol');
        $vol_bahan = \Input::get('vol_bahan');
        $real_pemakaian = \Input::get('real_pemakaian');
        $waste_vol = \Input::get('waste_vol');
        $waste_rencana = \Input::get('waste_rencana');
    	$waste_real = \Input::get('waste_real');
        $waste_deviasi = \Input::get('waste_deviasi');
        $keterangan = \Input::get('keterangan');

        $find = LogWaste::where('periode',$periode)->where('material_id',$material_id)->where('jenis_pekerjaan_id',$jenis_pekerjaan_id)->first();
        if(!$find){
        	$logWaste = new LogWaste;
	        $logWaste->material_id = $material_id;
	        $logWaste->periode = $periode;
	        $logWaste->jenis_pekerjaan_id = $jenis_pekerjaan_id;
	        $logWaste->volume_pekerjaan = $volume_pekerjaan;
	        $logWaste->user_id = \Auth::user()->id;
	        $logWaste->save();
	        $logWasteID = $logWaste->id;
        }else{
        	$logWasteID = $find->id;
        }

        $find_detail = LogWasteDetail::where('waste_id',$logWasteID)->where('soft_delete',0)->get();
        if($find_detail){
        	$delete = LogWasteDetail::where('waste_id',$logWasteID)->update(['soft_delete'=>1]);
        }
    	for($i=0;$i< $jml;$i++){
            $data = new LogWasteDetail;

        	$data->waste_id= $logWasteID;
            $data->lokasi_kerja_id= $lokasi[$i];
            $data->pelaksana= $pelaksana[$i];
            $data->progress_persen= $progress_persen[$i];
            $data->progress_vol= $progress_vol[$i];
            $data->vol_bahan= $vol_bahan[$i];
            $data->real_pemakaian= $real_pemakaian[$i];
            $data->waste_vol= $waste_vol[$i];
            $data->waste_rencana= $waste_rencana[$i];
        	$data->waste_real= $waste_real[$i];
        	$data->waste_deviasi= $waste_deviasi[$i];
        	$data->keterangan= $keterangan[$i];;
        	$data->soft_delete= 0;
            $data->user_id = \Auth::user()->id;
        	
        	if($data->save()){
                $simpan = 1;
            }else{
                $simpan = 0;
                die();
            }
        }
        return redirect('Logistik/admin/waste');
    }

    public function deleteWaste()
    {
    	$id = \Input::get('id_waste');
    	$find = LogWaste::find($id);
    	$find_detail = LogWasteDetail::where('waste_id',$id)->where('soft_delete',0)->get();
    	if($find){
    		$update_waste = LogWaste::where('id',$id)->update(['soft_delete'=>1]);
    		$update_detail_waste = LogWasteDetail::where('waste_id',$id)->update(['soft_delete'=>1]);
    		$update_waste_pengajuan = LogWastePengajuan::where('waste_id',$id)->update(['soft_delete'=>1]);
    	}

    	return redirect('Logistik/admin/waste');
    }

    public function getAjukan($id)
    {
    	$find = LogWaste::find($id);
    	$ada = 0;
    	if($find){
    		$cek = LogWastePengajuan::where('waste_id',$id)->where('soft_delete',0)->get();
    		if(count($cek) == 0){
    			$pengajuan = new LogWastePengajuan;
    			$pengajuan->waste_id = $id;
    			$pengajuan->is_splem = 0;
    			$pengajuan->is_sem = 0;
    			$pengajuan->is_scarm = 0;
    			$pengajuan->is_pm = 0;
    			$pengajuan->user_id = \Auth::user()->id;
    			if($pengajuan->save()){
    				$ada = 1;
    			}
    		}
    	}
    	return $ada;
    }

    public function indexPengajuan()
    {
        $wastes = LogWastePengajuan::where('soft_delete', 0)->get();
        return view('logistik.admin.waste.pengajuan.index', ['wastes' => $wastes]);
    }

    public function deleteWastePengajuan()
    {
    	$id = \Input::get('id_waste');
    	$find = LogWastePengajuan::find($id);
    	if($find){
    		$update_waste = LogWastePengajuan::where('id',$id)->update(['soft_delete'=>1]);
    	}

    	return redirect('Logistik/admin/waste/pengajuan');
    }
}

<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPermintaanMaterial;
use App\Models\LogDetailPermintaanMaterial;

use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaans = LogPenerimaanMaterial::where('soft_delete', 0)->get();
        foreach ($penerimaans as $penerimaan) {
            if ($penerimaan->is_som != 1) {
                if ($penerimaan->is_som == null) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Proses Pengecekan";
                } elseif ($penerimaan->is_som == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SOM";
                }
            } elseif ($penerimaan->is_slem != 1) {
                if ($penerimaan->is_slem == null) {
                    $penerimaan->color = "#74B9FF";
                    $penerimaan->text = "Accepted By SOM";
                } elseif ($penerimaan->is_slem == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SPLEM";
                }
            } elseif ($penerimaan->is_scarm != 1) {
                if ($penerimaan->is_scarm == null) {
                    $penerimaan->color = "";
                    $penerimaan->text = "Acepted By SPLEM";
                } elseif ($penerimaan->is_scarm == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SCARM";
                }
            } elseif ($penerimaan->is_pm != 1) {
                if ($penerimaan->is_pm == null) {
                    $penerimaan->color = "#74B9FF";
                    $penerimaan->text = "Accepted By SPLEM";
                } elseif ($penerimaan->is_pm == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By PM";
                }
            } elseif ($penerimaan->is_pm == 1) {
                $penerimaan->color = "#74B9FF";
                $penerimaan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.admin.penerimaan.index', ['penerimaans' => $penerimaans]);
    }

    public function beforePostPenerimaan()
    {

        $materials = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.admin.penerimaan.create', ['materials' => $materials]);
    }

    public function cekData()
    {
    	$kode_permintaan = \Input::get('kode_permintaan');
    	$penerimaans = LogPenerimaanMaterial::where('kode_permintaan',$kode_permintaan)->where('soft_delete',0)->get();

    	$permintaan = LogPermintaanMaterial::where('kode_permintaan',$kode_permintaan)->where('soft_delete',0)->first();

    	if($permintaan){
    		$datas = LogDetailPermintaanMaterial::where('permintaan_id',$permintaan->id)->where('soft_delete',0)->get();
    	}else{
    		$datas = null;
    	}
    	if($datas){
	    	foreach ($datas as $key => $data) {
	    		$data->material_nama = $data->material->nama;
	    		$jumlah_material = 0;
	    		if($penerimaans){
		    		foreach ($penerimaans as $key => $penerimaan) {
		    			$material = LogDetailPenerimaanMaterial::where('penerimaan_id',$penerimaan->id)->where('material_id',$data->material_id)->where('soft_delete',0)->first();
		    			if($material){
		    				$jumlah_material = $jumlah_material + $material->vol_saat_ini;
		    			}
		    		}
		    	}
		    	$data->jumlah_lalu = $jumlah_material;
		    	if($jumlah_material == $data->volume){
		    		$data->status = 1;
		    	}else{
		    		$data->status = 0;
		    	}
	    	}
	    }	
    	return json_encode($datas);
    }

    public function postPenerimaan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
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
        $all = LogPenerimaanMaterial::where('kode_permintaan',$kode_permintaan)->where('soft_delete',0)->get();
        if($all){
        	$i = 01;
        	$kode = $kode_permintaan.'-'.$i;
        	foreach ($all as $key => $value) {
        		if($kode == $value->kode_penerimaan){
        			$i = $i +1;
        			$kode = $kode_permintaan.'-'.$i;
        		}else{
        			break;
        		}
        	}
        }else{
        	$kode = $kode_permintaan.'-01';
        }
        $addPenerimaan = new LogPenerimaanMaterial;
        $addPenerimaan->kode_permintaan = $kode_permintaan;
        $addPenerimaan->kode_penerimaan = $kode;
        $addPenerimaan->tanggal = date('Y-m-d');
        $addPenerimaan->user_id = \Auth::user()->id;
        $addPenerimaan->soft_delete = 0;
        $addPenerimaan->created_at = date('Y-m-d');

        if ($addPenerimaan->save()) {
            $penerimaanId = $addPenerimaan->id;
            $jmlPenerimaann = \Input::get('jumlah_data');
            for ($i = 0; $i < $jmlPenerimaann; $i++) {
            	//if(($vol_saat_ini[$i] != '') || ($vol_saat_ini[$i] != 0)){
	                $addDetail = new LogDetailPenerimaanMaterial;
	                $addDetail->penerimaan_id = $penerimaanId;
	                $addDetail->material_id = $materialId[$i];
	                $addDetail->vol_lalu = $vol_lalu[$i];
	                if($vol_saat_ini[$i] == ''){
	                	$vol_saat_ini[$i] =0;
	                }
	                $addDetail->vol_saat_ini = $vol_saat_ini[$i];
	                $addDetail->vol_jumlah = $vol_jumlah[$i];
	                $addDetail->vol_sisa = $vol_sisa[$i];
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
		            }
		        }
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

            if($semua_sesuai == 1){
            	$update_permintaan = LogPermintaanMaterial::where('id',$find_permintaan->id)->where('soft_delete',0)->update(['is_sesuai'=> 1,'is_sesuai_at'=>date('Y-m-d H:i:s')]);
            }

            return redirect('Logistik/admin/penerimaan');
        }
    }

    public function getDetailByPenerimaanId($id)
    {
        $details = LogDetailPenerimaanMaterial::where(['penerimaan_id' => $id, 'soft_delete' => 0])->get();

        return view('logistik.admin.penerimaan.detail', ['details' => $details]);
    }

    public function getPenerimaanById($id)
    {
        $penerimaan = LogPenerimaanMaterial::where('id', $id)->where('soft_delete',0)->first();
        
        $details = LogDetailPenerimaanMaterial::where(['penerimaan_id' => $id, 'soft_delete' => 0])->get();
        foreach ($details as $key => $detail) {
        	$dt_permintaan = LogDetailPermintaanMaterial::where('material_id',$detail->material_id)->where('permintaan_id',$penerimaan->permintaan->id)->where('soft_delete',0)->first();
        	$detail->status = $dt_permintaan->is_sesuai;
        }
        
        return view('logistik.admin.penerimaan.edit', ['penerimaan' => $penerimaan, 'details' => $details]);
    }

    public function updatePenerimaan($id)
    {

        $toUpdatePenerimaan['updated_at'] = date('Y-m-d');
        $updatedPenerimaan = LogPenerimaanMaterial::where('id', $id)->update($toUpdatePenerimaan);
        $kode_permintaan = \Input::get('kode_permintaan');
        $kode_penerimaan = \Input::get('kode_penerimaan');
        $jmlPermintaan = \Input::get('jumlah_data');
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
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
	                $addDetail->vol_lalu = $vol_lalu[$i];
	                if($vol_saat_ini[$i] == ''){
	                	$vol_saat_ini[$i] =0;
	                }
	                $addDetail->vol_saat_ini = $vol_saat_ini[$i];
	                $addDetail->vol_jumlah = $vol_jumlah[$i];
	                $addDetail->vol_sisa = $vol_sisa[$i];
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

            if($semua_sesuai == 1){
            	$update_permintaan = LogPermintaanMaterial::where('id',$find_permintaan->id)->where('soft_delete',0)->update(['is_sesuai'=> 1,'is_sesuai_at'=>date('Y-m-d H:i:s')]);
            }else{
            	$update_permintaan = LogPermintaanMaterial::where('id',$find_permintaan->id)->where('soft_delete',0)->update(['is_sesuai'=> 0,'is_sesuai_at'=>'0000-00-00 00:00:00']);
            }
        }
        return redirect('Logistik/admin/penerimaan');
    }

    public function deletePenerimaan()
    {
        $dataDelete = \Input::all();
        $deletePenerimaan = LogPenerimaanMaterial::where('id', $dataDelete['id_penerimaan'])->update(['soft_delete' => 1]);

        if ($deletePenerimaan) {
            $deleteAllDetailPenerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id', $dataDelete['id_penerimaan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/admin/penerimaan');
        }
    }

    public function getUnduhPenerimaan($id)
    {
        $find = LogPenerimaanMaterial::find($id);
        $dt_penerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id',$id)->where('soft_delete',0)->get();
        if($find && $dt_penerimaan){
        	$splem = Pegawai::where('posisi_id',7)->where('soft_delete',0)->first();
        	$pm = Pegawai::where('posisi_id',1)->where('soft_delete',0)->first();
	        
	        $excel = \Excel::create("Form Log-01 Penerimaan Bahan ".$find->kode_penerimaan, function($excel) use ($find,$dt_penerimaan,$splem,$pm) {

	                    $excel->sheet('New sheet', function($sheet) use ($find,$dt_penerimaan,$splem,$pm) {

	                        $sheet->loadView('logistik.admin.penerimaan.unduh',['penerimaan' => $find,'datas'=>$dt_penerimaan,'splem'=>$splem,'pm'=>$pm]);
	                        $objDrawing = new PHPExcel_Worksheet_Drawing;
	                        $objDrawing->setPath(public_path('img/Waskita.png'));
	                        $objDrawing->setCoordinates('C1');
	                        $objDrawing->setWorksheet($sheet);
	                        $objDrawing->setResizeProportional(false);
	                        // set width later
	                        $objDrawing->setWidth(40);
	                        $objDrawing->setHeight(35);
	                        $sheet->getStyle('C1')->getAlignment()->setIndent(1);

	                        $sheet->getStyle('A11:N27')->getAlignment()->setWrapText(true);
	                        $sheet->getStyle('A2:O36')->getFont()->setName('Tahoma');
	                        $sheet->getStyle('A13:N15')->getAlignment()->applyFromArray(
	                            array('horizontal' => 'center')
	                        );
	                        $sheet->cells('A9:M11', function ($cells) {
	                            $cells->setValignment('center');
	                            $cells->setFontFamily('Tahoma');
	                        });
	                        
	                        $sheet->cell('D9:E11', function($cell){
	                            $cell->setValignment('center');
	                        });
	                        $sheet->cell('D8:E8', function($cell){
	                            $cell->setBorder('','','thin','');
	                        });
	                        $sheet->cell('C4', function($cell){
	                            $cell->setBorder('thin','thin','thin','thin');
	                        });
	                        $sheet->cell('C6', function($cell){
	                            $cell->setalignment('center');
	                            $cell->setValignment('center');
	                            $cell->setBorder('thin','thin','thin','thin');
	                        });
	                        // $sheet->cell('B14:E14', function($cell){
	                        //     $cell->setBorder('','','','thin');
	                        // });
	                    });
	                });
	                 $styleArray = array(
					   'font'  => array(
					        'name'  => 'Tahoma'
					    ));      
					 $excel->getDefaultStyle()
					    ->applyFromArray($styleArray);
	                return $excel->export('xls');
        }     
    }
}

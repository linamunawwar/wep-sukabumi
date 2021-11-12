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
use App\Models\LogPengajuanMaterial;

use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaans = LogPenerimaanMaterial::where('soft_delete', 0)->get();
        foreach ($penerimaans as $penerimaan) {
            if($penerimaan->is_admin == 1){
                $penerimaan->color = "#D63031";
                $penerimaan->text = "Edited By Admin";
            }
            if ($penerimaan->is_splem == 1) {
                $penerimaan->color = "#74B9FF";
                $penerimaan->text = "Accepted By SPLEM";
            }
            elseif (($penerimaan->is_splem != 1) && ($penerimaan->is_admin != 1)) {
                if ($penerimaan->is_splem == null) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Proses Pengecekan";
                } elseif ($penerimaan->is_splem == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SPLEM";
                }
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

    	if($permintaan && ($permintaan->is_scarm == 1)){
    		$datas = LogDetailPermintaanMaterial::where('permintaan_id',$permintaan->id)->where('soft_delete',0)->get();
    	}elseif($permintaan && $permintaan->is_scarm != 1){
            $datas = 0;
        }else{
    		$datas = null;
    	}
        
    	if($datas){
	    	foreach ($datas as $key => $data) {
	    		$data->material_nama = $data->detailPermintaanMaterial->nama;
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
        $tanggal_terima = \Input::get('tanggal_terima');
        $supplier = \Input::get('supplier');
        $penerima = \Input::get('penerima');
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
        $addPenerimaan->supplier = $supplier;
        $addPenerimaan->penerima = $penerima;
        $addPenerimaan->is_new = 1;
        $addPenerimaan->user_id = $find_permintaan->user_id;
        if(\Auth::user()->role_id == 6){
            $addPenerimaan->is_admin = 1;
            $addPenerimaan->is_admin_at = date('Y-m-d H:i:s');
        }
        $addPenerimaan->soft_delete = 0;
        $addPenerimaan->created_at = date('Y-m-d');

        if ($addPenerimaan->save()) {
            $penerimaanId = $addPenerimaan->id;
            $jmlPenerimaann = \Input::get('jumlah_data');
            for ($i = 0; $i < $jmlPenerimaann; $i++) {
            	//if(($vol_saat_ini[$i] != '') || ($vol_saat_ini[$i] != 0)){
	                $addDetail = new LogDetailPenerimaanMaterial;
                    $addDetail->penerimaan_id = $penerimaanId;
	                $addDetail->tanggal_terima = $tanggal_terima[$i];
	                $addDetail->material_id = $materialId[$i];
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
        $penerimaan = LogPenerimaanMaterial::find($id);
        $permintaan = LogPermintaanMaterial::where('kode_permintaan',$penerimaan->kode_permintaan)->first();
        if(\Auth::user()->id == $permintaan->user_id){
            $toUpdatePenerimaan['is_new'] = 0;

            $updatePenerimaan = LogPenerimaanMaterial::where('id',$id)->update($toUpdatePenerimaan);
        }
        session(['proses'=>1]);
        return view('logistik.admin.penerimaan.detail', ['details' => $details]);
    }

    public function getDetailNotifByPenerimaanId($id)
    {
        $toUpdateNotificationPenerimaan['updated_at'] = date('Y-m-d');
        $toUpdateNotificationPenerimaan['is_notif'] = -1;
        $updatedPermintaan = LogPenerimaanMaterial::where('id', $id)->update($toUpdateNotificationPenerimaan);

        $details = LogDetailPenerimaanMaterial::where(['penerimaan_id' => $id, 'soft_delete' => 0])->get();

        return view('logistik.admin.penerimaan.detail', ['details' => $details]);
    }

    public function getNote($id)
    {
        $penerimaan = LogPenerimaanMaterial::where('id', $id)->where('soft_delete',0)->first();
        $note = '';
        if($penerimaan){
            if($penerimaan->is_splem === '0'){
                $note = $penerimaan->note_splem ;
            }
        }
        
        return $note;
      
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

    public function deletePenerimaan()
    {
        $dataDelete = \Input::all();
        // $deletePenerimaan = LogPenerimaanMaterial::where('id', $dataDelete['id_penerimaan'])->update(['soft_delete' => 1]);
        $deletePenerimaan = LogPenerimaanMaterial::where('id', $dataDelete['id_penerimaan'])->delete();

        if ($deletePenerimaan) {
            $deleteAllDetailPenerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id', $dataDelete['id_penerimaan'])->delete();
            // $deleteAllDetailPenerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id', $dataDelete['id_penerimaan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/admin/penerimaan');
        }
    }

    public function getUnduhPenerimaan($id)
    {
        $find = LogPenerimaanMaterial::find($id);
        $dt_penerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id',$id)->where('soft_delete',0)->get();
        if($find && $dt_penerimaan){
            $splem = getManager('SL','Models\\LogPenerimaanMaterial',$find->id);
            $pm = getPM('Models\\LogPenerimaanMaterial',$find->id);
	        
	        $excel = \Excel::create("Form Log-01 Penerimaan Bahan ".$find->kode_penerimaan, function($excel) use ($find,$dt_penerimaan,$splem,$pm) {

	                    $excel->sheet('New sheet', function($sheet) use ($find,$dt_penerimaan,$splem,$pm) {

	                        $sheet->loadView('logistik.admin.penerimaan.unduh',['penerimaan' => $find,'datas'=>$dt_penerimaan,'splem'=>$splem,'pm'=>$pm]);
	                        $objDrawing = new PHPExcel_Worksheet_Drawing;
	                        $objDrawing->setPath(public_path('img/Waskita.png'));
	                        $objDrawing->setCoordinates('C4');
	                        $objDrawing->setWorksheet($sheet);
	                        $objDrawing->setResizeProportional(false);
	                        // set width later
	                        $objDrawing->setWidth(40);
	                        $objDrawing->setHeight(35);
	                        $sheet->getStyle('C4')->getAlignment()->setIndent(1);

                            //set image ttd pm
                            // init drawing
                            if(file_exists("upload/pegawai/$pm->nip/$pm->ttd")){
                                $drawing1 = new PHPExcel_Worksheet_Drawing();
                                // Set image
                                $drawing1->setPath("upload/pegawai/$pm->nip/$pm->ttd");
                                $drawing1->setWorksheet($sheet);
                                $drawing1->setCoordinates('D40');
                                $drawing1->setResizeProportional(false);
                                $drawing1->setWidth(150);
                                $drawing1->setHeight(100);
                            }

                            //set image ttd splem
                            // init drawing
                            if(file_exists("upload/pegawai/$splem->nip/$splem->ttd")){
                                $drawing2 = new PHPExcel_Worksheet_Drawing();
                                // Set image
                                $drawing2->setPath("upload/pegawai/$splem->nip/$splem->ttd");
                                $drawing2->setWorksheet($sheet);
                                $drawing2->setCoordinates('F40');
                                $drawing2->setResizeProportional(false);
                                $drawing2->setWidth(150);
                                $drawing2->setHeight(100);
                            }

                            //set image ttd penerima
                            // init drawing
                            if(file_exists("upload/pegawai/Auth::user()->pegawai_id/Auth::user()->pegawai->ttd")){
                                $drawing3 = new PHPExcel_Worksheet_Drawing();
                                // Set image
                                $drawing3->setPath("upload/pegawai/Auth::user()->pegawai_id/Auth::user()->pegawai->ttd");
                                $drawing3->setWorksheet($sheet);
                                $drawing3->setCoordinates('J40');
                                $drawing3->setResizeProportional(false);
                                $drawing3->setWidth(150);
                                $drawing3->setHeight(100);
                            }


	                        $sheet->getStyle('A9:M50')->getAlignment()->setWrapText(true);
	                        $sheet->getStyle('A2:M50')->getFont()->setName('Tahoma');
	                        $sheet->getStyle('A13:L15')->getAlignment()->applyFromArray(
	                            array('horizontal' => 'center')
	                        );
	                        $sheet->cells('A9:K11', function ($cells) {
	                            $cells->setValignment('center');
	                            $cells->setFontFamily('Tahoma');
	                        });
                            $sheet->setHeight(array(
                                10     =>  50,
                                31     =>  20,
                                32     =>  25,
                                33     =>  25,
                                34     =>  25,
                                35     =>  25,
                                36     =>  25,
                                37     =>  25,
                                38     =>  30,
                                41     =>  90
                            ));
	                        
                            $sheet->setWidth(array(
                                'A'     =>  1,
                                'B'     =>  1,
                                'C'     =>  6,
                                'D'     =>  24,
                                'E'     =>  5,
                                'F'     =>  10,
                                'G'     =>  7,
                                'H'     =>  7,
                                'I'     =>  7,
                                'J'     =>  8,
                                'K'     =>  8,
                                'L'     => 10
                            ));

	                        $sheet->cell('C12:L28', function($cell){
	                            $cell->setValignment('center');
	                        });
                            $sheet->cell('G32:I32', function($cell){
                                $cell->setBorder('','','thin','');
                            });
                            $sheet->cell('G34:I34', function($cell){
                                $cell->setBorder('','','thin','');
                            });
                            $sheet->cell('G36:I36', function($cell){
                                $cell->setBorder('','','thin','');
                            });
                            $sheet->cell('C38:L38', function($cell){
	                            $cell->setBorder('thin','','','');
	                        });
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

    public function getAllNotif()
    {
        $penerimaans = LogPengajuanMaterial::where('soft_delete', 0)->where('status_penyerahan',1)->where('user_id',\Auth::user()->id)->get();
        foreach ($penerimaans as $penerimaan) {
            if($penerimaan->is_admin == 1){
                $penerimaan->color = "#D63031";
                $penerimaan->text = "Edited By Admin";
            }elseif ($penerimaan->is_splem != 1) {
                if ($penerimaan->is_splem == null) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Proses Pengecekan";
                } elseif ($penerimaan->is_splem == 0) {
                    $penerimaan->color = "#D63031";
                    $penerimaan->text = "Rejected By SPLEM";
                }
            } elseif ($penerimaan->is_splem == 1) {
                $penerimaan->color = "#74B9FF";
                $penerimaan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.admin.penerimaan.notif', ['penerimaans' => $penerimaans]);
    }

}

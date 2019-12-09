<?php

namespace App\Http\Controllers\Logistik\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Models\LogWaste;
use App\Models\LogWasteDetail;
use App\Models\LogWastePengajuan;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class WasteMaterialController extends Controller
{
    public function index()
    {
        $wastes = LogWastePengajuan::where('soft_delete', 0)->get();
        return view('logistik.manager.waste.index', ['wastes' => $wastes]);
    }

    public function getApprove($id)
    {
        $find = LogWastePengajuan::where('id',$id)->where('soft_delete', 0)->first();
        if($find){
        	$waste = LogWaste::where('id',$find->waste_id)->where('soft_delete',0)->first();
        	if($waste){
        		$details = LogWasteDetail::where('waste_id',$find->waste_id)->where('soft_delete',0)->get();
        	}
        }
        return view('logistik.manager.waste.approve', ['waste' => $waste,'details'=>$details]);
    }

    public function postApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
        $find = LogWastePengajuan::where('id',$id)->where('soft_delete', 0)->first();
        if($find){
        	//splem
        	if(\Auth::user()->pegawai->posisi_id == 7){
        		$dt['is_splem'] = 1;
        		$dt['is_splem_at'] = date('Y-m-d H:i:s');
        		$dt['note_splem'] = \Input::get('note');;
        		$update = LogWastePengajuan::where('id',$id)->update($dt);
        	}elseif(\Auth::user()->pegawai->posisi_id == 4){ //sem
        		$dt['is_sem'] = 1;
        		$dt['is_sem_at'] = date('Y-m-d H:i:s');
        		$dt['note_sem'] = \Input::get('note');;
        		$update = LogWastePengajuan::where('id',$id)->update($dt);
        	}elseif(\Auth::user()->pegawai->posisi_id == 5){//scarm
        		$dt['is_scarm'] = 1;
        		$dt['is_scarm_at'] = date('Y-m-d H:i:s');
        		$dt['note_scarm'] = \Input::get('note');;
        		$update = LogWastePengajuan::where('id',$id)->update($dt);
        	}
        }
        return redirect('Logistik/manager/waste');
    }

    public function getUnduh($id)
    {
        $find = LogWastePengajuan::find($id);
        $find_waste = LogWaste::where('id',$find->waste_id)->where('soft_delete',0)->first();
        $dt_waste = LogWasteDetail::where('waste_id',$find->waste_id)->where('soft_delete',0)->get();
        if($find && $find_waste){
        	$sem = Pegawai::where('posisi_id',4)->where('soft_delete',0)->first();
        	$splem = Pegawai::where('posisi_id',7)->where('soft_delete',0)->first();
        	$scarm = Pegawai::where('posisi_id',5)->where('soft_delete',0)->first();
        	$pm = Pegawai::where('posisi_id',1)->where('soft_delete',0)->first();

        	$data_sebelum = LogWastePengajuan::whereHas('waste', function ($q) use($find_waste){
        						$q->where('periode','<', $find_waste->periode)
        						  ->where('id','!=',$find_waste->id)
        						  ->where('soft_delete',0);
        					})->where('soft_delete',0)->get();
        	
        	$jml_progress_persen = 0;
        	$jml_progress_vol = 0;
        	$jml_vol_bahan = 0;
        	$jml_real_pemakaian = 0;
        	$jml_waste_vol = 0;
        	foreach ($data_sebelum as $key => $value) {
        		$details = LogWasteDetail::where('waste_id',$value->waste_id)->where('soft_delete',0)->get();
        		foreach ($details as $key => $detail) {
        			$jml_progress_persen = $jml_progress_persen + $detail->progress_persen;
        			$jml_progress_vol = $jml_progress_vol + $detail->progress_vol;
        			$jml_vol_bahan = $jml_vol_bahan + $detail->vol_bahan;
        			$jml_real_pemakaian = $jml_real_pemakaian + $detail->real_pemakaian;
        			$jml_waste_vol = $jml_waste_vol + $detail->waste_vol;
        		}
        	}
	        
	        $excel = \Excel::create("Form Log 08_Evaluasi Waste Material ".$find_waste->bulan." ".$find_waste->tahun, function($excel) use ($find_waste,$dt_waste,$sem,$splem,$scarm,$pm, $jml_progress_persen, $jml_progress_vol, $jml_vol_bahan, $jml_real_pemakaian, $jml_waste_vol) {

	                    $excel->sheet('New sheet', function($sheet) use ($find_waste,$dt_waste,$sem,$splem,$scarm,$pm, $jml_progress_persen, $jml_progress_vol, $jml_vol_bahan, $jml_real_pemakaian, $jml_waste_vol) {

	                        $sheet->loadView('logistik.manager.waste.unduh',['waste' => $find_waste,'datas'=>$dt_waste,'sem'=>$sem,'splem'=>$splem,'scarm'=>$scarm,'pm'=>$pm,'jml_progress_persen'=> $jml_progress_persen, 'jml_progress_vol'=>$jml_progress_vol, 'jml_vol_bahan'=>$jml_vol_bahan,'jml_real_pemakaian'=> $jml_real_pemakaian,'jml_waste_vol'=> $jml_waste_vol]);
	                        $objDrawing = new PHPExcel_Worksheet_Drawing;
	                        $objDrawing->setPath(public_path('img/Waskita.png'));
	                        $objDrawing->setCoordinates('C1');
	                        $objDrawing->setWorksheet($sheet);
	                        $objDrawing->setResizeProportional(false);
	                        // set width later
	                        $objDrawing->setWidth(40);
	                        $objDrawing->setHeight(35);
	                        $sheet->getStyle('C1')->getAlignment()->setIndent(1);

	                        $sheet->getStyle('A13:N15')->getAlignment()->setWrapText(true);
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
	                        $sheet->cell('N2:N3', function($cell){
	                            $cell->setBorder('','','','thin');
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
	                $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
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

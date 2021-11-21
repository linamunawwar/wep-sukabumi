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
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

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

        //cek apakah data waste sudah pernah diinput
        $cekWaste = LogWaste::where('bulan',$bulan)->where('tahun',$tahun)->where('jenis_pekerjaan_id',$jenis_id)->where('lokasi_id',$lokasi_id)->where('soft_delete',0)->first();
        if(!$cekWaste){

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
        }else{
            $data = null;
            return json_encode($data);
        }
    }

    public function postWaste()
    {
        date_default_timezone_set("Asia/Jakarta");
    	$jml = \Input::get('jumlah_data');

        $jenis_pekerjaan_id = \Input::get('jenis_kerja_id');
        $lokasi_id = \Input::get('lokasi_id');
        $bulan = \Input::get('bulan');
        $tahun = \Input::get('tahun');

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
        $logWaste->bulan = $bulan;
        $logWaste->tahun = $tahun;
        $logWaste->lokasi_id = $lokasi_id;
        $logWaste->jenis_pekerjaan_id = $jenis_pekerjaan_id;
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

        $toUpdateWaste['updated_at'] = date('Y-m-d');
        $updatedWaste = LogWaste::where('id', $id)->update($toUpdateWaste);
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

        $getDetail = LogWasteDetail::where('waste_id',$id)->where('soft_delete',0)->get();
        if ($getDetail) {
            foreach ($getDetail as $key => $value) {
                $update['material_id']=$material[$value->id];
                $update['satuan']=$satuan[$value->id];
                $update['vol_app']=$vol_app[$value->id];
                $update['progress_persen']=$progress_persen[$value->id];
                $update['vol_progress']=$vol_progress[$value->id];
                $update['pemakaian']=$pemakaian[$value->id];
                $update['deviasi_vol']=$deviasi_vol[$value->id];
                $update['deviasi']=$deviasi[$value->id];
                $update['rencana_waste']=$rencana_waste[$value->id];
                $update['realisasi']=$realisasi[$value->id];
                $updated = LogWasteDetail::where('id',$value->id)->update($update);
                if ($updated) {
                    $saveStatus = 1;
                } else {
                    $saveStatus = 0;
                    die();
                }
            }
        }
        return redirect('Logistik/admin/waste');
    }
    public function getUnduh($id)
    {
        $find_waste = LogWaste::where('id', $id)->where('soft_delete', 0)->first();
        if ($find_waste) {
            $sem = Pegawai::where('posisi_id', 4)->where('soft_delete', 0)->first();
            $splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
            $scarm = Pegawai::where('posisi_id', 5)->where('soft_delete', 0)->first();
            $pm = Pegawai::where('posisi_id', 1)->where('soft_delete', 0)->first();

            $details = LogWasteDetail::where('waste_id', $id)->where('soft_delete', 0)->get();

            $excel = \Excel::create("Form Log 08_Evaluasi Waste Material " . $find_waste->bulan . " " . $find_waste->tahun, function ($excel) use ($find_waste, $details, $sem, $splem, $scarm, $pm) {

                $excel->sheet('New sheet', function ($sheet) use ($find_waste, $details, $sem, $splem, $scarm, $pm) {

                    $sheet->loadView('logistik.admin.waste.unduh', ['waste' => $find_waste, 'details' => $details, 'sem' => $sem, 'splem' => $splem, 'scarm' => $scarm, 'pm' => $pm]);
                    $objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('img/Waskita.png'));
                    $objDrawing->setCoordinates('C4');
                    $objDrawing->setWorksheet($sheet);
                    $objDrawing->setResizeProportional(false);
                    // set width later
                    $objDrawing->setWidth(40);
                    $objDrawing->setHeight(35);
                    $sheet->getStyle('C1')->getAlignment()->setIndent(1);

                    $sheet->getStyle('A13:M45')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('A2:M45')->getFont()->setName('Tahoma');
                    $sheet->getStyle('A15:M18')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );
                    $sheet->cells('A9:M16', function ($cells) {
                        $cells->setValignment('center');
                        $cells->setFontFamily('Tahoma');
                    });

                    $sheet->cell('C7', function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                    $sheet->cell('C9', function ($cell) {
                        $cell->setalignment('center');
                        $cell->setValignment('center');
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                    
                    //set image ttd pm
                    // init drawing
                    if(file_exists("upload/pegawai/$pm->nip/$pm->ttd")){
                        $drawing = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing->setPath("upload/pegawai/$pm->nip/$pm->ttd");
                        $drawing->setWorksheet($sheet);
                        $drawing->setCoordinates('D43');
                        $drawing->setResizeProportional(false);
                        $drawing->setWidth(150);
                        $drawing->setHeight(100);
                    }
                    //set image ttd splem
                    // init drawing
                    if(file_exists("upload/pegawai/$splem->nip/$splem->ttd")){
                        $drawing2 = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing2->setPath("upload/pegawai/$splem->nip/$splem->ttd");
                        $drawing2->setWorksheet($sheet);
                        $drawing2->setCoordinates('F43');
                        $drawing2->setResizeProportional(false);
                        $drawing2->setWidth(150);
                        $drawing2->setHeight(100);
                    }
                    //set image ttd sem
                    // init drawing
                    if(file_exists("upload/pegawai/$sem->nip/$sem->ttd")){
                        $drawing3 = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing3->setPath("upload/pegawai/$sem->nip/$sem->ttd");
                        $drawing3->setWorksheet($sheet);
                        $drawing3->setCoordinates('I43');
                        $drawing3->setResizeProportional(false);
                        $drawing3->setWidth(150);
                        $drawing3->setHeight(100);
                    }
                    //set image ttd scarm
                    // init drawing
                    if(file_exists("upload/pegawai/$scarm->nip/$scarm->ttd")){
                        $drawing4 = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing4->setPath("upload/pegawai/$scarm->nip/$scarm->ttd");
                        $drawing4->setWorksheet($sheet);
                        $drawing4->setCoordinates('L43');
                        $drawing4->setResizeProportional(false);
                        $drawing4->setWidth(150);
                        $drawing4->setHeight(100);
                    }

                    $sheet->setWidth(array(
                        'A'     =>  1,
                        'B'     =>  1,
                        'C'     =>  6,
                        'D'     =>  35,
                        'E'     =>  12,
                        'F'     =>  12,
                        'G'     =>  12,
                        'H'     =>  12,
                        'I'     =>  12,
                        'J'     =>  12,
                        'K'     =>  12,
                        'L'     =>  12,
                        'M'     =>  12
                    )); 
                    $sheet->setHeight(array(
                        43     =>  90,
                        44     =>  30
                    )); 
                });
            });
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $styleArray = array(
                'font' => array(
                    'name' => 'Tahoma',
                ));
            $excel->getDefaultStyle()
                ->applyFromArray($styleArray);
            return $excel->export('xls');
        }
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

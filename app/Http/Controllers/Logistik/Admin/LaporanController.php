<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;
use App\Models\LogDetailPengajuanPakai;
use App\Pegawai;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class LaporanController extends Controller
{
    public function getLog06()
    {
    	return view('logistik.admin.log06.index');
    }

    public function postLog06()
    {
    	$data = \Input::all();
    	$data['tanggal_mulai']=konversi_tanggal($data['tanggal_mulai']);
    	$data['tanggal_selesai']=konversi_tanggal($data['tanggal_selesai']);
    	$permintaans = LogPermintaanMaterial::where('tanggal','>=',$data['tanggal_mulai'])
    										->where('tanggal','<=',$data['tanggal_selesai'])
    										->where('soft_delete',0)
    										->get();

    	$materials = [];
    	$count = count($materials);
    	foreach ($permintaans as $key => $permintaan) {
    		foreach ($permintaan->permintaanDetail as $key1 => $detail) {
    			if(array_search($detail->material_id,array_column($materials,'material_id')) === false){
                    $materials[$count]['material_id'] = (int)$detail->material_id;
    				$materials[$count]['nama'] = $detail->detailPermintaanMaterial->nama;
    				$materials[$count]['kebutuhan'] = (int)$detail->volume;
    				$materials[$count]['masuk'] = 0;
    				$materials[$count]['terpakai'] = 0;
    				$materials[$count]['harga'] = 0;
    				$count++;
    			}else{
    				$index = array_search($detail->material_id,array_column($materials,'material_id'));
    				$materials[$index]['kebutuhan'] = (int)$materials[$index]['kebutuhan'] + (int)$detail->volume;
    			}
    		}
    		
    	}

    	foreach ($materials as $key => $material) {
    		$penerimaans = LogDetailPenerimaanMaterial::where('material_id',$material['material_id'])
    										->whereDate('created_at','>=',$data['tanggal_mulai'])
    										->whereDate('created_at','<=',$data['tanggal_selesai'])
    										->where('material_id',$material['material_id'])
    										->where('soft_delete',0)
    										->get();

    		foreach ($penerimaans as $key => $detail) {
    			if(array_search($detail->material_id,array_column($materials,'material_id')) !== false){
    				$index = array_search($detail->material_id,array_column($materials,'material_id'));
    				$materials[$index]['masuk'] = (int)$materials[$index]['masuk'] + (int)$detail->vol_saat_ini;
    				$materials[$index]['harga']  = (int)$detail->harga;
    			}
    		}

    		$pengajuans = LogDetailPengajuanPakai::where('material_id',$material['material_id'])
    										->whereDate('created_at','>=',$data['tanggal_mulai'])
    										->whereDate('created_at','<=',$data['tanggal_selesai'])
    										->where('material_id',$material['material_id'])
    										->where('soft_delete',0)
    										->get();

    		foreach ($pengajuans as $key => $detail) {
    			if(array_search($detail->material_id,array_column($materials,'material_id')) !== false){
    				$index = array_search($detail->material_id,array_column($materials,'material_id'));
    				$materials[$index]['terpakai'] = (int)$materials[$index]['terpakai'] + (int)$detail->penyerahan_jumlah;
    			}
    		}
    	}

    	$splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
    	$excel = \Excel::create("Form Log-06 Laporan Evaluasi Pemakaian Bahan " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($data,$materials,$splem) {

                $excel->sheet('New sheet', function ($sheet) use ($data,$materials,$splem) {

                    $sheet->loadView('logistik.admin.log06.unduh', ['data' => $data, 'materials' => $materials,'splem' => $splem]);
                    $objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('img/Waskita.png'));
                    $objDrawing->setCoordinates('C1');
                    $objDrawing->setWorksheet($sheet);
                    $objDrawing->setResizeProportional(false);
                    // set width later
                    $objDrawing->setWidth(40);
                    $objDrawing->setHeight(35);
                    $sheet->getStyle('C1')->getAlignment()->setIndent(1);

                    $sheet->getStyle('A13:N63')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('A2:O36')->getFont()->setName('Tahoma');
                    $sheet->getStyle('A13:N15')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );
                    $sheet->cells('A9:M11', function ($cells) {
                        $cells->setValignment('center');
                        $cells->setFontFamily('Tahoma');
                    });

                    $sheet->cell('D9:E11', function ($cell) {
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D8:E8', function ($cell) {
                        $cell->setBorder('', '', 'thin', '');
                    });
                    $sheet->cell('C4', function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                    $sheet->cell('C6', function ($cell) {
                        $cell->setalignment('center');
                        $cell->setValignment('center');
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                    // $sheet->cell('B14:E14', function($cell){
                    //     $cell->setBorder('','','','thin');
                    // });
                });
            });
            $styleArray = array(
                'font' => array(
                    'name' => 'Tahoma',
                ));
            $excel->getDefaultStyle()
                ->applyFromArray($styleArray);
            return $excel->export('xls');
    }
}

<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;
use App\Models\LogDetailPengajuanPakai;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;
use App\Pegawai;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;
use PHPExcel_Style_Border;

class LaporanController extends Controller
{
    function getWeek($Date){
        $dt = strtotime($Date);
        $day  = date('j',$dt);
        $month = date('m',$dt);
        $year = date('Y',$dt);
        $totalDays = date('t',$dt);
        $weekCnt = 0;
        $retWeek = 0;
        for($i=1;$i<=$totalDays;$i++) {
            $curDay = date("N", mktime(0,0,0,$month,$i,$year));
            if($curDay==7) {
                if($i==$day) {
                    $retWeek = $weekCnt+1;
                }
                $weekCnt++;
            } else {
                if($i==$day) {
                    $retWeek = $weekCnt;
                }
            }
        }
        return $retWeek;
    }

    //log 06 berubah jadi log 05
    public function getLog06()
    {
    	return view('logistik.admin.log06.index',['show'=>0]);
    }

    public function postLog06()
    {
    	$data = \Input::all();
    	$tgl_mulai=konversi_tanggal($data['tanggal_mulai']);
    	$tgl_selesai=konversi_tanggal($data['tanggal_selesai']);
        $i = 1;
        $materials = [];
        $count = count($materials);
    	while($tgl_mulai <= $tgl_selesai){  

            $i++;
            
            $permintaans = LogPermintaanMaterial::where('tanggal','=',$tgl_mulai)
                                            ->where('soft_delete',0)
                                            ->where('is_scarm',1)
                                            ->get();
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

            $penerimaans = LogDetailPenerimaanMaterial::where('tanggal_terima','=',$tgl_mulai)
                                            ->where('soft_delete',0)
                                            ->whereHas('penerimaan',function ($q){
                                              $q->where('is_splem', 1);
                                            })
                                            ->get();
            $count = count($materials);
            foreach ($penerimaans as $key => $detail) {
                if(array_search($detail->material_id,array_column($materials,'material_id')) !== false){
                    $index = array_search($detail->material_id,array_column($materials,'material_id'));
                    $materials[$index]['masuk'] = (int)$materials[$index]['masuk'] + (int)$detail->vol_saat_ini;
                    $materials[$index]['harga']  = (int)$detail->harga;
                }else{
                    $materials[$count]['material_id'] = (int)$detail->material_id;
                    $materials[$count]['nama'] = $detail->material->nama;
                    $materials[$count]['kebutuhan'] = 0;
                    $materials[$count]['masuk'] = (int)$detail->vol_saat_ini;
                    $materials[$count]['terpakai'] = 0;
                    $materials[$count]['harga'] = 0;
                    $count++;
                }
            }

            $pengajuans = LogDetailPengajuanPakai::where('tanggal_pengajuan','=',$tgl_mulai)
                                            ->where('soft_delete',0)
                                            ->whereHas('pengajuan',function ($q){
                                              $q->where('is_splem', 1);
                                            })
                                            ->get();
            $count = count($materials);

            foreach ($pengajuans as $key => $detail) {
                if(array_search($detail->material_id,array_column($materials,'material_id')) !== false){
                    $index = array_search($detail->material_id,array_column($materials,'material_id'));
                    $materials[$index]['terpakai'] = (int)$materials[$index]['terpakai'] + (int)$detail->pemyerahan_jumlah;
                }else{
                    $materials[$count]['material_id'] = (int)$detail->material_id;
                    $materials[$count]['nama'] = $detail->material->nama;
                    $materials[$count]['kebutuhan'] = 0;
                    $materials[$count]['masuk'] = 0;
                    $materials[$count]['terpakai'] = (int)$detail->pemyerahan_jumlah;
                    $materials[$count]['harga'] = 0;
                    $count++;
                }
            }
            
            $tgl_mulai = date('Y-m-d',strtotime('+1 days',strtotime($tgl_mulai)));
        }
        
        $splem = getManagerLaporan('SL',$tgl_mulai);
        if(!isset($data['proses'])){
            $data['proses'] = 0;
        }
        if(!isset($data['unduh'])){
            $data['unduh'] = 0;
        }

        if($data['proses'] == 1){
                return view('logistik.admin.log06.index', ['data' => $data, 'materials' => $materials,'splem' => $splem,'show'=>1]);

        }elseif($data['unduh'] == 1){
            if(count($materials)!= 0){
                $path = base_path();
            	$excel = \Excel::create("Form Log-05 Laporan Evaluasi Pemakaian Bahan " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($data,$materials,$splem,$path) {

                        $excel->sheet('New sheet', function ($sheet) use ($data,$materials,$splem,$path) {

                            $sheet->loadView('logistik.admin.log06.unduh', ['dt' => $data, 'materials' => $materials,'splem' => $splem]);
                            $objDrawing = new PHPExcel_Worksheet_Drawing;
                            $objDrawing->setPath(public_path('img/Waskita.png'));
                            $objDrawing->setCoordinates('C4');
                            $objDrawing->setWorksheet($sheet);
                            $objDrawing->setResizeProportional(false);
                            // set width later
                            $objDrawing->setWidth(40);
                            $objDrawing->setHeight(35);
                            $sheet->getStyle('C4')->getAlignment()->setIndent(1);

                          
                            $sheet->loadView('logistik.admin.log06.unduh', ['dt' => $data, 'materials' => $materials,'splem' => $splem]);
                            $objDrawing = new PHPExcel_Worksheet_Drawing;
                            // $objDrawing->setPath($path."\upload\pegawai\\".$splem->nip."\\".$splem->ttd);
                            $path = public_path();
                            $path2 = str_replace('public','upload',$path);
                            $path3 = str_replace('laravel','public_html',$path2);
                            $objDrawing->setPath($path3.'/pegawai/'.$splem->nip."/".$splem->ttd);
                            $objDrawing->setCoordinates('I57');
                            $objDrawing->setWorksheet($sheet);
                            $objDrawing->setResizeProportional(false);
                            // set width later
                            $objDrawing->setWidth(100);
                            $objDrawing->setHeight(75);
                            $sheet->getStyle('I55')->getAlignment()->setIndent(5);

                            $sheet->getStyle('C15:J15')->applyFromArray(array(
                                                            'borders' => array(
                                                                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));

                            $sheet->getStyle('C15:J15')->applyFromArray(array(
                                                            'borders' => array(
                                                                'top' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE)
                                                            )
                                                        ));
                            $sheet->getStyle('C16:J16')->applyFromArray(array(
                                                            'borders' => array(
                                                                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('C17:J17')->applyFromArray(array(
                                                            'borders' => array(
                                                                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('C17:J17')->applyFromArray(array(
                                                            'borders' => array(
                                                                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE)
                                                            )
                                                        ));
                            $sheet->getStyle('C18:C52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('D18:D52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('E18:E52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('F18:F52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('G18:G52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('H18:H52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('I18:I52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('J18:J52')->applyFromArray(array(
                                                            'borders' => array(
                                                                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
                                                            )
                                                        ));
                            $sheet->getStyle('A10:J70')->getAlignment()->setWrapText(true);
                            $sheet->getStyle('A2:J70')->getFont()->setName('Tahoma');
                            $sheet->getStyle('A15:J17')->getAlignment()->applyFromArray(
                                array('horizontal' => 'center')
                            );
                            $sheet->cells('A9:J60', function ($cells) {
                                $cells->setValignment('center');
                                $cells->setFontFamily('Tahoma');
                            });

                            $sheet->cell('C9:J15', function ($cell) {
                                $cell->setValignment('center');
                            });
                            

                            $sheet->cell('C7', function ($cell) {
                                $cell->setBorder('thin', 'thin', 'thin', 'thin');
                            });
                            $sheet->cell('C9', function ($cell) {
                                $cell->setalignment('center');
                                $cell->setValignment('center');
                                $cell->setBorder('thin', 'thin', 'thin', 'thin');
                            });


                            $sheet->setWidth(array(
                                'A'     =>  1,
                                'B'     =>  1,
                                'C'     =>  8,
                                'D'     =>  25,
                                'E'     =>  8,
                                'F'     =>  8,
                                'G'     =>  8,
                                'H'     =>  8,
                                'I'     =>  12,
                                'J'     =>  12
                            ));
                        });
                    });
                    $styleArray = array(
                        'font' => array(
                            'name' => 'Tahoma',
                        ));
                    $excel->getDefaultStyle()
                        ->applyFromArray($styleArray);

                    return $excel->export('xls');
            }else{
                return view('logistik.admin.log06.index', ['data' => $data, 'materials' => $materials,'splem' => $splem,'show'=>1]);
            }
        }
	}


    //log07= buku harian pengeluaran bahan
	public function getLog07()
    {
        $jeniss = LogJenis::where('soft_delete',0)->get();
        $lokasis = LogLokasi::where('soft_delete',0)->get();

        return view('logistik.admin.log07.index',['jeniss'=>$jeniss,'lokasis'=>$lokasis,'show'=>0]);
    }

    public function postLog07()
    {
        $data = \Input::all();
        $data['tanggal_mulai']=konversi_tanggal($data['tanggal_mulai']);
        $data['tanggal_selesai']=konversi_tanggal($data['tanggal_selesai']);
        $data['jenis'] = LogJenis::find($data['jenis']);
        $data['lokasi'] = LogLokasi::find($data['lokasi']);
        $tanggal_mulai = $data['tanggal_mulai'];
        $init_tanggal = $data['tanggal_mulai'];
        $tanggal_selesai = $data['tanggal_selesai'];
        $pengajuans = LogPengajuanMaterial::where('tanggal','>=',$data['tanggal_mulai'])
                                            ->where('tanggal','<=',$data['tanggal_selesai'])
                                            ->where('jenis_pekerjaan_id',$data['jenis']->id)
                                            ->where('lokasi_kerja_id',$data['lokasi']->id)
                                            ->where('soft_delete',0)
                                            ->where('is_splem',1)
                                            ->get();
                                            
        $selisih = date_diff(date_create($data['tanggal_mulai']),date_create($data['tanggal_selesai']));
        $selisih = (int)$selisih->format("%a");
        $materials = [];
        $bulan = explode('-', $data['tanggal_selesai']);
        $bulan_ini = $bulan[1];
        $bulan_lalu = (int)$bulan[1]-1;
        $tahun = $bulan[0];
        //initiate array tanggal
        for ($j=0; $j <=$selisih ; $j++) {
            $tanggal[] = $init_tanggal; 
            $init_tanggal = date('Y-m-d', strtotime("+1 day", strtotime($init_tanggal))); 
        }

        $count = count($materials);
        foreach ($pengajuans as $key => $pengajuan) {
            foreach ($pengajuan->pengajuanDetail as $key1 => $detail) {
                if(array_search($detail->material_id,array_column($materials,'material_id')) === false){
                    $materials[$count]['material_id'] = (int)$detail->material_id;
                    $materials[$count]['nama'] = $detail->detailPengajuanMaterial->nama;
                    $tanggal_mulai = $data['tanggal_mulai'];
                    for ($j=0; $j <=$selisih ; $j++) { 
                        $jumlah = 0;
                        $dt = LogPengajuanMaterial::whereHas('pengajuanDetail',function ($q) use($tanggal_mulai){
                                                      $q->where('tanggal_pengajuan', $tanggal_mulai);
                                                    })->where('soft_delete',0)
                                                    ->where('jenis_pekerjaan_id',$data['jenis']->id)
                                                    ->where('lokasi_kerja_id',$data['lokasi']->id)
                                                    ->where('is_splem',1)
                                                    ->get();
                        
                        foreach ($dt as $key => $value) {
                            $jumlah = 0;
                           $dt_detail  = LogDetailPengajuanMaterial::where('tanggal_pengajuan', $tanggal_mulai)
                                                                    ->where('material_id',$detail->material_id)
                                                                    ->where('soft_delete',0)
                                                                    ->whereHas('detailPengajuan',function ($q){
                                                                      $q->where('is_splem', 1);
                                                                    })
                                                                    ->get();
                           
                           $dt_detail_lalu  = LogDetailPengajuanMaterial::whereMonth('tanggal_pengajuan', $bulan_lalu)
                                                                        ->whereYear('tanggal_pengajuan',$tahun)
                                                                        ->where('material_id',$detail->material_id)
                                                                        ->where('soft_delete',0)
                                                                        ->whereHas('detailPengajuan',function ($q){
                                                                          $q->where('is_splem', 1);
                                                                        })
                                                                        ->get();

                           foreach ($dt_detail as $key => $dtl) {
                               $jumlah = $jumlah +(int)$dtl->pemyerahan_jumlah;
                           }
                           $jumlah_lalu = 0;
                           foreach ($dt_detail_lalu as $key => $dtl_lalu) {
                               $jumlah_lalu = $jumlah_lalu + (int)$dtl_lalu->pemyerahan_jumlah;
                           }
                           $materials[$count]['jumlah_lalu']= $jumlah_lalu;

                        }
                        
                        $materials[$count]['jumlah'][$tanggal_mulai] = $jumlah;
                        $tanggal_mulai = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_mulai))); 
                    }
                    
                    $count++;
                }
            }
        }

        $splem = getManagerLaporan('SL',$data['tanggal_mulai']);
        $admin = Pegawai::where('posisi_id', \Auth::user()->pegawai->posisi_id)->where('soft_delete', 0)->first();

        if(!isset($data['proses'])){
            $data['proses'] = 0;
        }
        if(!isset($data['unduh'])){
            $data['unduh'] = 0;
        }

        if($data['proses'] == 1){
                $jeniss = LogJenis::where('soft_delete',0)->get();
                $lokasis = LogLokasi::where('soft_delete',0)->get();

                return view('logistik.admin.log07.index', ['jeniss'=>$jeniss,'lokasis'=>$lokasis,'data' => $data, 'materials' => $materials,'splem' => $splem,'tanggal'=>$tanggal,'show'=>1]);

        }elseif($data['unduh'] == 1){
            if(count($materials)!= 0){

                $excel = \Excel::create("Form Log-07 Buku Harian Pengeluaran Bahan " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($data,$materials,$splem,$tanggal) {

                        $excel->sheet('New sheet', function ($sheet) use ($data,$materials,$splem,$tanggal) {

                            $sheet->loadView('logistik.admin.log07.unduh', ['data' => $data, 'materials' => $materials,'splem' => $splem,'tanggal'=>$tanggal]);
                            // $objDrawing = new PHPExcel_Worksheet_Drawing;
                            // $objDrawing->setPath(public_path('img/Waskita.png'));
                            // $objDrawing->setCoordinates('C1');
                            // $objDrawing->setWorksheet($sheet);
                            // $objDrawing->setResizeProportional(false);
                            // // set width later
                            // $objDrawing->setWidth(40);
                            // $objDrawing->setHeight(35);
                            // $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                            $sheet->cells('A1:M60', function ($cells) {
                                $cells->setValignment('center');
                                $cells->setFontFamily('Tahoma');
                            });

                            $sheet->getStyle('A13:N63')->getAlignment()->setWrapText(true);
                            // $sheet->getStyle('A2:O50')->getFont()->setName('Tahoma');
                            $sheet->getStyle('A13:N15')->getAlignment()->applyFromArray(
                                array('horizontal' => 'center')
                            );
                            $sheet->cells('A1:M18', function ($cells) {
                                $cells->setValignment('center');
                            });

                            $sheet->cell('D9:E11', function ($cell) {
                                $cell->setValignment('center');
                            });
                            $sheet->cell('D8:E8', function ($cell) {
                                $cell->setBorder('', '', 'thin', '');
                            });
                            $sheet->cell('C15:D15', function ($cell) {
                                $cell->setBorder('', '', 'double', '');
                            });
                            $sheet->cell('C18:D18', function ($cell) {
                                $cell->setBorder('', 'double', 'double', '');
                            });
                            $sheet->cell('C16:C17', function ($cell) {
                                $cell->setBorder('', '', '', 'double');
                            });
                            // $sheet->cell('B14:E14', function($cell){
                            //     $cell->setBorder('','','','thin');
                            // });
                        });
                    });
                    // $styleArray = array(
                    //     'font' => array(
                    //         'name' => 'Tahoma',
                    //     ));
                    $excel->getActiveSheet()->getPageSetup()->setFitToWidth(0);
                    $excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
                    $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(4);
                    $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(5);
                    $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(5);
                    $excel->getActiveSheet()->getRowDimension('15')->setRowHeight(4);
                    $excel->getActiveSheet()->getRowDimension('53')->setRowHeight(4);
                    $excel->getActiveSheet()->getRowDimension('18')->setRowHeight(13);
                    $excel->getActiveSheet()->getRowDimension('51')->setRowHeight(13);
                    $excel->getActiveSheet()->getRowDimension('52')->setRowHeight(13);
                    for ($i=19; $i <=50 ; $i++) { 
                        $excel->getActiveSheet()->getRowDimension($i)->setRowHeight(13);
                    }
                    $excel->getActiveSheet()->getPageMargins()->setLeft(0.5);
                    $excel->getActiveSheet()->getPageMargins()->setRight(0.28);
                    $excel->getDefaultStyle()->getAlignment()->setWrapText(true);
                    $excel->getActiveSheet()->getStyle('A1:Z'.$excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
                    $excel->getActiveSheet()->cells('A1:Z'.$excel->getActiveSheet()->getHighestRow(),  function ($cells) {
                        $cells->setValignment('center');
                    });

                    // $excel->getDefaultStyle()
                    //     ->applyFromArray($styleArray);
                    return $excel->export('xls');
            }
        }
    }
	
    //kartu gudang
	public function getLog02()
    {
        $namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
		$idBulan = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $getMaterial = LogMaterial::where('soft_delete', 0)->get();
        
        return view('logistik.admin.log02.index', ['bln' => $namaBulan, 'idBln' => $idBulan, 'materials' => $getMaterial,'show'=>0]);
	}
	
	public function postLog02()
	{
		$data = \Input::all();
    	$data['tanggal_mulai'] = $data['tahun'].'-'.$data['bulan'].'-01';
		$data['tanggal_selesai'] = $data['tahun'].'-'.$data['bulan'].'-31';
		$bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
        $tahun = $data['tahun'];

		for ($i=01; $i <= 12; $i++) { 
			if ($i == $data['bulan']) {
				$getBulan = $bulan[$i];
			break;
			}
		}

		$getMaterial = LogMaterial::where('id', $data['material'])
									->where('soft_delete', 0)
                                    ->first();

        // $getBulan = LaporanController::getWeek($getMaterial->tanggal);
		$dt = [];
        $trs_keluar = 0;
        $trs_terima = 0;
        $tgl_terakhir = 0;
		for ($i=1; $i <=31 ; $i++) { 
			$dt[$i]['jml_terima'] = 0;
			$dt[$i]['jml_keluar'] = 0;
			$dt[$i]['sisa'] = 0;
			$tampung = 0;
			$tgl = $i;
            if ($i == 1) {
                $dt[$i]['trs_terima'] = 0;
                $dt[$i]['trs_keluar'] = 0;
            }


			if (strlen($i) == 1) {
				$tgl = '0'.$i;
			}
			// $penerimaans = LogPenerimaanMaterial::where('tanggal','=',$data['tahun'].'-'.$data['bulan'].'-'.$tgl)
			// 									->where('soft_delete',0)
			// 									->get();
   //          var_dump($i);
   //          var_dump(count($penerimaans));
			// foreach ($penerimaans as $key => $penerimaan) {
				$penerimaanDetails = LogDetailPenerimaanMaterial::where('material_id',$data['material'])
																->where('soft_delete',0)
                                                                ->where('tanggal_terima', '=', $data['tahun'].'-'.$data['bulan'].'-'.$tgl)
                                                                ->whereHas('penerimaan',function ($q){
                                                                  $q->where('is_splem', 1);
                                                                })
                                                                ->get();
				if(count($penerimaanDetails) != 0){
    				foreach ($penerimaanDetails as $key => $value) {				
    					$dt[$i]['jml_terima'] = $dt[$i]['jml_terima'] + $value->vol_saat_ini;
    					$trs_terima = $trs_terima + $dt[$i]['jml_terima'];
                        $dt[$i]['trs_terima'] = $trs_terima;
    				}
                    $d = date('d',strtotime($value->tanggal_terima));
                    if($tgl_terakhir<$d){
                        $tgl_terakhir = $d;
                    }
                }else{
                    $dt[$i]['trs_terima'] = $trs_terima;
                }
			
				$pengajuanDetails = LogDetailPengajuanPakai::where('material_id',$data['material'])
																->where('soft_delete',0)
																->where('tanggal_pengajuan', '=', $data['tahun'].'-'.$data['bulan'].'-'.$tgl)
                                                                ->whereHas('pengajuan',function ($q){
                                                                  $q->where('is_splem', 1);
                                                                })
                                                                ->get();
				if (count($pengajuanDetails) != 0) {					
					foreach ($pengajuanDetails as $key => $value) {
						$dt[$i]['jml_keluar'] = $dt[$i]['jml_keluar'] + $value->permintaan_jumlah;
                        $trs_keluar = $trs_keluar + $dt[$i]['jml_keluar'];
						$dt[$i]['trs_keluar'] = $trs_keluar;
					}
                    $d = date('d',strtotime($value->tanggal_pengajuan));
                    if($tgl_terakhir<$d){
                        $tgl_terakhir = $d;
                    }
				}else{
                    $dt[$i]['trs_keluar'] = $trs_keluar;
                }

			$dt[$i]['sisa'] = $dt[$i]['trs_terima'] - $dt[$i]['trs_keluar'];
		}

		$splem = getManagerLaporan('SL',$data['tanggal_mulai']);
        if(!isset($data['proses'])){
            $data['proses'] = 0;
        }
        if(!isset($data['unduh'])){
            $data['unduh'] = 0;
        }
        
        if($tgl_terakhir == 0){
            $tgl_terakhir = '01';
        }
        $data['tgl_terakhir'] = $tgl_terakhir;
        if($data['proses'] == 1){
            $namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
            $idBulan = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
            $allMaterial = LogMaterial::where('soft_delete', 0)->get();

            return view('logistik.admin.log02.index', ['bln' => $namaBulan, 'idBln' => $idBulan, 'materials' => $allMaterial,'data' => $dt, 'data2'=>$data, 'bulanIni' => $getBulan, 'material' => $getMaterial, 'splem' => $splem,'show'=>1]);

        }elseif($data['unduh'] == 1){
            if(count($dt)!= 0){
            	$excel = \Excel::create("Form Log-02 Laporan Kartu Gudang " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($getBulan, $getMaterial, $dt,$data,$splem,$tahun) {

                        $excel->sheet('New sheet', function ($sheet) use ($getBulan, $getMaterial, $dt,$data,$splem,$tahun) {

                            $sheet->loadView('logistik.admin.log02.unduh', ['data' => $dt,'data2'=>$data, 'bulan' => $getBulan,'material' => $getMaterial, 'splem' => $splem]);

                            $objDrawing = new PHPExcel_Worksheet_Drawing;
                            $objDrawing->setPath(public_path('img/Waskita.png'));
                            $objDrawing->setCoordinates('C4');
                            $objDrawing->setWorksheet($sheet);
                            $objDrawing->setResizeProportional(false);
                            // set width later
                            $objDrawing->setWidth(40);
                            $objDrawing->setHeight(35);
                            $sheet->getStyle('C1')->getAlignment()->setIndent(1);

                            // //Set Ttd Image
                            // $ttdImage = new PHPExcel_Worksheet_Drawing;
                            // $ttdImage->setPath(public_path("../upload/pegawai/$splem->nip/$splem->ttd"));
                            // $ttdImage->setCoordinates('D50');
                            // $ttdImage->setWorksheet($sheet);
                            // $ttdImage->setResizeProportional(false);
                            // // set width later
                            // $ttdImage->setWidth(20);
                            // $ttdImage->setHeight(35);

                            $sheet->getStyle('A13:J57')->getAlignment()->setWrapText(true);
                            $sheet->getStyle('A2:J50')->getFont()->setName('Tahoma');
                            $sheet->getStyle('A13:J17')->getAlignment()->applyFromArray(
                                array('horizontal' => 'center')
                            );
                            $sheet->cells('A9:J17', function ($cells) {
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
                            // $sheet->mergeCells('C16:D17');
                            $sheet->cell('C16:D16', function ($cell) {
                                $cell->setBorder('thin', '', '', 'thin');
                            });

                            $sheet->cell('C17:D17', function($cell){
                                $cell->setBorder('','thin','','thin');
                            });

                            //set image ttd splem
                            // init drawing
                            if(file_exists("upload/pegawai/$splem->nip/$splem->ttd")){
                                $drawing2 = new PHPExcel_Worksheet_Drawing();
                                // Set image
                                $drawing2->setPath("upload/pegawai/$splem->nip/$splem->ttd");
                                $drawing2->setWorksheet($sheet);
                                $drawing2->setCoordinates('D54');
                                $drawing2->setResizeProportional(false);
                                $drawing2->setWidth(150);
                                $drawing2->setHeight(100);
                            }


                            $sheet->setHeight(55,90);

                            $sheet->setWidth(array(
                                'A'     =>  1,
                                'B'     =>  1,
                                'C'     =>  3,
                                'D'     =>  5,
                                'E'     =>  15,
                                'F'     =>  15,
                                'G'     =>  15,
                                'H'     =>  15,
                                'I'     =>  12,
                                'J'     =>  12
                            )); 
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
	}

    //buku harian gudang, nama file log04
	public function getLog05()
    {
        return view('logistik.admin.log05.index',['show'=>0]);
	}
	
	public function postLog05()
	{		
		$data = \Input::all();
		$tgl_mulai=konversi_tanggal($data['tanggal_mulai']);
		$tgl_selesai=konversi_tanggal($data['tanggal_selesai']);
		$dt = [];
        $i = 1;      
        $baris_data =0;

		while($tgl_mulai <= $tgl_selesai){
            $j = 0;	
            $dt[$i]['tanggal'] = '';	
            $dt[$i]['data'] = [];  
            $dt[$i]['data'][$j]['material'] = '';
            $dt[$i]['data'][$j]['satuan'] = '';
            $dt[$i]['data'][$j]['jml_terima'] = 0;
            $dt[$i]['data'][$j]['jml_keluar'] = 0;
			
			$dt[$i]['tanggal'] = $tgl_mulai;			
            $penerimaanDetails = LogDetailPenerimaanMaterial::where('tanggal_terima','=',$tgl_mulai)
                                                            ->where('soft_delete',0)
                                                            ->whereHas('penerimaan',function ($q){
                                                              $q->where('is_splem', 1);
                                                            })
                                                            ->get();

            $pengajuanDetails = LogDetailPengajuanPakai::where('tanggal_pengajuan','=',$tgl_mulai)
                                                        ->where('soft_delete',0)
                                                        ->whereHas('pengajuan',function ($q){
                                                          $q->where('is_splem', 1);
                                                        })
                                                        ->get();
                                  				
            foreach ($penerimaanDetails as $key => $penerimaan) {               
                $dt[$i]['data'][$j]['material'] = $penerimaan->material->nama;
                $dt[$i]['data'][$j]['satuan'] = $penerimaan->material->satuan;
                $dt[$i]['data'][$j]['jml_terima'] = $penerimaan->vol_saat_ini;
                $dt[$i]['data'][$j]['jml_keluar'] = 0;

                foreach ($pengajuanDetails as $key => $pengajuan) {
                    if ($pengajuan->material_id == $penerimaan->material_id) {
                        $dt[$i]['data'][$j]['jml_keluar'] = $pengajuan->pemyerahan_jumlah;
                    }
                }
            $j++;                
            }
            //jika datanya kosong perhitungan baris ditab=mbah satu
            if(count($penerimaanDetails) == 0){
                $baris_data = $baris_data +$j+1;
            }else{
                $baris_data = $baris_data + $j;
            }
            

            // foreach ($pengajuanDetails as $key => $pengajuan) {                
            //     $dt[$i]['data'][$j]['material'] = $pengajuan->material->nama;
            //     $dt[$i]['data'][$j]['satuan'] = $pengajuan->material->satuan;
            //     $dt[$i]['data'][$j]['jml_terima'] = 0;
            //     $dt[$i]['data'][$j]['jml_keluar'] = $pengajuan->pemyerahan_jumlah;
            //     $j++;
            // }       
			$i++;
			$tgl_mulai = date('Y-m-d',strtotime('+1 days',strtotime($tgl_mulai)));
        }

        //angka 22 di dapet dr itungan jumlah baris dr atas smpai tabel dan dr tabel sampe kolom untuk ttd
        $baris_data = $baris_data+22;

		$splem = getManagerLaporan('SL',$tgl_mulai);

        if(!isset($data['proses'])){
            $data['proses'] = 0;
        }
        if(!isset($data['unduh'])){
            $data['unduh'] = 0;
        }

        if($data['proses'] == 1){
                return view('logistik.admin.log05.index', ['data' => $dt,'dataInput'=>$data, 'splem' => $splem,'show'=>1]);

        }elseif($data['unduh'] == 1){
            if(count($dt)!= 0){

            	$excel = \Excel::create("Form Log-04 Laporan Harian Gudang " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($dt, $splem,$data, $baris_data) {

                        $excel->sheet('New sheet', function ($sheet) use ($dt, $splem,$data,$baris_data) {

                            $sheet->loadView('logistik.admin.log05.unduh', ['data' => $dt, 'splem' => $splem,'tanggal_mulai'=>$data['tanggal_mulai'], 'tanggal_selesai' => $data['tanggal_selesai'],'baris_data'=>$baris_data]);
                            $objDrawing = new PHPExcel_Worksheet_Drawing;
                            $objDrawing->setPath(public_path('img/Waskita.png'));
                            $objDrawing->setCoordinates('C4');
                            $objDrawing->setWorksheet($sheet);
                            $objDrawing->setResizeProportional(false);
                            // set width later
                            $objDrawing->setWidth(40);
                            $objDrawing->setHeight(35);

                            $sheet->getStyle('C4')->getAlignment()->setIndent(1);

                            $sheet->getStyle('A13:J63')->getAlignment()->setWrapText(true);
                            $sheet->getStyle('A2:J36')->getFont()->setName('Arial');
                          
                            $sheet->cells('A1:J100', function ($cells) {
                                $cells->setValignment('center');
                                $cells->setFontFamily('Arial');
                            });

                            $sheet->cell('D9:E11', function ($cell) {
                                $cell->setValignment('center');
                            });
                            $sheet->cell('C7', function ($cell) {
                                $cell->setBorder('thin', 'thin', 'thin', 'thin');
                            });
                            $sheet->cell('C9', function ($cell) {
                                $cell->setalignment('center');
                                $cell->setValignment('center');
                                $cell->setBorder('thin', 'thin', 'thin', 'thin');
                            });
                            
                            //set image ttd splem
                            // init drawing
                            if(file_exists("upload/pegawai/$splem->nip/$splem->ttd")){
                                $drawing = new PHPExcel_Worksheet_Drawing();
                                // Set image
                                $drawing->setPath("upload/pegawai/$splem->nip/$splem->ttd");
                                $drawing->setWorksheet($sheet);
                                $drawing->setCoordinates('H'.$baris_data);
                                $drawing->setResizeProportional(false);
                                $drawing->setWidth(120);
                                $drawing->setHeight(90);
                            }

                            $sheet->setHeight($baris_data,90);

                            $sheet->setWidth(array(
                                'A'     =>  1,
                                'B'     =>  1,
                                'C'     =>  6,
                                'D'     =>  12,
                                'E'     =>  12,
                                'F'     =>  25,
                                'G'     =>  10,
                                'H'     =>  8,
                                'I'     =>  10,
                                'J'     =>  8
                            )); 
                        });
                    });
                    $styleArray = array(
                        'font' => array(
                            'name' => 'Arial',
                        ));
                    $excel->getDefaultStyle()
                        ->applyFromArray($styleArray);
                    return $excel->export('xls');
            }
        }
	}

	public function getLog03()
    {
        return view('logistik.admin.log03.index',['show'=>0]);
	}
	
	public function postLog03()
	{
        $data = \Input::all();
        $tgl_mulai=konversi_tanggal($data['tanggal_mulai']);
		$tgl_selesai=konversi_tanggal($data['tanggal_selesai']);
        $materials = [];
        $count = count($materials);
        $getBulan = 0;

        while ($tgl_mulai <= $tgl_selesai) {
            $permintaans = LogPermintaanMaterial::where('tanggal', '=', $tgl_mulai)
                                                ->where('soft_delete', 0)
                                                ->where('is_scarm','!=',0)
                                                ->get();
                                            
            foreach ($permintaans as $key => $permintaan) {
                $getBulan = LaporanController::getWeek($permintaan->tanggal);
                foreach ($permintaan->permintaanDetail as $key => $detail) {
                    if ((array_search($detail->material_id, array_column($materials,'material_id')) === false) && ($detail->soft_delete != 1)) {
                        $materials[$count]['material_id'] = (int)$detail->material_id;
                        $materials[$count]['nama'] = $detail->detailPermintaanMaterial->nama;
                        $materials[$count]['satuan'] = $detail->detailPermintaanMaterial->satuan;
                        $materials[$count]['rencana'] = (int)$detail->volume;
                        $materials[$count]['realisasi'] = 0;
                        $materials[$count]['sesuai'] = 0;
                        $materials[$count]['tidakSesuai'] = 0;
                        $count++;
                    }else{
                        if($detail->soft_delete != 1){
                            $index = array_search($detail->material_id,array_column($materials,'material_id'));
                            $materials[$index]['rencana'] = (int)$materials[$index]['rencana'] + (int)$detail->volume;
                        }
                    }
                }
            }
                    
                    $penerimaans = LogDetailPenerimaanMaterial::where('soft_delete',0)
                                                            ->where('tanggal_terima', '=', $tgl_mulai)
                                                            ->whereHas('penerimaan',function ($q){
                                                              $q->where('is_splem','!=', 0);
                                                            })
                                                            ->get();
                    // var_dump(count($penerimaans).'tgl'.$tgl_mulai);

                    foreach ($penerimaans as $key => $detail) {
                        if(array_search($detail->material_id, array_column($materials,'material_id')) !== false){
                            $index = array_search($detail->material_id, array_column($materials,'material_id'));
                            $materials[$index]['realisasi'] = (int)$materials[$index]['realisasi'] + (int)$detail->vol_saat_ini;                    
                            // var_dump($materials[$index]['realisasi']);
                        }else{
                            $materials[$count]['material_id'] = (int)$detail->material_id;
                            $materials[$count]['nama'] = $detail->material->nama;
                            $materials[$count]['satuan'] = $detail->material->satuan;
                            $materials[$count]['rencana'] = 0;
                            $materials[$count]['realisasi'] = (int)$detail->vol_saat_ini;
                            $materials[$count]['sesuai'] = 0;
                            $materials[$count]['tidakSesuai'] = 0;
                            $count++;
                        }
                    }
                
            $tgl_mulai = date('Y-m-d',strtotime('+1 days',strtotime($tgl_mulai)));
        }
        foreach ($materials as $key => $material) {
            if ($material['rencana'] <= $material['realisasi']) {
                $materials[$key]['sesuai'] = $material['realisasi'] - $material['rencana'];
            }elseif ($material['rencana'] >= $material['realisasi']) {
                $materials[$key]['tidakSesuai'] = $material['rencana'] - $material['realisasi'];
            }
        }        

        $splem = getManagerLaporan('SL',$tgl_mulai);
        $pm = getPMLaporan($tgl_mulai);

        if(!isset($data['proses'])){
            $data['proses'] = 0;
        }
        if(!isset($data['unduh'])){
            $data['unduh'] = 0;
        }

        if($data['proses'] == 1){
                return view('logistik.admin.log03.index', ['dataInput'=>$getBulan, 'data' => $materials, 'pm' => $pm, 'splem' => $splem, 'show'=>1]);

        }elseif($data['unduh'] == 1){
            if(count($materials)!= 0){

            	$excel = \Excel::create("Form Log-03 Laporan Evaluasi Mingguan Pengadaan Bahan", function ($excel) use ($materials, $pm, $splem, $data, $getBulan) {

                        $excel->sheet('New sheet', function ($sheet) use ($materials, $pm, $splem, $data, $getBulan) {

                            $sheet->loadView('logistik.admin.log03.unduh', ['data' => $materials, 'pm' => $pm, 'splem' => $splem, 'dataInput' => $getBulan]);
                            $objDrawing = new PHPExcel_Worksheet_Drawing;
                            $objDrawing->setPath(public_path('img/Waskita.png'));
                            $objDrawing->setCoordinates('C1');
                            $objDrawing->setWorksheet($sheet);
                            $objDrawing->setResizeProportional(false);
                            // set width later
                            $objDrawing->setWidth(40);
                            $objDrawing->setHeight(35);
                            $sheet->getStyle('C1')->getAlignment()->setIndent(1);

                            $sheet->getStyle('A13:J63')->getAlignment()->setWrapText(true);
                            $sheet->getStyle('A2:J36')->getFont()->setName('Tahoma');
                            $sheet->getStyle('A13:J15')->getAlignment()->applyFromArray(
                                array('horizontal' => 'center')
                            );
                            $sheet->cells('A9:J11', function ($cells) {
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
	}
}

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

	public function getLog07()
    {
        $jeniss = LogJenis::where('soft_delete',0)->get();
        $lokasis = LogLokasi::where('soft_delete',0)->get();

        return view('logistik.admin.log07.index',['jeniss'=>$jeniss,'lokasis'=>$lokasis]);
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
                        $dt = LogPengajuanMaterial::where('tanggal', $tanggal_mulai)
                                                    ->where('soft_delete',0)
                                                    ->where('jenis_pekerjaan_id',$data['jenis']->id)
                                                    ->where('lokasi_kerja_id',$data['lokasi']->id)
                                                    ->get();
                        
                        foreach ($dt as $key => $value) {
                           $dt_detail  = LogDetailPengajuanMaterial::whereHas('detailPengajuan',function ($q) use($tanggal_mulai){
                              $q->where('tanggal', $tanggal_mulai);
                            })->where('material_id',$detail->material_id)->where('soft_delete',0)->get();

                           $dt_detail_lalu  = LogDetailPengajuanMaterial::whereHas('detailPengajuan',function ($q) use($bulan_lalu,$tahun){
                              $q->whereMonth('tanggal', $bulan_lalu)
                                ->whereYear('tanggal',$tahun);
                            })->where('material_id',$detail->material_id)->where('soft_delete',0)->get();

                           foreach ($dt_detail as $key => $dtl) {
                               $jumlah = $jumlah + $dtl->pemyerahan_jumlah;
                           }
                           $jumlah_lalu = 0;
                           foreach ($dt_detail_lalu as $key => $dtl_lalu) {
                               $jumlah_lalu = $jumlah_lalu + $dtl_lalu->pemyerahan_jumlah;
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


        $splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
        $admin = Pegawai::where('posisi_id', \Auth::user()->pegawai->posisi_id)->where('soft_delete', 0)->first();
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
            $excel->getActiveSheet()->getRowDimension('54')->setRowHeight(5);
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
	
	public function getLog02()
    {
        $namaBulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
		$idBulan = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		$getMaterial = LogMaterial::where('soft_delete', 0)->get();

        return view('logistik.admin.log02.index', ['bln' => $namaBulan, 'idBln' => $idBulan, 'materials' => $getMaterial]);
	}
	
	public function postLog02()
	{
		$data = \Input::all();
    	$data['tanggal_mulai'] = $data['tahun'].'-'.$data['bulan'].'-01';
		$data['tanggal_selesai'] = $data['tahun'].'-'.$data['bulan'].'-31';
		$bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");

		for ($i=01; $i <= 12; $i++) { 
			if ($i == $data['bulan']) {
				$getBulan = $bulan[$i];
			break;
			}
		}

		$getMaterial = LogMaterial::select('nama')
									->where('id', $data['material'])
									->where('soft_delete', 0)
									->get();
		$dt = [];
        $trs_keluar = 0;
        $trs_terima = 0;
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
                                                                ->whereHas('penerimaan',function ($q) use($data,$tgl){
                                                                    $q->where('tanggal','=',$data['tahun'].'-'.$data['bulan'].'-'.$tgl);
                                                                })->get();
				if(count($penerimaanDetails) != 0){
    				foreach ($penerimaanDetails as $key => $value) {				
    					$dt[$i]['jml_terima'] = $dt[$i]['jml_terima'] + $value->vol_saat_ini;
    					$trs_terima = $trs_terima + $dt[$i]['jml_terima'];
                        $dt[$i]['trs_terima'] = $trs_terima;
    				}
                }else{
                    $dt[$i]['trs_terima'] = $trs_terima;
                }
			
				$pengajuanDetails = LogDetailPengajuanPakai::where('material_id',$data['material'])
																->where('soft_delete',0)
																->whereHas('pengajuan',function ($q) use($data,$tgl){
                                                                    $q->where('tanggal','=',$data['tahun'].'-'.$data['bulan'].'-'.$tgl);
                                                                })->get();
				if (count($pengajuanDetails) != 0) {					
					foreach ($pengajuanDetails as $key => $value) {
						$dt[$i]['jml_keluar'] = $dt[$i]['jml_keluar'] + $value->permintaan_jumlah;
                        $trs_keluar = $trs_keluar + $dt[$i]['jml_keluar'];
						$dt[$i]['trs_keluar'] = $trs_keluar;
					}
				}else{
                    $dt[$i]['trs_keluar'] = $trs_keluar;
                }

			$dt[$i]['sisa'] = $dt[$i]['trs_terima'] - $dt[$i]['trs_keluar'];
		}	

		$splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
    	$excel = \Excel::create("Form Log-02 Laporan Kartu Gudang " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($getBulan, $getMaterial, $dt,$splem) {

                $excel->sheet('New sheet', function ($sheet) use ($getBulan, $getMaterial, $dt,$splem) {

                    $sheet->loadView('logistik.admin.log02.unduh', ['data' => $dt, 'bulan' => $getBulan, 'material' => $getMaterial, 'splem' => $splem]);
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

	public function getLog05()
    {
        return view('logistik.admin.log05.index');
	}
	
	public function postLog05()
	{		
		$data = \Input::all();
		$tgl_mulai=konversi_tanggal($data['tanggal_mulai']);
		$tgl_selesai=konversi_tanggal($data['tanggal_selesai']);
		$dt = [];
		$i = 1;
		
		while($tgl_mulai <= $tgl_selesai){				
			$dt[$i]['material'] = '';
			$dt[$i]['satuan'] = '';
			$dt[$i]['tanggal'] = '';
			$dt[$i]['jml_terima'] = 0;
			$dt[$i]['jml_keluar'] = 0;	
			
			$dt[$i]['tanggal'] = $tgl_mulai;
			
			$penerimaans = LogPenerimaanMaterial::where('tanggal','=',$tgl_mulai)
											->where('soft_delete',0)
											->get();
			
			foreach ($penerimaans as $key => $penerimaan) {
				$penerimaanDetails = LogDetailPenerimaanMaterial::where('penerimaan_id', $penerimaan->id)
																->where('soft_delete',0)
																->get();
				
				foreach ($penerimaanDetails as $key => $value) {					
					$dt[$i][$tgl_mulai]['material'] = $value->material->nama;
					$dt[$i][$tgl_mulai]['satuan'] = $value->material->satuan;
					$dt[$i][$tgl_mulai]['jml_terima'] = $dt[$i]['jml_terima'] + $value->volume;
				}
			}
			

			$pengajuans = LogPengajuanMaterial::where('tanggal','=',date('Y-m-d',strtotime($tgl_mulai)))
											->where('soft_delete',0)
											->get();
												
			foreach ($pengajuans as $key => $pengajuan) {
				$pengajuanDetails = LogDetailPengajuanPakai::where('pengajuan_id', $pengajuan->id)
															->where('soft_delete',0)
															->get();
				if ($pengajuanDetails) {					
					foreach ($pengajuanDetails as $key => $value) {
						$dt[$i][$tgl_mulai]['material'] = $value->material->nama;
						$dt[$i][$tgl_mulai]['satuan'] = $value->material->satuan;
						$dt[$i][$tgl_mulai]['jml_keluar'] = $dt[$i]['jml_keluar'] + $value->permintaan_jumlah;
					}
				}
			}
			
			$i++;
			$tgl_mulai = date('Y-m-d',strtotime('+1 days',strtotime($tgl_mulai)));
		}
        dd($dt);
	

		$splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
    	$excel = \Excel::create("Form Log-05 Laporan Harian Gudang " . konversi_tanggal($data['tanggal_mulai']) . "- " . konversi_tanggal($data['tanggal_selesai']), function ($excel) use ($dt, $splem) {

                $excel->sheet('New sheet', function ($sheet) use ($dt, $splem) {

                    $sheet->loadView('logistik.admin.log05.unduh', ['data' => $dt, 'splem' => $splem]);
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

	public function getLog03()
    {
        return view('logistik.admin.log03.index');
	}
	
	public function postLog03()
	{
        $data = \Input::all();
        $tgl_mulai=konversi_tanggal($data['tanggal_mulai']);
		$tgl_selesai=konversi_tanggal($data['tanggal_selesai']);
        $materials = [];
        $count = count($materials);

        while ($tgl_mulai <= $tgl_selesai) {
            $permintaans = LogPermintaanMaterial::where('tanggal', '=', $tgl_mulai)
                                                ->where('soft_delete', 0)
                                                ->get();
                                            
            foreach ($permintaans as $key => $permintaan) {
                foreach ($permintaan->permintaanDetail as $key => $detail) {
                    if (array_search($detail->material_id, array_column($materials,'material_id')) === false) {
                        $materials[$count]['material_id'] = (int)$detail->material_id;
                        $materials[$count]['nama'] = $detail->detailPermintaanMaterial->nama;
                        $materials[$count]['satuan'] = $detail->detailPermintaanMaterial->satuan;
                        $materials[$count]['rencana'] = (int)$detail->volume;
                        $materials[$count]['realisasi'] = 0;
                        $materials[$count]['sesuai'] = 0;
                        $materials[$count]['tidakSesuai'] = 0;
                        $count++;
                    }else{
                        $index = array_search($detail->material_id,array_column($materials,'material_id'));
                        $materials[$index]['rencana'] = (int)$materials[$index]['rencana'] + (int)$detail->volume;
                    }
                }            
            }

            foreach ($materials as $key => $material) {
                $penerimaans = LogDetailPenerimaanMaterial::where('material_id',$material['material_id'])
                                                        ->where('soft_delete',0)
                                                        ->get();

                foreach ($penerimaans as $key => $detail) {
                    if(array_search($detail->material_id, array_column($materials,'material_id')) !== false){
                        $index = array_search($detail->material_id, array_column($materials,'material_id'));
                        $materials[$index]['realisasi'] = (int)$materials[$index]['realisasi'] + (int)$detail->vol_saat_ini;                    
                    }
                }
            }

            // if ($materials[$index]['rencana'] <= $materials[$index]['realisasi']) {
            //     $materials[$index]['sesuai'] = $materials[$index]['realisasi'] - $materials[$index]['rencana'];
            // }elseif ($materials[$index]['rencana'] >= $materials[$index]['realisasi']) {
            //     $materials[$index]['sesuai'] = $materials[$index]['rencana'] - $materials[$index]['realisasi'];
            // }

            $tgl_mulai = date('Y-m-d',strtotime('+1 days',strtotime($tgl_mulai)));
        }

        dd($materials);
        

		// $pm = Pegawai::where('posisi_id', 1)->where('soft_delete', 0)->first();
		// $splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
    	// $excel = \Excel::create("Form Log-03 Laporan Evaluasi Mingguan Pengadaan Bahan", function ($excel) use ($materials, $pm, $splem) {

        //         $excel->sheet('New sheet', function ($sheet) use ($materials, $pm, $splem) {

        //             $sheet->loadView('logistik.admin.log03.unduh', ['data' => $materials, 'pm' => $pm, 'splem' => $splem]);
        //             $objDrawing = new PHPExcel_Worksheet_Drawing;
        //             $objDrawing->setPath(public_path('img/Waskita.png'));
        //             $objDrawing->setCoordinates('C1');
        //             $objDrawing->setWorksheet($sheet);
        //             $objDrawing->setResizeProportional(false);
        //             // set width later
        //             $objDrawing->setWidth(40);
        //             $objDrawing->setHeight(35);
        //             $sheet->getStyle('C1')->getAlignment()->setIndent(1);

        //             $sheet->getStyle('A13:N63')->getAlignment()->setWrapText(true);
        //             $sheet->getStyle('A2:O36')->getFont()->setName('Tahoma');
        //             $sheet->getStyle('A13:N15')->getAlignment()->applyFromArray(
        //                 array('horizontal' => 'center')
        //             );
        //             $sheet->cells('A9:M11', function ($cells) {
        //                 $cells->setValignment('center');
        //                 $cells->setFontFamily('Tahoma');
        //             });

        //             $sheet->cell('D9:E11', function ($cell) {
        //                 $cell->setValignment('center');
        //             });
        //             $sheet->cell('D8:E8', function ($cell) {
        //                 $cell->setBorder('', '', 'thin', '');
        //             });
        //             $sheet->cell('C4', function ($cell) {
        //                 $cell->setBorder('thin', 'thin', 'thin', 'thin');
        //             });
        //             $sheet->cell('C6', function ($cell) {
        //                 $cell->setalignment('center');
        //                 $cell->setValignment('center');
        //                 $cell->setBorder('thin', 'thin', 'thin', 'thin');
        //             });
        //             // $sheet->cell('B14:E14', function($cell){
        //             //     $cell->setBorder('','','','thin');
        //             // });
        //         });
        //     });
        //     $styleArray = array(
        //         'font' => array(
        //             'name' => 'Tahoma',
        //         ));
        //     $excel->getDefaultStyle()
        //         ->applyFromArray($styleArray);
        //     return $excel->export('xls');
	}
}

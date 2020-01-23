<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rkp;
use App\Posisi;
use App\DetailRkp;
use App\Pegawai;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;


class RkpController extends Controller
{
    public function index()
    {
    	$rkps = Rkp::where('soft_delete',0)->get();
        return view('manager.rkp.index',['rkps'=>$rkps]);
    }
    
    public function getCreate()
    {
        if(\Auth::user()->pegawai->kode_bagian == 'SA'){
            $posisi = Posisi::where('soft_delete',0)->get();
        }else{
            $posisi = Posisi::where('soft_delete',0)->where('kode',\Auth::user()->pegawai->kode_bagian)->get();
        }
        return view('manager.rkp.create',['posisi'=>$posisi]);
    }

    public function postCreate()
    {
        date_default_timezone_set("Asia/Jakarta");
    	$jml = \Input::get('jumlah_data');

        $unit_kerja = \Input::get('unit_kerja');
        $kebutuhan = \Input::get('kebutuhan');
        $tersedia = \Input::get('tersedia');
        $kurang_lebih = \Input::get('kurang_lebih');
        $masuk = \Input::get('masuk');
        $keluar = \Input::get('keluar');
        $jumlah = \Input::get('jumlah');
        $rekrut = \Input::get('rekrut');
    	$posisi = \Input::get('unit_kerja');
        $tugas = \Input::get('tugas');
        $pendidikan = \Input::get('pendidikan');
        $tahun_kerja = \Input::get('tahun_kerja');
        $jenis_kerja = \Input::get('jenis_kerja');
        $tpa = \Input::get('tpa');
        $ept = \Input::get('ept');
        $butuh = \Input::get('butuh');
        $waktu = \Input::get('waktu');

        $rkp = new Rkp;
        $rkp->kode_bagian = \Auth::user()->pegawai->kode_bagian;
        $rkp->tanggal = date('Y-m-d');
        $rkp->soft_delete = 0;
        $rkp->user_id = \Auth::user()->id;
        $rkp->role_id = \Auth::user()->role_id;
        $rkp->is_verif_pm = 0;

        if($rkp->save()){
        	$id_rkp = $rkp->id;
        	for($i=0;$i< $jml;$i++){
                $data = new DetailRkp;

	        	$data->id_rkp= $id_rkp;
                $data->unit_kerja= $unit_kerja[$i];
                $data->kebutuhan= $kebutuhan[$i];
                $data->tersedia= $tersedia[$i];
                $data->kurang_lebih= $kurang_lebih[$i];
                $data->masuk= $masuk[$i];
                $data->keluar= $keluar[$i];
                $data->jumlah= $jumlah[$i];
                $data->rekrut= $rekrut[$i];
	        	$data->jabatan= $posisi[$i];
	        	$data->tugas= $tugas[$i];
	        	$data->pendidikan= $pendidikan[$i];
	        	$data->tahun_kerja= $tahun_kerja[$i];
	        	$data->jenis_kerja= $jenis_kerja[$i];
	        	$data->TPA= $tpa[$i];
	        	$data->EPT= $ept[$i];
	        	$data->jumlah_kurang= $butuh[$i];
	        	$data->waktu_penempatan= $waktu[$i];
	        	$data->soft_delete= 0;
                $data->user_id = \Auth::user()->id;
                $data->role_id = \Auth::user()->role_id;
	        	
	        	if($data->save()){
                    $simpan = 1;
                }else{
                    $simpan = 0;
                    die();
                }
	        }
            return redirect('manager/rkp');
        }

        
    }

    public function getForm1($id)
    {
        $rkp = Rkp::find($id);
        //updated viewed_at, ter-update hanya kalau dilihat admin
        if(\Auth::user()->role_id == 1){
            date_default_timezone_set("Asia/Jakarta");
            $now = date('Y-m-d H:i:s');
            $updt = Rkp::where('id',$id)->update(['viewed_at'=>$now]);
        }
        //----------------------
        $dt_rkp = DetailRkp::where('id_rkp',$id)->where('soft_delete',0)->get();
        $pm = Pegawai::where('posisi_id',1)->where('soft_delete',0)->first();
        switch ($rkp->kode_bagian) {
            case 'SE':
                $kode = 4;
                break;
            case 'SC':
                $kode = 5;
                break;
            case 'SA':
                $kode = 6;
                break;
            case 'SL':
                $kode = 7;
                break;  
            case 'SO':
                $kode = 8;
                break;
            case 'QHSE':
                $kode = 42;
                break;
            default:
                # code...
                break;
        }
        $manager = Pegawai::where('posisi_id',$kode)->where('soft_delete',0)->first();
        
        $excel = \Excel::create('Form01_Rencana_Kebutuhan_Pegawai', function($excel) use ($rkp,$dt_rkp,$pm,$manager) {

                    $excel->sheet('New sheet', function($sheet) use ($rkp,$dt_rkp,$pm,$manager) {

                        $sheet->loadView('manager.rkp.form1',['rkp' => $rkp,'dt_rkp'=>$dt_rkp,'pm'=>$pm,'manager'=>$manager]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('C1');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(40);
                        $objDrawing->setHeight(35);
                        $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                        $sheet->getStyle('A9:P11')->getAlignment()->setWrapText(true);
                        $sheet->getStyle('A9:P11')->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                        );
                        $sheet->cells('A9:M11', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                        });
                        
                        $sheet->cell('D9:E11', function($cell){
                            $cell->setValignment('center');
                        });
                        $sheet->cell('D8:E8', function($cell){
                            $cell->setBorder('','','thin','');
                        });
                        $sheet->cell('K2:M2', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('K3:M3', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('N2:N3', function($cell){
                            $cell->setBorder('','','','thin');
                        });
                        $sheet->cell('D4', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('D5', function($cell){
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
                return $excel->export('xls');     
    }

    public function getForm2($id)
    {
        $rkp = Rkp::find($id);
        //updated viewed_a
        if(\Auth::user()->role_id == 1){
            date_default_timezone_set("Asia/Jakarta");
            $now = date('Y-m-d H:i:s');
            $updt = Rkp::where('id',$id)->update(['viewed_at'=>$now]);
        }
        //----------------------
        $dt_rkp = DetailRkp::where('id_rkp',$id)->where('soft_delete',0)->get();
        $pm = Pegawai::where('posisi_id',1)->where('soft_delete',0)->first();
        switch ($rkp->kode_bagian) {
            case 'SE':
                $kode = 4;
                break;
            case 'SC':
                $kode = 5;
                break;
            case 'SA':
                $kode = 6;
                break;
            case 'SL':
                $kode = 7;
                break;  
            case 'SO':
                $kode = 8;
                break;
            case 'QHSE':
                $kode = 42;
                break;
            default:
                # code...
                break;
        }
        $manager = Pegawai::where('posisi_id',$kode)->where('soft_delete',0)->first();
        

        $excel = \Excel::create('Form02_Rencana_Kebutuhan_Pegawai', function($excel) use ($rkp,$dt_rkp,$pm,$manager) {

                    $excel->sheet('New sheet', function($sheet) use ($rkp,$dt_rkp,$pm,$manager) {

                        $sheet->loadView('manager.rkp.form2',['rkp' => $rkp,'dt_rkp'=>$dt_rkp,'pm'=>$pm,'manager'=>$manager]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('C1');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(40);
                        $objDrawing->setHeight(35);
                        $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                        $sheet->getStyle('A11:P13')->getAlignment()->setWrapText(true);
                        $sheet->getStyle('A11:P13')->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                        );
                        $sheet->cells('A11:O14', function ($cells) {
                            $cells->setalignment('center');
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                            $cells->setFontWeight('bold');
                        });
                        
                        $sheet->cell('C8:O9', function($cell){
                            $cell->setBorder('thick','thick','thick','thick');
                        });
                        $sheet->cell('P8:P9', function($cell){
                            $cell->setBorder('','','','thick');
                        });

                        $sheet->cell('D11:E13', function($cell){
                            $cell->setValignment('center');
                        });
                        $sheet->cell('D10:E10', function($cell){
                            $cell->setBorder('','','thin','');
                        });
                        
                        $sheet->cell('M2:M3', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('N2:N3', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('D4', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        $sheet->cell('D6', function($cell){
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
                return $excel->export('xls');     
    }

     public function getDelete(){
      $data = \Input::all();
      $del = Rkp::where('id',$data['id_rkp'])->update(['soft_delete'=>1]);
      $del2 = DetailRkp::where('id_rkp',$data['id_rkp'])->update(['soft_delete'=>1]);

      if($del && $del2){
        return redirect('manager/rkp');
      }

    }
}

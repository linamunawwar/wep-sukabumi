<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rkp;
use App\Posisi;
use App\DetailRkp;
use PHPExcel_Worksheet_Drawing;


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
        $dt_rkp = DetailRkp::where('id_rkp',$id)->where('soft_delete',0)->get();
        $excel = \Excel::create('Form01_Rencana_Kebutuhan_Pegawai', function($excel) use ($rkp,$dt_rkp) {

                    $excel->sheet('New sheet', function($sheet) use ($rkp,$dt_rkp) {

                        $sheet->loadView('manager.rkp.form1',['rkp' => $rkp,'dt_rkp'=>$dt_rkp]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('C1');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(40);
                        $objDrawing->setHeight(35);
                        $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                        $sheet->getStyle('A13:P14')->getAlignment()->setWrapText(true);
                        $sheet->getStyle('A13:P14')->getAlignment()->applyFromArray(
                            array('horizontal' => 'center')
                        );
                        $sheet->cells('A10:P10', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cells('A12:P14', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                        });
                        $sheet->cells('A15:P15', function ($cells) {
                            $cells->setValignment('center');
                            $cells->setFontFamily('Arial');
                            $cells->setFontWeight('bold');
                        });
                        $sheet->cell('B13:E13', function($cell){
                            $cell->setBorder('','thin','','');
                        });
                        $sheet->cell('D4:D5', function($cell){
                            $cell->setBorder('thin','thin','thin','thin');
                        });
                        // $sheet->cell('B14:E14', function($cell){
                        //     $cell->setBorder('','','','thin');
                        // });
                    });
                });
                return $excel->export('xls');     
    }

     
}

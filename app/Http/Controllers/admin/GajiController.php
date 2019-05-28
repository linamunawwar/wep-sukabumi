<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPExcel_Worksheet_Drawing;
use App\Gaji;
use App\SlipGaji;
use App\Pegawai;

class GajiController extends Controller
{
    public function index()
    {
    	$gajis = Gaji::whereHas('pegawai',function ($q){
	            $q->where('is_active', 1);
	        })->get();

        return view('admin.gaji.index', ['gajis'=>$gajis]);
    }

    public function getListTransfer()
    {
        return view('admin.gaji.list_transfer');
    }

    public function getEdit($id)
    {
        $gaji = Gaji::find($id);
        return view('admin.gaji.edit',['gaji'=>$gaji]);
    }

    public function postEdit($id){
        $data = \Input::all();

        $find_gaji = Gaji::where('id',$id)->first();

       if($find_gaji){
           $gaji['gaji_pokok'] = $data['gaji_pokok'];
           $gaji['tunj_komunikasi'] = $data['tunj_komunikasi'];
           $gaji['tunj_transportasi'] = $data['tunj_transportasi'];
           $gaji['uang_makan'] = $data['uang_makan'];
           $gaji['tunj_pph21'] = $data['tunj_pph21'];
           $gaji['pph21'] = $data['pph21'];
           $gaji['user_id'] = \Auth::user()->id;
           $gaji['role_id'] = \Auth::user()->role_id;
            $update_gaji = Gaji::where('id',$id)->update($gaji);

            return redirect('/admin/gaji');
        }
    }

    public function slipGaji()
    {
        $slip_gajis = SlipGaji::where('soft_delete',0)->get();

        return view('admin.gaji.index_slip',['slip_gajis'=>$slip_gajis]);
    }

    public function getSlipGajiCreate()
    {
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('admin.gaji.create_slip',['pegawais'=>$pegawais]);
    }

    public function postSlipGajiCreate(){
        $data = \Input::all();
        
        $slip_gaji = new SlipGaji;
        $slip_gaji->nip = $data['nip'];
        $slip_gaji->bulan = $data['bulan'];
        $slip_gaji->tahun = $data['tahun'];
        $slip_gaji->keperluan = $data['keperluan'];
        $slip_gaji->user_id = \Auth::user()->id;
        $slip_gaji->role_id = \Auth::user()->role_id;
        
        $slip_gaji->save();

        return redirect('/admin/gaji/slip_gaji');
    }

    public function getSlipGajiUnduh($id)
    {
        $slip = SlipGaji::find($id);
        Switch ($slip->bulan){
             case '01' : $tanggal="Januari";
             Break;
             case '02' : $tanggal="Februari";
             Break;
             case '03' : $tanggal="Maret";
             Break;
             case '04' : $tanggal="April";
             Break;
             case '05' : $tanggal="Mei";
             Break;
             case '06' : $tanggal="Juni";
             Break;
             case '07' : $tanggal="Juli";
             Break;
             case '08' : $tanggal="Agustus";
             Break;
             case '09' : $tanggal="September";
             Break;
             case '10' : $tanggal="Oktober";
             Break;
             case '11' : $tanggal="November";
             Break;
             case '12' : $tanggal="Desember";
             Break;
        }  
        $periode = $tanggal.' '.$slip->tahun ;         
        $excel = \Excel::create('Slip Gaji_'.$slip->nip, function($excel) use ($slip,$periode) {

                    $excel->sheet('New sheet', function($sheet) use ($slip, $periode) {

                        $sheet->loadView('admin.gaji.unduh_slip',['slip' => $slip,'periode'=>$periode]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/Waskita.png'));
                        $objDrawing->setCoordinates('E6');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(2);
                        $objDrawing->setHeight(50);
                      
                        $sheet->cell('D21:K21', function($cell){
                            $cell->setBorder('thin','','','');
                        });
                        $sheet->cell('D27:K27', function($cell){
                            $cell->setBorder('thin','','','');
                        });
                        $sheet->cell('D30:K30', function($cell){
                            $cell->setBorder('double','','','');
                        });
                        $sheet->cell('D31:K31', function($cell){
                            $cell->setBorder('thin','','','');
                        });
                        //border atas
                        $sheet->cell('D5:K6', function($cell){
                            $cell->setBorder('thin','','','');
                        });
                        //border bawah
                        $sheet->cell('D40:K41', function($cell){
                            $cell->setBorder('','','thin','');
                        });
                        //border kanan
                        $sheet->cell('C5:C41', function($cell){
                            $cell->setBorder('','thin','','');
                        });
                        //border kiri
                        $sheet->cell('L5:L41', function($cell){
                            $cell->setBorder('','','','thin');
                        }); 
                    });
                });
                return $excel->export('xls');
    }
}

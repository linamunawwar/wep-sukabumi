<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use PHPExcel_Worksheet_Drawing;
use App\Disposisi;
use App\DisposisiTugas;
use App\SuratMasuk;

class DisposisiController extends Controller
{
    public function indexSuratMasuk()
    {
    	$surats = SuratMasuk::where('soft_delete',0)->get();

        return view('admin.disposisi.surat_masuk.index',['surats'=>$surats]);
    }

    public function getCreateSuratMasuk()
    {
        return view('admin.disposisi.surat_masuk.create');
    }

    public function postCreateSuratMasuk(Request $request)
    {
    	$file = $request->file('file_surat');

    	$data = \Input::all();

    	$surat = new SuratMasuk;
    	$surat->no_surat = $data['no_surat'];
    	$surat->pengirim = $data['pengirim'];
    	$surat->kepada = $data['kepada'];
    	$surat->tanggal_surat = konversi_tanggal($data['tanggal_surat']);
    	$surat->perihal = $data['perihal'];
    	$surat->file_surat = $data['file_surat'];
    	$surat->user_id = \Auth::user()->id;
      	$surat->role_id = \Auth::user()->role_id;

    	$surat->save();

        return redirect('admin/surat_masuk');
    }

     public function getEditSuratMasuk($id)
    {
    	$surat = SuratMasuk::find($id);

        return view('admin.disposisi.surat_masuk.edit',['surat'=>$surat]);
    }

    public function postEditSuratMasuk($id)
    {

    	$data = \Input::all();

    	$surat['no_surat'] = $data['no_surat'];
    	$surat['pengirim'] = $data['pengirim'];
    	$surat['kepada'] = $data['kepada'];
    	$surat['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
    	$surat['perihal'] = $data['perihal'];
    	$surat['file_surat'] = $data['file_surat'];

    	$surat['user_id'] = \Auth::user()->id;
      	$surat['role_id'] = \Auth::user()->role_id;

    	$update = SuratMasuk::where('id',$id)->update($surat);

        return redirect('admin/surat_masuk');
    }

    public function getDeleteSuratMasuk($id)
    {
    	$update = SuratMasuk::where('id',$id)->update(['soft_delete'=>1]);

        return redirect('admin/surat_masuk');
    }



    public function index()
    {
    	$disposisis = Disposisi::where('soft_delete',0)->get();

        return view('admin.disposisi.index',['disposisis'=>$disposisis]);
    }

    public function getCreate()
    {
        return view('admin.disposisi.create');
    }

    public function postCreate()
    {
    	$data = \Input::all();

    	$disposisi = new Disposisi;
    	$disposisi->no_agenda = $data['no_agenda'];
    	$disposisi->pengirim = $data['pengirim'];
    	$disposisi->kepada = $data['kepada'];
    	$disposisi->tanggal_terima = konversi_tanggal($data['tanggal_terima']);
    	$disposisi->tanggal_surat = konversi_tanggal($data['tanggal_surat']);
    	$disposisi->no_surat = $data['no_surat'];
    	$disposisi->perihal = $data['perihal'];
    	$disposisi->sifat = $data['sifat'];
    	$disposisi->user_id = \Auth::user()->id;
      	$disposisi->role_id = \Auth::user()->role_id;

      	$disposisi->save();

        return redirect('admin/disposisi');
    }

    public function getEdit($id)
    {
    	$disposisi = Disposisi::find($id);

        return view('admin.disposisi.edit',['disposisi'=>$disposisi]);
    }

    public function postEdit($id)
    {
    	$data = \Input::all();

    	$disposisi['no_agenda'] = $data['no_agenda'];
    	$disposisi['pengirim'] = $data['pengirim'];
    	$disposisi['kepada'] = $data['kepada'];
    	$disposisi['tanggal_terima'] = konversi_tanggal($data['tanggal_terima']);
    	$disposisi['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
    	$disposisi['no_surat'] = $data['no_surat'];
    	$disposisi['perihal'] = $data['perihal'];
    	$disposisi['sifat'] = $data['sifat'];
    	$disposisi['user_id'] = \Auth::user()->id;
      	$disposisi['role_id'] = \Auth::user()->role_id;

      	$update = Disposisi::where('id',$id)->update($disposisi);

        return redirect('admin/disposisi');
    }

    public function getDelete($id)
    {
    	$update = Disposisi::where('id',$id)->update(['soft_delete'=>1]);

        return redirect('admin/disposisi');
    }


    public function monitoring($id)
    {
    	$disposisi = Disposisi::find($id);
    	$tugass = DisposisiTugas::where('disposisi_id',$id)->where('soft_delete',0)->get();
    	
    	foreach ($tugass as $key => $tugas) {

    		if($tugas->tugas == 'Diketahui'){
    			$diketahui['posisi_id'] = $tugas->posisi_id;
    			$diketahui['status'] = $tugas->status;
    		}

    		if($tugas->tugas == 'Diselesaikan'){
    			$diselesaikan['posisi_id'] = $tugas->posisi_id;
    			$diselesaikan['status'] = $tugas->status;
    		}

    		if($tugas->tugas == 'Diproses'){
    			$diproses['posisi_id'] = $tugas->posisi_id;
    			$diproses['status'] = $tugas->status;
    		}
    		
    		if($tugas->tugas == 'Diperiksa'){
    			$diperiksa['posisi_id'] = $tugas->posisi_id;
    			$diperiksa['status'] = $tugas->status;
    		}
    	}

        return view('admin.disposisi.monitoring',['disposisi'=>$disposisi,'diketahui'=>$diketahui,'diselesaikan'=>$diselesaikan,'diproses'=>$diproses,'diperiksa'=>$diperiksa]);
    }

    public function getUnduhDisposisi($id)
    {
        $disposisi = Disposisi::find($id);
        $excel = \Excel::create('Disposisi_'.$disposisi->nip, function($excel) use ($disposisi) {

                    $excel->sheet('New sheet', function($sheet) use ($disposisi) {

                        $sheet->loadView('admin.disposisi.unduh',['disposisi' => $disposisi]);
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('img/kop.PNG'));
                        $objDrawing->setCoordinates('E6');
                        $objDrawing->setWorksheet($sheet);
                        $objDrawing->setResizeProportional(false);
                        // set width later
                        $objDrawing->setWidth(200);
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

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use PDF;
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
        $surats = SuratMasuk::where('soft_delete',0)->get();

        return view('admin.disposisi.create',['surats'=>$surats]);
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

        $pdf = PDF::loadView('admin.disposisi.unduh',['disposisi' => $disposisi, 'diketahui'=>$diketahui,'diselesaikan'=>$diselesaikan,'diproses'=>$diproses,'diperiksa'=>$diperiksa]);
        $pdf->setPaper('legal', 'portrait');
        return $pdf->download('Disposisi_'.$disposisi->no_agenda.'.pdf');
        
    }
}

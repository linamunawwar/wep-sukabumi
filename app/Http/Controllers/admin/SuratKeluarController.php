<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
    	$surats = SuratKeluar::where('soft_delete',0)->get();

        return view('admin.surat_keluar.index',['surats'=>$surats]);
    }

    public function getCreate()
    {
        return view('admin.surat_keluar.create');
    }

    public function postCreate(Request $request)
    {
    	$file = $request->file('file_surat');

    	$data = \Input::all();

        if(\Input::hasfile('file_surat')){
            // $dt_lama = SuratMasuk::where('no_surat', $find_dispo->no_surat)->first();
            // if(file_exists('upload/surat_masuk/'.$dt_lama->file_surat)){
            //     unlink('upload/surat_masuk/'.$dt_lama->file_surat);
            // }

            $ori_file  = \Request::file('file_surat');
            $tujuan = "upload/surat_keluar/";
            $ekstension = $ori_file->getClientOriginalExtension();
            $name = $ori_file->getClientOriginalName();

            $nama_file = $data['kepada'].'_'.$name;
            $ori_file->move($tujuan,$nama_file);

            $surat['file_surat'] = $nama_file;
        }

    	$surat = new SuratKeluar;
    	$surat->no_surat = $data['no_surat'];
    	$surat->pengirim = $data['pengirim'];
        $surat->kepada = $data['kepada'];
    	$surat->kategori = $data['kategori'];
    	$surat->tanggal_surat = konversi_tanggal($data['tanggal_surat']);
    	$surat->perihal = $data['perihal'];
    	$surat->file_surat = $nama_file;
    	$surat->user_id = \Auth::user()->id;
      	$surat->role_id = \Auth::user()->role_id;

    	$surat->save();

        return redirect('admin/surat_keluar');
    }

     public function getEdit($id)
    {
    	$surat = SuratKeluar::find($id);

        return view('admin.surat_keluar.edit',['surat'=>$surat]);
    }

    public function postEdit($id)
    {

    	$data = \Input::all();
        if(\Input::hasfile('file_surat')){
            $dt_lama = SuratKeluar::find($id);
            if(file_exists('upload/surat_keluar/'.$dt_lama->file_surat)){
                unlink('upload/surat_keluar/'.$dt_lama->file_surat);
            }

            $ori_file  = \Request::file('file_surat');
            $tujuan = "upload/surat_keluar/";
            $ekstension = $ori_file->getClientOriginalExtension();
            $name = $ori_file->getClientOriginalName();

            $nama_file = $data['kepada'].'_'.$name;
            $ori_file->move($tujuan,$nama_file);

            $surat['file_surat'] = $nama_file;
        }

    	$surat['no_surat'] = $data['no_surat'];
    	$surat['pengirim'] = $data['pengirim'];
    	$surat['kepada'] = $data['kepada'];
        $surat['kepada'] = $data['kepada'];
    	$surat['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
    	$surat['perihal'] = $data['perihal'];
    	$surat['file_surat'] = $nama_file;

    	$surat['user_id'] = \Auth::user()->id;
      	$surat['role_id'] = \Auth::user()->role_id;

    	$update = SuratKeluar::where('id',$id)->update($surat);

        return redirect('admin/surat_keluar');
    }

    public function getDelete($id)
    {
    	$update = SuratKeluar::where('id',$id)->update(['soft_delete'=>1]);

        return redirect('admin/surat_keluar');
    }

    public function getUnduh($id){
        $surat = SuratKeluar::find($id);    

        return response()->download('upload/surat_keluar/' . $surat->file_surat);
    }
}

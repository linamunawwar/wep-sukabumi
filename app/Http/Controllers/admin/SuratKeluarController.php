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

    	$surat = new SuratKeluar;
    	$surat->no_surat = $data['no_surat'];
    	$surat->pengirim = $data['pengirim'];
    	$surat->kepada = $data['kepada'];
    	$surat->tanggal_surat = konversi_tanggal($data['tanggal_surat']);
    	$surat->perihal = $data['perihal'];
    	$surat->file_surat = $data['file_surat'];
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

    	$surat['no_surat'] = $data['no_surat'];
    	$surat['pengirim'] = $data['pengirim'];
    	$surat['kepada'] = $data['kepada'];
    	$surat['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
    	$surat['perihal'] = $data['perihal'];
    	$surat['file_surat'] = $data['file_surat'];

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
}

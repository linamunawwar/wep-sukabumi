<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
    	$surats = SuratKeluar::where('soft_delete',0)->get();

        return view('manager.surat_keluar.index',['surats'=>$surats]);
    }

    public function getUnduh($id){
        $surat = SuratKeluar::find($id);    

        return response()->download('upload/surat_keluar/' . $surat->file_surat);
    }
}

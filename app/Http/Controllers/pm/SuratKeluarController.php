<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuratKeluarController extends Controller
{
    public function index()
    {
    	$surats = SuratKeluar::where('soft_delete',0)->get();

        return view('pm.surat_keluar.index',['surats'=>$surats]);
    }

    public function getUnduh($id){
        $surat = SuratKeluar::find($id);    

        return response()->download('upload/surat_keluar/' . $surat->file_surat);
    }
}

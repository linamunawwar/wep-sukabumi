<?php

namespace App\Http\Controllers\pm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Disposisi;
use App\DisposisiTugas;
use App\SuratMasuk;


class DisposisiController extends Controller
{
    public function index()
    {
    	$disposisis = Disposisi::where('soft_delete',0)->get();

        return view('pm.disposisi.index',['disposisis'=>$disposisis]);
    }

    public function proses($id)
    {
    	$disposisi = Disposisi::find($id);

        return view('pm.disposisi.proses',['disposisi'=>$disposisi]);
    }

     public function postProses($id)
    {
    	
    	$disposisi = Disposisi::find($id);

    	$data = \Input::all();
    	$tugas = new DisposisiTugas;
    	$tugas->disposisi_id = $id;
    	if($data['PM']){
    		$tugas->posisi_id = 1;
    	}

        return view('pm.disposisi.proses',['disposisi'=>$disposisi]);
    }

}

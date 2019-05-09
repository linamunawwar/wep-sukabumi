<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Disposisi;
use App\DisposisiTugas;

class DisposisiController extends Controller
{
     public function index()
    {
    	$disposisis = Disposisi::whereHas('disposisiTugas',function ($q){
	            $q->where('posisi_id', \Auth::user()->pegawai->posisi_id);
	        })->get();
    	foreach ($disposisis as $key => $disposisi) {
    		$tugas = $disposisi->disposisiTugas()->where('posisi_id',\Auth::user()->pegawai->posisi_id)->first();
    		$disposisi->tugas = $tugas->tugas;
    		$disposisi->status = $tugas->status;

    		$all = DisposisiTugas::where('disposisi_id',$disposisi->id)->where('soft_delete',0)->get();

    		foreach ($all as $key => $value) {
    			$selesai[] = $value->status;
    		}
    		if((in_array('', $selesai)) || (in_array(null, $selesai))){
    			$disposisi->status_akhir = 0;
    		}else{
    			$disposisi->status_akhir = 1;
    		}
    	}

        return view('manager.disposisi.index',['disposisis'=>$disposisis]);
    }

    public function proses($id)
    {
    	$disposisi = Disposisi::find($id);
    	$tugas = $disposisi->disposisiTugas()->select('tugas')->where('posisi_id',\Auth::user()->pegawai->posisi_id)->first();
    	$disposisi->tugas = $tugas->tugas;

        return view('manager.disposisi.proses',['disposisi'=>$disposisi]);
    }

     public function postProses($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
    	
    	$update['status'] = 1;
    	$update['done_by'] = \Auth::user()->pegawai_id;
    	$update['done_at'] = date('Y-m-d H:i:s');
    	$update['user_id'] = \Auth::user()->id;
    	$update['role_id'] = \Auth::user()->role_id;
	    	
    	
    	$updt = DisposisiTugas::where('disposisi_id',$id)->where('posisi_id',\Auth::user()->pegawai->posisi_id)->update($update);

        return redirect('manager/disposisi');
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

        return view('manager.disposisi.monitoring',['disposisi'=>$disposisi,'diketahui'=>$diketahui,'diselesaikan'=>$diselesaikan,'diproses'=>$diproses,'diperiksa'=>$diperiksa]);
    }
}

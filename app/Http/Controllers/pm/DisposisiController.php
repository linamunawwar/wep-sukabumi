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

    	$update['note'] = $data['note'];
	    	
    	if(array_key_exists('PM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 1;
    		$tugas->tugas = $data['PM'];
    		$tugas->save();

    		$update['PM'] = $data['PM'];
    	}

    	if(array_key_exists('SOM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 8;
    		$tugas->tugas = $data['SOM'];
    		$tugas->save();

    		$update['SOM'] = $data['SOM'];
    	}

    	if(array_key_exists('SPLEM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 7;
    		$tugas->tugas = $data['SPLEM'];
    		$tugas->save();

    		$update['SPLEM'] = $data['SPLEM'];
    	}

    	if(array_key_exists('QC', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 2;
    		$tugas->tugas = $data['QC'];
    		$tugas->save();

    		$update['QC'] = $data['QC'];
    	}

    	if(array_key_exists('SEM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 4;
    		$tugas->tugas = $data['SEM'];
    		$tugas->save();

    		$update['SEM'] = $data['SEM'];
    	}

    	if(array_key_exists('SCARM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 5;
    		$tugas->tugas = $data['SCARM'];
    		$tugas->save();

    		$update['SCARM'] = $data['SCARM'];
    	}

    	if(array_key_exists('SAM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 7;
    		$tugas->tugas = $data['SAM'];
    		$tugas->save();

    		$update['SAM'] = $data['SAM'];
    	}

    	if(array_key_exists('HSE', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 3;
    		$tugas->tugas = $data['HSE'];
    		$tugas->save();

    		$update['HSE'] = $data['HSE'];
    	}

    	if(array_key_exists('Public', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 24;
    		$tugas->tugas = $data['Public'];
    		$tugas->save();

    		$update['public_relation'] = $data['Public'];
    	}

    	$updt = Disposisi::where('id',$id)->update($update);

        return redirect('pm/disposisi');
    }

    public function getEdit($id)
    {
    	$disposisi = Disposisi::find($id);

        return view('pm.disposisi.edit',['disposisi'=>$disposisi]);
    }

     public function postEdit($id)
    {
    	
    	$disposisi = Disposisi::find($id);

    	$data = \Input::all();

    	$update['note'] = $data['note'];
	    	
    	if(array_key_exists('PM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 1;
    		$tugas->save();

    		$update['PM'] = $data['PM'];
    	}

    	if(array_key_exists('SOM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 8;

    		$tugas->save();

    		$update['SOM'] = $data['SOM'];
    	}

    	if(array_key_exists('SPLEM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 7;

    		$tugas->save();

    		$update['SPLEM'] = $data['SPLEM'];
    	}

    	if(array_key_exists('QC', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 2;

    		$tugas->save();

    		$update['QC'] = $data['QC'];
    	}

    	if(array_key_exists('SEM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 4;

    		$tugas->save();

    		$update['SEM'] = $data['SEM'];
    	}

    	if(array_key_exists('SCARM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 5;

    		$tugas->save();

    		$update['SCARM'] = $data['SCARM'];
    	}

    	if(array_key_exists('SAM', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 7;

    		$tugas->save();

    		$update['SAM'] = $data['SAM'];
    	}

    	if(array_key_exists('HSE', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 3;

    		$tugas->save();

    		$update['HSE'] = $data['HSE'];
    	}

    	if(array_key_exists('Public', $data)){
    		$tugas = new DisposisiTugas;
	    	$tugas->disposisi_id = $id;
    		$tugas->posisi_id = 9;

    		$tugas->save();

    		$update['public_relation'] = $data['Public'];
    	}

    	$updt = Disposisi::where('id',$id)->update($update);

        return redirect('pm/disposisi');
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

        return view('pm.disposisi.monitoring',['disposisi'=>$disposisi,'diketahui'=>$diketahui,'diselesaikan'=>$diselesaikan,'diproses'=>$diproses,'diperiksa'=>$diperiksa]);
    }

}

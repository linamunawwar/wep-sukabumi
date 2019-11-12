<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Disposisi;
use App\DisposisiTugas;
use App\SuratMasuk;

class DisposisiController extends Controller
{
    public function indexSuratMasuk()
    {
        $surats = SuratMasuk::where('soft_delete',0)->get();

        return view('manager.disposisi.surat_masuk.index',['surats'=>$surats]);
    }

    public function getUnduhSuratMasuk($id){
        $surat = SuratMasuk::find($id);

        return response()->download('upload/surat_masuk/' . $surat->file_surat);
    }

     public function index()
    {
    	$disposisis = Disposisi::whereHas('disposisiTugas',function ($q){
	            $q->where('posisi_id', \Auth::user()->pegawai->posisi_id);
	        })->get();
    	foreach ($disposisis as $key => $disposisi) {
    		$tugas = $disposisi->disposisiTugas()->where('posisi_id',\Auth::user()->pegawai->posisi_id)->where('disposisi_id',$disposisi->id)->first();
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
        $dispo['note'] = \Input::get('note');
        $updt_dispo = Disposisi::where('id',$id)->update($dispo);
    	
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
        $pm = array();
        $pm[0] = array();
        $som = array();
        $som[0] = array();
        $splem = array();
        $splem[0] = array();
        $sqhsem = array();
        $sqhsem[0] = array();
        $sem = array();
        $sem[0] = array();
        $scarm = array();
        $scarm[0] = array();
        $sam = array();
        $sam[0] = array();
        $public = array();
        $public[0] = array();
        $i=0;
        foreach ($tugass as $key => $tugas) {

            if($tugas->posisi_id == 1){
                $pm[$i]['tugas'] = $tugas->tugas;
                $pm[$i]['status'] = $tugas->status;
            }else{
                 $pm[$i]['tugas'] = '';
                $pm[$i]['status'] = '';
            }

            if($tugas->posisi_id == 8){
                $som[$i]['tugas'] = $tugas->tugas;
                $som[$i]['status'] = $tugas->status;
            }else{
                $som[$i]['tugas'] = '';
                $som[$i]['status'] = '';
            }

            if($tugas->posisi_id == 7){
                $splem[$i]['tugas'] = $tugas->tugas;
                $splem[$i]['status'] = $tugas->status;
            }else{
                $splem[$i]['tugas'] = '';
                $splem[$i]['status'] = '';
            }

            if($tugas->posisi_id == 42){
                $sqhsem[$i]['tugas'] = $tugas->tugas;
                $sqhsem[$i]['status'] = $tugas->status;
            }else{
                $sqhsem[$i]['tugas'] = '';
                $sqhsem[$i]['status'] = '';
            }

            if($tugas->posisi_id == 4){
                $sem[$i]['tugas'] = $tugas->tugas;
                $sem[$i]['status'] = $tugas->status;
            }else{
                $sem[$i]['tugas'] = '';
                $sem[$i]['status'] = '';
            }

            if($tugas->posisi_id == 5){
                $scarm[$i]['tugas'] = $tugas->tugas;
                $scarm[$i]['status'] = $tugas->status;
            }else{
                $scarm[$i]['tugas'] = '';
                $scarm[$i]['status'] = '';
            }

            if($tugas->posisi_id == 6){
                $sam[$i]['tugas'] = $tugas->tugas;
                $sam[$i]['status'] = $tugas->status;
            }else{
                $sam[$i]['tugas'] = '';
                $sam[$i]['status'] = '';
            }

            if($tugas->posisi_id == 24){
                $public[$i]['tugas'] = $tugas->tugas;
                $public[$i]['status'] = $tugas->status;
            }else{
                $public[$i]['tugas'] = '';
                $public[$i]['status'] = '';
            }

            $i++;
        }

        return view('manager.disposisi.monitoring',['disposisi'=>$disposisi,'pm'=>$pm,'som'=>$som,'splem'=>$splem,'sqhsem'=>$sqhsem,'sem'=>$sem,'scarm'=>$scarm,'sam'=>$sam,'public'=>$public]);
    }
}

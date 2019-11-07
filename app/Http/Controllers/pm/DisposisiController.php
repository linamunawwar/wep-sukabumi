<?php

namespace App\Http\Controllers\pm;

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

        return view('pm.disposisi.surat_masuk.index',['surats'=>$surats]);
    }

    public function getUnduhSuratMasuk($id){
        $surat = SuratMasuk::find($id);

        return response()->download('upload/surat_masuk/' . $surat->file_surat);
    }

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

        date_default_timezone_set("Asia/Jakarta");
        $cek_tugas = DisposisiTugas::where('disposisi_id',$id)->where('posisi_id',\Auth::user()->pegawai->posisi_id)->first();
        if($cek_tugas){
            $update['status'] = 1;
            $update['done_by'] = \Auth::user()->pegawai_id;
            $update['done_at'] = date('Y-m-d H:i:s');
            $update['user_id'] = \Auth::user()->id;
            $update['role_id'] = \Auth::user()->role_id;
                
            
            $updt = DisposisiTugas::where('disposisi_id',$id)->where('posisi_id',\Auth::user()->pegawai->posisi_id)->update($update);
        }

        $data = \Input::all();

        $update['note_pm'] = $data['note_pm'];
            
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
        //QC dan hse digabung jd SQHSEM, tp ngga aku ubah, yg aku pake QC
        if(array_key_exists('QC', $data)){
            $tugas = new DisposisiTugas;
            $tugas->disposisi_id = $id;
            $tugas->posisi_id = 42;
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
            $tugas->posisi_id = 6;
            $tugas->tugas = $data['SAM'];
            $tugas->save();

            $update['SAM'] = $data['SAM'];
        }

        // if(array_key_exists('HSE', $data)){
        //  $tugas = new DisposisiTugas;
        //  $tugas->disposisi_id = $id;
        //  $tugas->posisi_id = 3;
        //  $tugas->tugas = $data['HSE'];
        //  $tugas->save();

        //  $update['HSE'] = $data['HSE'];
        // }

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

        $update['note_pm'] = $data['note_pm'];
            
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
            $tugas->posisi_id = 42;

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
            $tugas->posisi_id = 6;

            $tugas->save();

            $update['SAM'] = $data['SAM'];
        }

        // if(array_key_exists('HSE', $data)){
        //  $tugas = new DisposisiTugas;
        //  $tugas->disposisi_id = $id;
        //  $tugas->posisi_id = 3;

        //  $tugas->save();

        //  $update['HSE'] = $data['HSE'];
        // }

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

        return view('pm.disposisi.monitoring',['disposisi'=>$disposisi,'pm'=>$pm,'som'=>$som,'splem'=>$splem,'sqhsem'=>$sqhsem,'sem'=>$sem,'scarm'=>$scarm,'sam'=>$sam,'public'=>$public]);
    }

}

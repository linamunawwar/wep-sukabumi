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
use App\Models\User;

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

    	$data = \Input::all();

        if(\Input::hasfile('file_surat')){
            $ori_file  = \Request::file('file_surat');
            $tujuan = "upload/surat_masuk/";
            $ekstension = $ori_file->getClientOriginalExtension();
            $name = $ori_file->getClientOriginalName();

            $nama_file = $data['pengirim'].'_'.$name;
            $ori_file->move($tujuan,$nama_file);
        }else{
            $nama_file = '';
        }

    	$surat = new SuratMasuk;
    	$surat->no_surat = $data['no_surat'];
    	$surat->pengirim = $data['pengirim'];
    	$surat->kepada = $data['kepada'];
    	$surat->tanggal_surat = konversi_tanggal($data['tanggal_surat']);
    	$surat->perihal = $data['perihal'];
    	$surat->file_surat = $nama_file;
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

        if(\Input::hasfile('file_surat')){
            $dt_lama = SuratMasuk::find($id);
            unlink('upload/surat_masuk/'.$dt_lama->file_surat);

            $ori_file  = \Request::file('file_surat');
            $tujuan = "upload/surat_masuk/";
            $ekstension = $ori_file->getClientOriginalExtension();
            $name = $ori_file->getClientOriginalName();

            $nama_file = $data['pengirim'].'_'.$name;
            $ori_file->move($tujuan,$nama_file);

            $surat['file_surat'] = $nama_file;
        }

    	$surat['no_surat'] = $data['no_surat'];
    	$surat['pengirim'] = $data['pengirim'];
    	$surat['kepada'] = $data['kepada'];
    	$surat['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
    	$surat['perihal'] = $data['perihal'];
    	

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

    public function getUnduhSuratMasuk($id){
        $no_surat = str_replace('_', '/', $id);
        $surat = SuratMasuk::where('no_surat',$no_surat)->first();

        return response()->download('upload/surat_masuk/' . $surat->file_surat);
    }


    public function index()
    {
    	$disposisis = Disposisi::where('soft_delete',0)->orderBy('tanggal_terima','DESC')->get();
        // dd($disposisis);
        foreach ($disposisis as $key => $disposisi) {
            $tugass = DisposisiTugas::where('disposisi_id',$disposisi->id)->where('soft_delete',0)->get()->toArray();
            if($tugass){
                $disposisi->status = array_search('', array_column($tugass, 'status'));
            }else{
                $disposisi->status = true;
            }

        }
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

        if(\Input::hasfile('file_surat')){
            $ori_file  = \Request::file('file_surat');
            $tujuan = "upload/surat_masuk/";
            $ekstension = $ori_file->getClientOriginalExtension();
            $name = $ori_file->getClientOriginalName();

            $nama_file = $data['pengirim'].'_'.$name;
            $ori_file->move($tujuan,$nama_file);
        }else{
            $nama_file = '';
        }

        $surat = new SuratMasuk;
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

    	$disposisi = new Disposisi;
    	$disposisi->no_agenda = $data['no_agenda'];
    	$disposisi->pengirim = $data['pengirim'];
    	$disposisi->kepada = $data['kepada'];
        $disposisi->kategori = $data['kategori'];
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
         $find_dispo = Disposisi::find($id);

    	$disposisi['no_agenda'] = $data['no_agenda'];
    	$disposisi['pengirim'] = $data['pengirim'];
    	$disposisi['kepada'] = $data['kepada'];
        $disposisi['kategori'] = $data['kategori'];
    	$disposisi['tanggal_terima'] = konversi_tanggal($data['tanggal_terima']);
    	$disposisi['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
    	$disposisi['no_surat'] = $data['no_surat'];
    	$disposisi['perihal'] = $data['perihal'];
    	$disposisi['sifat'] = $data['sifat'];
    	$disposisi['user_id'] = \Auth::user()->id;
      	$disposisi['role_id'] = \Auth::user()->role_id;

      	$update = Disposisi::where('id',$id)->update($disposisi);

        if(\Input::hasfile('file_surat')){
            $dt_lama = SuratMasuk::where('no_surat', $find_dispo->no_surat)->first();
            if(file_exists('upload/surat_masuk/'.$dt_lama->file_surat)){
                unlink('upload/surat_masuk/'.$dt_lama->file_surat);
            }

            $ori_file  = \Request::file('file_surat');
            $tujuan = "upload/surat_masuk/";
            $ekstension = $ori_file->getClientOriginalExtension();
            $name = $ori_file->getClientOriginalName();

            $nama_file = $data['pengirim'].'_'.$name;
            $ori_file->move($tujuan,$nama_file);

            $surat['file_surat'] = $nama_file;
        }

        $surat['no_surat'] = $data['no_surat'];
        $surat['pengirim'] = $data['pengirim'];
        $surat['kepada'] = $data['kepada'];
        $surat['kategori'] = $data['kategori'];
        $surat['tanggal_surat'] = konversi_tanggal($data['tanggal_surat']);
        $surat['perihal'] = $data['perihal'];
        

        $surat['user_id'] = \Auth::user()->id;
        $surat['role_id'] = \Auth::user()->role_id;

        $update = SuratMasuk::where('no_surat',$find_dispo->no_surat)->update($surat);

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

        return view('admin.disposisi.monitoring',['disposisi'=>$disposisi,'pm'=>$pm,'som'=>$som,'splem'=>$splem,'sqhsem'=>$sqhsem,'sem'=>$sem,'scarm'=>$scarm,'sam'=>$sam,'public'=>$public]);
    }

    public function getUnduhDisposisi($id)
    {
        $disposisi = Disposisi::find($id);

        $tugass = DisposisiTugas::where('disposisi_id',$id)->where('soft_delete',0)->get();
        $pm['status']='';
        $som['status']='';
        $splem['status']='';
        $qc['status']='';
        $sem['status']='';
        $scarm['status']='';
        $sam['status']='';
        // $hse['status']='';
        $hm['status']='';
        foreach ($tugass as $key => $tugas) {

            if($tugas->posisi_id == 1){
                $pm['status'] = $tugas->status;
                $pm['done_at'] = $tugas->done_at;
            }

            if($tugas->posisi_id == 8){
                $som['status'] = $tugas->status;
                $som['done_at'] = $tugas->done_at;
            }

            if($tugas->posisi_id == 7){
                $splem['status'] = $tugas->status;
                $splem['done_at'] = $tugas->done_at;
            }
            
            if($tugas->posisi_id == 42){
                $qc['status'] = $tugas->status;
                $qc['done_at'] = $tugas->done_at;
            }

            if($tugas->posisi_id == 4){
                $sem['status'] = $tugas->status;
                $sem['done_at'] = $tugas->done_at;
            }

            if($tugas->posisi_id == 5){
                $scarm['status'] = $tugas->status;
                $scarm['done_at'] = $tugas->done_at;
            }

            if($tugas->posisi_id == 6){
                $sam['status'] = $tugas->status;
                $sam['done_at'] = $tugas->done_at;
            }

            // if($tugas->posisi_id == 3){
            //     $hse['status'] = $tugas->status;
            //     $hse['done_at'] = $tugas->done_at;
            // }

            if($tugas->posisi_id == 24){
                $hm['status'] = $tugas->status;
                $hm['done_at'] = $tugas->done_at;
            }
        }
    
        $pdf = PDF::loadView('admin.disposisi.unduh',['disposisi' => $disposisi, 'pm'=>$pm,'som'=>$som,'splem'=>$splem,'qc'=>$qc, 'sem'=>$sem, 'scarm'=>$scarm, 'sam'=>$sam, 'hm'=>$hm]);
        $pdf->setPaper('legal', 'portrait');
        return $pdf->download('Disposisi_'.$disposisi->no_agenda.'.pdf');
        
    }

    public function setPage($page){
        session(['page'=>$page]);
    }

    public function setSessionProses(){
        session(['proses'=>0]);
    }
}

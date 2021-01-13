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

    public function getNomor()
    {
        date_default_timezone_set("Asia/Jakarta");

        $tanggal = konversi_tanggal(\Input::get('tanggal'));
        $cek_upload = SuratKeluar::where('user_id',\Auth::user()->id)->whereNull('file_surat')->get();
        //cek file surat ada yg blm diupload gak, klo ada ngga bisa request nomor baru
        if(count($cek_upload) == 0){
            $bulan = bulanRomawi(date('m'));
            if($tanggal == date('Y-m-d')){
                $surat = SuratKeluar::where('soft_delete',0)->orderBy('tanggal_surat','desc')->orderBy('created_at','desc')->first();

                $no_surat = explode('/',$surat->no_surat);
                if(strpos($no_surat[0],'.')){
                    $backdate = explode('.', $no_surat[0]);
                    $no_surat[0] = $backdate[0];
                }
                $nomor_surat = (int)$no_surat[0]+1;
                
                $nomor_surat_akhir = tigadigit($nomor_surat).'/WK/INF2/BCKY-2AU/'.$bulan.'/'.date('Y');
                $cek = SuratKeluar::where('no_surat',$nomor_surat_akhir)->get();
                if(count($cek)==0){
                    return $nomor_surat_akhir;
                }else {
                    return 0;
                }
            }elseif($tanggal < date('Y-m-d')){
                //surat backdate
                $surat = SuratKeluar::where('tanggal_surat','<=',$tanggal)->where('soft_delete',0)->orderBy('tanggal_surat','desc')->orderBy('created_at','desc')->first();
                if($surat){
                    $no_surat = explode('/',$surat->no_surat);
                    $nomor ='';
                    // dd($surat);
                    if(strpos($no_surat[0],'.')){
                        $backdate = explode('.', $no_surat[0]);
                        $backdate[1]++;
                        $nomor = $backdate[0].'.'.$backdate[1];
                        // dd($surat);
                    }else{
                        $nomor = $no_surat[0].'.1';
                    }

                    $nomor_surat_akhir = $nomor.'/WK/INF2/BCKY-2AU/'.$bulan.'/'.date('Y');
                    $cek = SuratKeluar::where('no_surat',$nomor_surat_akhir)->get();
                    if(count($cek)==0){
                        return $nomor_surat_akhir;
                    }else {
                        return 0;
                    }
                }else{
                    return false;
                }
            }else{
                return null;
            }

        }else{
            return false;
        }
    }

    public function postCreate(Request $request)
    {
    	$file = $request->file('file_surat');

    	$data = \Input::all();
        $nama_file='';
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

<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Spj;
use App\Pegawai;

class SpjController extends Controller
{
    public function index()
    {
    	$spjs = Spj::where('nip',\Auth::user()->pegawai_id)->where('soft_delete',0)->get();

        return view('user.spj.index',['spjs'=>$spjs]);
    }
    

    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();

        return view('user.spj.create',['pegawais'=>$pegawais]);
    }

    public function postCreate()
    {
    	$data = \Input::all();

        if(\Input::hasfile('lampiran')){
          $ori_file  = \Request::file('lampiran');
         $tujuan = "upload/spj";
         $ekstension = $ori_file->getClientOriginalExtension();
         $sppd = str_replace('/', '_', $data['no_sppd']);
          $nama_file = 'lampiran_'.$sppd.'.'.$ekstension;

        $ori_file->move($tujuan,$nama_file);
       }else{
            $nama_file='';
       }

    	$spj = new Spj;
        $spj->nip = \Auth::user()->pegawai_id;
      $spj->no_sppd = $data['no_sppd'];
    	$spj->pemberi_tugas = $data['pemberi_tugas'];
    	$spj->tanggal_berangkat = konversi_tanggal($data['tanggal_berangkat']);
    	$spj->tanggal_pulang = konversi_tanggal($data['tanggal_pulang']);
    	$spj->angkutan = $data['angkutan'];
      $spj->tujuan = $data['tujuan'];
      $spj->keperluan = $data['keperluan'];
    	$spj->lampiran = $nama_file;
      $spj->is_verif_admin = '0';
      $spj->is_verif_sdm = '0';
    	$spj->user_id = \Auth::user()->id;
    	$spj->role_id = \Auth::user()->role_id;

    	$spj->save();

        return redirect('user/spj');
    }

    public function hitungNominal()
    {
        $data = \Input::all();
        $tanggal_berangkat = konversi_tanggal($data['tanggal_berangkat']);
        $tanggal_pulang = konversi_tanggal($data['tanggal_pulang']);

        $tanggal_berangkat = date_create($tanggal_berangkat);

        $tanggal_pulang = date_create($tanggal_pulang);

        $difference = date_diff($tanggal_pulang,$tanggal_berangkat);

        $days = $difference->d;

        switch (\Auth::user()->role_id) {
            case 2:
                $konsumsi = 400000;
              break;
            case 3:
                $konsumsi = 500000;
              break;
            case 4:
                $konsumsi = 500000;
              break;
            case 5:
                $konsumsi = 600000;
              break;
        }

        $nominal = $days*$konsumsi;
        $nominal = $nominal + $angkutan;

        return $nominal;
    }

    public function getEdit($id)
    {
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
        $spj = Spj::find($id);

        return view('user.spj.edit',['pegawais'=>$pegawais,'spj'=>$spj]);
    }

    public function postEdit($id)
    {
        $data = \Input::all();
        $data_awal = Spj::find($id);

        if(\Input::hasfile('lampiran')){
            dd('d');
        unlink("upload/spj/".$data_awal->lampiran);
          $ori_file  = \Request::file('lampiran');
         $tujuan = "upload/spj";
         $ekstension = $ori_file->getClientOriginalExtension();

          $nama_file = 'lampiran_'.$data['no_sppd'].'.'.$ekstension;

        $ori_file->move($tujuan,$nama_file);
         $spj['lampiran'] = $nama_file;
       }

        $spj['nip'] = \Auth::user()->pegawai_id;
        $spj['tanggal_berangkat'] = konversi_tanggal($data['tanggal_berangkat']);
        $spj['tanggal_pulang'] = konversi_tanggal($data['tanggal_pulang']);
        $spj['pemberi_tugas'] = $data['pemberi_tugas'];
        $spj['angkutan'] = $data['angkutan'];
        $spj['keperluan'] = $data['keperluan'];
        $spj['user_id'] = \Auth::user()->id;
        $spj['role_id'] = \Auth::user()->role_id;

        $update = Spj::where('id',$id)->update($spj);

        return redirect('user/spj');
    }
}

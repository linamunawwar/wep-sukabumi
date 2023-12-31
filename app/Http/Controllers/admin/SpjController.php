<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PDF;
use App\Spj;
use App\Pegawai;

class SpjController extends Controller
{
    public function index()
    {
    	$spjs = Spj::where('soft_delete',0)->get();

        return view('admin.spj.index',['spjs'=>$spjs]);
    }

    public function getCreate()
    {
    	$pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
      $pm = Pegawai::where('posisi_id',1)
                      ->where('tanggal_keluar',null)
                      ->first();
      $pemberi_tugas = Pegawai::where('role_id',5)
                                ->orwhere('role_id',4)
                                ->orwhere('role_id',3)->get();

        return view('admin.spj.create',['pegawais'=>$pegawais,'pm'=>$pm, 'pemberi_tugas'=>$pemberi_tugas]);
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

        return redirect('admin/spj');
    }

    public function getApprove($id)
    {

    	$spj = Spj::find($id);
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
        $pm = Pegawai::where('posisi_id',1)
                      ->where('tanggal_keluar',null)
                      ->first();

        return view('admin.spj.approve',['spj'=>$spj,'pegawais'=>$pegawais,'pm'=>$pm]);
    }

    public function postApprove($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = \Input::all();
        $data['is_verif_admin'] = '1';
        $data['verif_admin_by'] = \Auth::user()->id;
        $data['verify_admin_time'] = date('Y-m-d H:i:s');
        $data['tanggal_berangkat']=konversi_tanggal($data['tanggal_berangkat']);
        $data['tanggal_pulang'] =konversi_tanggal($data['tanggal_pulang']);
        $date1 = new \DateTime($data['tanggal_berangkat']);
        $date2 = new \DateTime($data['tanggal_pulang']);
        $days  = $date2->diff($date1)->format('%a');
        if($days == 0){
          $days = 1;
        }
        
        if(is_numeric($data['uang_konsumsi'])){
          $data['uang_konsumsi'] = $data['uang_konsumsi'] * $days;
        }
        if(is_numeric($data['uang_penginapan'])){
          $data['uang_penginapan'] = $data['uang_penginapan'] * $days;
        }
        unset($data['_token']);

        $spj = Spj::where('id',$id)->update($data);

        return redirect('admin/spj');
    }

    public function getUnduh($id)
    {
      $spj = Spj::find($id);
      $sdm = getManager('SA','Spj',$spj->id);
      $pm = getPM('Spj',$spj->id);
      $pdf = PDF::loadView('admin.spj.unduh',['spj' => $spj,'pm'=>$pm,'sdm'=>$sdm]);
      $pdf->setPaper('A4');
      return $pdf->download('SPJ_'.$spj->no_sppd.'.pdf');
    }

    public function getDelete(){
      $data = \Input::all();
      $del = Spj::where('id',$data['id_spj'])->update(['soft_delete'=>1]);

      if($del){
        return redirect('admin/spj');
      }

    }
}

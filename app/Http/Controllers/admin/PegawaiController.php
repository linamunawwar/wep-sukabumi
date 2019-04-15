<?php

namespace App\Http\Controllers\admin;

use App\Roles;
use App\Pegawai;
use App\KodeBagian;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{

    public function index()
    {
    	 $pegawais= Pegawai::get();
        return view('admin.pegawai.index',['pegawais'=>$pegawais]);
    }

    public function getCreate()
    {
        $roles= Roles::get();
        $kode = KodeBagian::all();
        

        return view('admin.pegawai.create',['roles'=>$roles,'kode'=>$kode]);
    }

    public function postCreate()
    {
    	date_default_timezone_set("Asia/Jakarta");
        $nama = \Input::get('nama');
        $gender = \Input::get('gender');
        $date = \Input::get('tgl_lahir');
        $date_masuk = \Input::get('tgl_masuk');

        $dates = explode('-', $date);
		$tgl_lahir = $dates[2].'-'.$dates[1].'-'.$dates[0];

        $dates_msk = explode('-', $date_masuk);
        $tgl_masuk = $dates_msk[2].'-'.$dates_msk[1].'-'.$dates_msk[0];

        $kode_bagian = \Input::get('kode_bagian');
        $role = \Input::get('role');
        
        $tahun = str_split($dates[2],2);
        $nip = $kode_bagian.$dates[0].$dates[1].$tahun[1];
        $password = str_random(6);

        $user['name'] = $nama;
        $user['pegawai_id'] = $nip;
        $user['pass_asli'] = $password;
        $user['password'] = \Hash::make($password);
        $user['role_id'] = $role;
        $user['created_at'] = date('Y-m-d H:i:s');

        $query_user = \DB::table('users')->insert($user);

        unset($user['password']);
        unset($user['pegawai_id']);
        unset($user['name']);
        $data = $user;
        $data['nama'] = $nama;
        $data['nip'] = $nip;
        $data['gender'] = $gender;
        $data['tanggal_lahir'] = $tgl_lahir;
        $data['tanggal_masuk'] = $tgl_masuk;
        $data['is_new'] = 1;
        $data['is_verif'] = 0;
        $query_pegawai = \DB::table('mst_pegawai')->insert($data);


        if($query_user && $query_pegawai){
            return Redirect('admin/pegawai')->with(['msg'=>'Data berhasil ditambahkan','status'=>1]);
        }else{
            return Redirect('admin/pegawai')->with(['msg'=>'Terdapat Kesalahan','status'=>0]);
        }
    }

    public function getEdit($id)
    {
        $pegawai = Pegawai::find($id);
        $roles= Roles::get();
        $kode = KodeBagian::all();

        return view('admin.pegawai.edit',['pegawai'=>$pegawai,'roles'=>$roles,'kode'=>$kode]);
    }

    public function postEdit($id)
    {
        $pegawai = Pegawai::find($id);

        date_default_timezone_set("Asia/Jakarta");
        $nama = \Input::get('nama');
        $gender = \Input::get('gender');
        $date = \Input::get('tgl_lahir');
        $date_masuk = \Input::get('tgl_masuk');

        $dates = explode('-', $date);
        $tgl_lahir = $dates[2].'-'.$dates[1].'-'.$dates[0];

        $dates_msk = explode('-', $date_masuk);
        $tgl_masuk = $dates_msk[2].'-'.$dates_msk[1].'-'.$dates_msk[0];

        $kode_bagian = \Input::get('kode_bagian');
        $role = \Input::get('role');
        
        $tahun = str_split($dates[2],2);
        $nip = $kode_bagian.$dates[0].$dates[1].$tahun[1];
        $password = str_random(6);

        $user['name'] = $nama;
        $user['pegawai_id'] = $nip;
        $user['pass_asli'] = $password;
        $user['password'] = \Hash::make($password);
        $user['role_id'] = $role;
        $user['updated_at'] = date('Y-m-d H:i:s');

        $query_user = \DB::table('users')->where('pegawai_id',$pegawai->nip)->update($user);

        unset($user['pass_asli']);
        unset($user['password']);
        unset($user['pegawai_id']);
        unset($user['name']);
        $data = $user;
        $data['nama'] = $nama;
        $data['nip'] = $nip;
        $data['gender'] = $gender;
        $data['tanggal_lahir'] = $tgl_lahir;
        $data['tanggal_masuk'] = $tgl_masuk;
        $data['is_new'] = 1;
        $data['is_verif'] = 0;
        $query_pegawai = \DB::table('mst_pegawai')->where('id',$id)->update($data);


        if($query_user && $query_pegawai){
            return Redirect('admin/pegawai')->with(['msg'=>'Data berhasil ditambahkan','status'=>1]);
        }else{
            return Redirect('admin/pegawai')->with(['msg'=>'Terdapat Kesalahan','status'=>0]);
        }
    }

    public function getApproveAdmin()
    {
        return view('admin.pegawai.approve_admin');
    }

    public function getStruktur()
    {
        return view('admin.pegawai.struktur.index');
    }
}

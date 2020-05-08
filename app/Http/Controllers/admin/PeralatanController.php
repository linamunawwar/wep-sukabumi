<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Peralatan;
use App\Inventori;
use App\Pegawai;

class PeralatanController extends Controller
{
    public function index()
    {
    	$alats = Peralatan::where('soft_delete',0)->get();
    	
        return view('admin.peralatan.index',['alats'=>$alats]);
    }

    public function getCreate()
    {
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
        $alats = Inventori::all();
        return view('admin.peralatan.create',['pegawais'=>$pegawais, 'alats'=>$alats]);
    }

    public function postCreate()
    {
        $data = \Input::all();

        $user = User::where('pegawai_id',$data['nip'])->first();

        $find = Inventori::where('kode_barang', $data['kode_barang'])->first();
        $alat = new Peralatan;
        $alat->nip = $data['nip'];
        $alat->kode_barang = $data['kode_barang'];
        $alat->tipe_barang = $find->tipe_barang;
        $alat->tanggal_pinjam = konversi_tanggal($data['tanggal_pinjam']);
        $alat->user_id = $user->id;
        $alat->role_id = $user->role_id;
        $pegawai = Pegawai::where('nip',$data['nip'])->first();
        $data['nama_barang'] = $find->nama_barang;

        if($alat->save()){
            \Mail::send('mail.test',$data, function($message) use ($pegawai,$data) {
                $message->to($pegawai->email, '')->subject('Peminjaman Barang');
            });
        }

        return redirect('admin/peralatan');
    }

    public function getEdit($id)
    {
        $alat = Peralatan::where('id',$id)->first();
        $pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
        $inventoris = Inventori::all();

        return view('admin.peralatan.edit',['alat'=>$alat,'pegawais'=>$pegawais,'inventoris'=>$inventoris]);
    }

    public function postEdit($id)
    {
        $data = \Input::all();
        $find = Inventori::where('kode_barang', $data['kode_barang'])->first();
        $data['tipe_barang'] = $find->tipe_barang;
        unset($data['_token']);
        $data['tanggal_pinjam'] = konversi_tanggal($data['tanggal_pinjam']);

        $upd = Peralatan::where('id',$id)->update($data);

        return redirect('admin/peralatan');
    }

    public function getDelete($id)
    {
        // $alat = Peralatan::where('id',$id)->update(['soft_delete'=>1]);
        $alat = Peralatan::where('id',$id)->delete();

        return redirect('admin/peralatan');
    }

    public function getKembali($id)
    {
        $alat = Peralatan::where('id',$id)->update(['tanggal_kembali'=>date('Y-m-d'),'is_kembali'=>1]);

        return redirect('admin/peralatan');
    }

    public function indexData()
    {
        $inventoris = Inventori::where('soft_delete',0)->get();
        $nama_barang = Inventori::where('soft_delete',0)->groupBy('nama_barang')->get();
        
        return view('admin.peralatan.data.index',['inventoris'=>$inventoris,'nama_barang'=>$nama_barang]);
    }

    public function getCreateData()
    {

        return view('admin.peralatan.data.create');
    }

    public function postCreateData()
    {
        $data = \Input::all();

        $alat = new Inventori;
        $alat->nama_barang = $data['nama_barang'];
        $alat->kode_barang = $data['kode_barang'];
        $alat->tipe_barang = $data['tipe_barang'];
        $alat->user_id = \Auth::user()->id;
        $alat->role_id = \Auth::user()->role_id;

        $alat->save();
        return redirect('admin/peralatan/data');
    }

    public function getEditData($id)
    {
        $inventori = Inventori::where('id',$id)->first();

        return view('admin.peralatan.data.edit',['inventori'=>$inventori]);
    }

    public function postEditData($id)
    {
        $data = \Input::all();

        unset($data['_token']);

        $upd = Inventori::where('id',$id)->update($data);

        return redirect('admin/peralatan/data');
    }

    public function getDeleteData($id)
    {
        $alat = Inventori::where('id',$id)->update(['soft_delete'=>1]);

        return redirect('admin/peralatan/data');
    }
}

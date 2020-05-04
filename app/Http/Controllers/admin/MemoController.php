<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pegawai;
use App\Memo;
use App\MemoPegawai;
use App\Models\User;

class MemoController extends Controller
{
    public function index()
    {
    	$memos = Memo::where('soft_delete',0)->orderBy('created_at','desc')->get();

        return view('admin.memo.index',['memos'=>$memos]);
    }

    public function getCreate()
    {
        return view('admin.memo.create');
    }

    public function postCreate()
    {
    	date_default_timezone_set("Asia/Jakarta");


    	$data = \Input::all();

    	$memo = new Memo;
    	$memo->judul = $data['judul'];
    	$memo->cc = $data['cc'];
    	$memo->isi = $data['isi'];
    	$memo->waktu = date('Y-m-d H:i:s');
    	$memo->user_id = \Auth::user()->id;
    	$memo->role_id = \Auth::user()->role_id;

        if(\Input::hasfile('file')){
          $ori_file  = \Request::file('file');
          $tujuan = "upload/memo";
          $ekstension = $ori_file->getClientOriginalExtension();

          $nama_file = $ori_file->getClientOriginalName();

            $ori_file->move($tujuan,$nama_file);
            $memo->nama_file = $nama_file;
       }
       $memo->save();

    	$pegawais = Pegawai::where('is_active',1)->where('soft_delete',0)->get();
    	foreach ($pegawais as $key => $pegawai) {
            $user = User::where('pegawai_id',$pegawai->nip)->first();
    		$memop = new MemoPegawai;
    		$memop->memo_id = $memo->id;
    		$memop->pegawai_id = $pegawai->nip;
    		$memop->user_id = $user->id;
    		$memop->role_id = \Auth::user()->role_id;

    		$memop->save();
    	}

    	return redirect('/admin/memo');

    }

    public function getDetail($id)
    {
    	$memo = Memo::find($id);

        return view('admin.memo.detail',['memo'=>$memo]);
    }

    public function getEdit($id)
    {
    	$memo = Memo::find($id);

        return view('admin.memo.edit',['memo'=>$memo]);
    }

    public function postEdit($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

    	$data = \Input::all();
        $find = Memo::find($id);
        if(\Input::hasfile('file')){
            if(file_exists("upload/memo/".$find->nama_file) && $find->nama_file){
                unlink( "upload/memo/".$find->nama_file);
            }

            $ori_file  = \Request::file('file');
            $tujuan = "upload/memo";
            $ekstension = $ori_file->getClientOriginalExtension();

            $nama_file = $ori_file->getClientOriginalName();

            $ori_file->move($tujuan,$nama_file);
            $memo['nama_file'] = $nama_file;
        }

    	$memo['judul'] = $data['judul'];
    	$memo['cc'] = $data['cc'];
    	$memo['isi'] = $data['isi'];
    	$memo['waktu'] = date('Y-m-d H:i:s');
    	$memo['user_id'] = \Auth::user()->id;
    	$memo['role_id'] = \Auth::user()->role_id;

    	$update = Memo::where('id',$id)->update($memo);

    	return redirect('/admin/memo');

    }

    public function getDelete()
    {
        $id = \Input::get('id_memo');
    	date_default_timezone_set("Asia/Jakarta");

    	$memo['waktu'] = date('Y-m-d H:i:s');
    	$memo['soft_delete'] = 1;
    	$memo['user_id'] = \Auth::user()->id;
    	$memo['role_id'] = \Auth::user()->role_id;

    	$update = Memo::where('id',$id)->update($memo);
        $delete = MemoPegawai::where('memo_id',$id)->delete();

    	return redirect('/admin/memo');

    }
}

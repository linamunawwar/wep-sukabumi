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
    	$memos = Memo::where('soft_delete',0)->get();

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

    	$memo->save();

    	$pegawais = Pegawai::where('is_active',1)->get();
    	foreach ($pegawais as $key => $pegawai) {
    		$memop = new MemoPegawai;
    		$memop->memo_id = $memo->id;
    		$memop->pegawai_id = $pegawai->nip;
    		$memop->user_id = \Auth::user()->id;
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

    	$memo['judul'] = $data['judul'];
    	$memo['cc'] = $data['cc'];
    	$memo['isi'] = $data['isi'];
    	$memo['waktu'] = date('Y-m-d H:i:s');
    	$memo['user_id'] = \Auth::user()->id;
    	$memo['role_id'] = \Auth::user()->role_id;

    	$update = Memo::where('id',$id)->update($memo);

    	return redirect('/admin/memo');

    }

    public function getDelete($id)
    {
    	date_default_timezone_set("Asia/Jakarta");

    	$memo['waktu'] = date('Y-m-d H:i:s');
    	$memo['soft_delete'] = 1;
    	$memo['user_id'] = \Auth::user()->id;
    	$memo['role_id'] = \Auth::user()->role_id;

    	$update = Memo::where('id',$id)->update($memo);

    	return redirect('/admin/memo');

    }
}

<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MemoPegawai;
use App\Memo;

class MemoController extends Controller
{
    public function index()
    {
    	$memos = MemoPegawai::where('soft_delete',0)->where('user_id',\Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('user.memo.index',['memos'=>$memos]);
    }

     public function getDetail($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
    	$memo = Memo::find($id);

    	$data['viewed_at'] = date('Y-m-d H:i:s');

    	$update = MemoPegawai::where('memo_id',$id)->where('user_id',\Auth::user()->id)->update($data);

        return view('user.memo.detail',['memo'=>$memo]);
    }
}

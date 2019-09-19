<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Arsip;

class ArsipController extends Controller
{
    public function index()
    {
        $kode = \Auth::user()->role->id;
        $arsips = Arsip::where($kode,'on')->where('soft_delete',0)->get();

        return view('admin.arsip.index',['arsips'=>$arsips]);
    }


    public function getUnduh($id)
    {
        $arsip = Arsip::find($id);

        if($arsip){
            return redirect('manager/arsip');
        }
        
    }

}

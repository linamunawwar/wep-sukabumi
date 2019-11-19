<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Arsip;

class ArsipController extends Controller
{
    public function index()
    {
        $arsips = Arsip::where('soft_delete',0)->get();

        return view('admin.arsip.index',['arsips'=>$arsips]);
    }

    public function getCreate()
    {
        return view('admin.arsip.create');
    }

    public function postCreate(Request $request){
    	$ori_file 	= \Request::file('file');
    	$tujuan = "upload/arsip";
    	$nama_form = \Input::get('nama_form');
    	$ekstension = $ori_file->getClientOriginalExtension();

    	$nama_file = $ori_file->getClientOriginalName();

    	$ori_file->move($tujuan,$nama_file);
    	
        $arsip = new Arsip;
        $arsip->nama_form = $nama_form;
        $arsip->nama_file = $nama_file;
        $arsip->PM = \Input::get('PM');
        $arsip->SO = \Input::get('SO');
        $arsip->SC = \Input::get('SC');
        $arsip->SA = \Input::get('SA');
        $arsip->SE = \Input::get('SE');
        $arsip->SL = \Input::get('SL');
        $arsip->HS = \Input::get('HS');
        $arsip->QC = \Input::get('QC');

        $arsip->user_id = \Auth::user()->id;
        $arsip->role_id = \Auth::user()->role_id;

        $arsip->save();

        return redirect('admin/arsip');
    }

    public function getEdit($id)
    {
        $arsip = Arsip::find($id);

        return view('admin.arsip.edit',['arsip'=>$arsip]);
    }

    public function postEdit($id){
        $arsip = Arsip::find($id);
        if(\Input::hasfile('file')){
            unlink( "upload/arsip/".$arsip->nama_file);
        }

        $ori_file   = \Request::file('file');
        $tujuan = "upload/arsip";
        $nama_form = \Input::get('nama_form');
        $ekstension = $ori_file->getClientOriginalExtension();

        $nama_file = $ori_file->getClientOriginalName();

        $ori_file->move($tujuan,$nama_file);
        
        $data['nama_form'] = $nama_form;
        $data['nama_file'] = $nama_file;
        $data['PM'] = \Input::get('PM');
        $data['SO'] = \Input::get('SO');
        $data['SC'] = \Input::get('SC');
        $data['SA'] = \Input::get('SA');
        $data['SE'] = \Input::get('SE');
        $data['SL'] = \Input::get('SL');
        $data['HS'] = \Input::get('HS');
        $data['QC'] = \Input::get('QC');

        $data['user_id'] = \Auth::user()->id;
        $data['role_id'] = \Auth::user()->role_id;

        $update = Arsip::where('id',$id)->update($data);

        return redirect('admin/arsip');
    }

    public function getDelete($id)
    {
        $arsip = Arsip::find($id);
        unlink( "upload/arsip/".$arsip->nama_file);
        $arsip = Arsip::where('id',$id)->update(['soft_delete'=>1]);

        if($arsip){
            return redirect('admin/arsip');
        }
        
    }

    public function getUnduh($id)
    {
        $arsip = Arsip::find($id);

        if($arsip){
            return redirect('admin/arsip');
        }
        
    }

}

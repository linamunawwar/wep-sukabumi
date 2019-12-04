<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogJenis;

class JenisPekerjaanController extends Controller
{
    public function index()
    {
        $jeniss = LogJenis::where('soft_delete', 0)->get();
        return view('logistik.admin.jenis_pekerjaan.index', ['jeniss' => $jeniss]);
    }

    public function beforePostJenis()
    {
        return view('logistik.admin.jenis_pekerjaan.create');
    }

    public function postJenis()
    {
        $data = \Input::all();

        $addJenis = new LogJenis;
        $addJenis->nama = $data['nama'];
        $addJenis->keterangan = $data['keterangan'];
        $addJenis->user_id = \Auth::user()->id;
        $addJenis->soft_delete = 0;
        $addJenis->created_at = date('Y-m-d H:i:s');
        $addJenis->save();

        return redirect('/logistik/admin/jenis_pekerjaan');

    }

    public function getJenisById($id)
    {
        $getJenis = LogJenis::find($id);
        return view('logistik.admin.jenis_pekerjaan.edit', ['jenis' => $getJenis]);
    }

    public function updateJenis($id)
    {
        $getJenis = LogJenis::find($id);

        if ($getJenis) {
            $data = \Input::all();
            $toUpdateJenis['nama'] = $data['nama'];
            $toUpdateJenis['keterangan'] = $data['keterangan'];
            $toUpdateJenis['updated_at'] = date('Y-m-d H:i:s');

            $UpdatedJenis = LogJenis::where('id', $data['id'])->update($toUpdateJenis);
        }

        return redirect('/logistik/admin/jenis_pekerjaan');

    }

    public function deleteJenis()
    {
    	$data = \Input::all();
        $deletedJenis = LogJenis::where('id', $data['id_jenis'])->update(['soft_delete' => 1]);
        if ($deletedJenis) {

            return redirect('/logistik/admin/jenis_pekerjaan');

        }
    }
}

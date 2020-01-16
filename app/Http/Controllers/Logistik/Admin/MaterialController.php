<?php

namespace App\Http\Controllers\logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogMaterial;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.admin.material.index', ['materials' => $materials]);
    }

    public function beforePostMaterial()
    {
        return view('logistik.admin.material.create');
    }

    public function postMaterial()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = \Input::all();

        $addMaterial = new logMaterial;
        $addMaterial->kode_material = $data['kode_material'];
        $addMaterial->nama = $data['nama'];
        $addMaterial->satuan = $data['satuan'];
        $addMaterial->keterangan = $data['keterangan'];
        $addMaterial->user_id = \Auth::user()->id;
        $addMaterial->soft_delete = 0;
        $addMaterial->created_at = date('Y-m-d H:i:s');
        $addMaterial->save();

        return redirect('/Logistik/admin/material');

    }

    public function getMaterialById($id)
    {
        $getMaterial = LogMaterial::find($id);
        return view('logistik.admin.material.edit', ['material' => $getMaterial]);
    }

    public function updateMaterial($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $getMaterial = LogMaterial::find($id);

        $data = \Input::all();
        $material['kode_material'] = $data['kode_material'];
        $material['nama'] = $data['nama'];
        $material['satuan'] = $data['satuan'];
        $material['keterangan'] = $data['keterangan'];
        $material['updated_at'] = date('Y-m-d H:i:s');

        $updateMaterial = LogMaterial::where('kode_material', $data['kode_material'])->update($material);

        return redirect('/Logistik/admin/material');
    }

    public function deleteMaterial()
    {
        $dataDelete = \Input::all();
        $deleteMaterial = LogMaterial::where('id', $dataDelete['id_material'])->update(['soft_delete'=>1]);

        if ($deleteMaterial) {
            return redirect('/Logistik/admin/material');

        }
    }
}

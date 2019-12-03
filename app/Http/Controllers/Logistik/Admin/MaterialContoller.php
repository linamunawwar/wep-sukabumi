<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\LogMaterial;

class MaterialContoller extends Controller
{
    public function index()
    {
        $material = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.material.index', ['material' => $material]);
    }

    public function postMaterial()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = \Input::all();

        $addMaterial = new logMaterial;
        $addMaterial->kode_material = $data['kode_material'];
        $addMaterial->nama = $data['nama'];
        $addMaterial->keterangan = $data['keterangan'];
        $addMaterial->user_id = \Auth::user()->id;
        $addMaterial->soft_delete = 0;
        $addMaterial->created_at = date('Y-m-d H:i:s');
        $addMaterial->save();

        return redirect('');

    }

    public function getMaterialById($id)
    {
        $getMaterial = LogMaterial::find($id);
        return view('');
    }

    public function updateMaterial($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $getMaterial = LogMaterial::find($id);

        $data = \Input::all();
        $material['kode_material'] = $data['kode_material'];
        $material['nama'] = $data['nama'];
        $material['keterangan'] = $data['keterangan'];
        $material['updated_at'] = date('Y-m-d H:i:s');

        $updateMaterial = LogMaterial::where('kode_material', $data['kode_material'])->update($material);

        return redirect('');
    }

    public function deleteMaterial($id)
    {
        $data = \Input::all();
        $deleteMaterial = LogMaterial::where('kode_material', $data['kode_material'])->update(['soft_delete' => 1]);

        if ($deleteMaterial) {
            return redirect('');

        }
    }
}

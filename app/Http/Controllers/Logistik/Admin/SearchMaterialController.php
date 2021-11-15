<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\LogMaterial;
use App\Models\LogPermintaanMaterial;
use App\Models\LogDetailPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogDetailPenerimaanMaterial;


class SearchMaterialController extends Controller
{
    public function index()
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        foreach ($materials as $key => $val) {
            $detailPermintaan = LogDetailPenerimaanMaterial::where(['material_id' => $val->id, 'soft_delete' => 0])
                                                    ->orderBy('id', 'desc')
                                                    ->first();
            if ($detailPermintaan) {
                $val->jumlahStok = $detailPermintaan->sisa_stok;
            }else{
                $val->jumlahStok = 0;
            }
        }
        return view('logistik.admin.search_material.index', ['materials' => $materials]);
    }

    public function getDetailBySearchMaterialId($id)
    {
        return view('logistik.admin.search_material.detail');
    }
}

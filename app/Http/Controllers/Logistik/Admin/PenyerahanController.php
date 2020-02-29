<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;
use App\Models\LogMaterial;
use App\Models\LogPengajuanMaterial;
use App\Models\LogPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;

class PenyerahanController extends Controller
{
    public function index()
    {
        $penyerahans = LogPengajuanMaterial::where('soft_delete', 0)
                            ->where('is_som', 1)
                            ->where('is_splem', 1)
                            ->get();

        foreach ($penyerahans as $penyerahan) {
            if($penyerahan->is_notif == 1) {
                $penyerahan->notifColor = "#FF9800";
                $penyerahan->notifStyle = 'margin-left:-22px; color:#0984E3;';
                $penyerahan->notifIcon = "fa fa-star ";
            }else {
                $penyerahan->notifColor = "#FF9800";
                $penyerahan->notifStyle = "";
                $penyerahan->notifIcon = "";
            }
        }
        
        return view('logistik.admin.penyerahan.index', ['penyerahans' => $penyerahans]);
    }

    public function getDetailByPenyerahanId($id)
    {
        $penyerahan = LogPengajuanMaterial::where('soft_delete', 0)
                            ->where('id', $id)
                            ->first();

                            
        $toUpdateNotificationPenyerahan['updated_at'] = date('Y-m-d');
        $toUpdateNotificationPenyerahan['is_notif'] = -1;
        $updatedPenyerahan = LogPengajuanMaterial::where('id', $penyerahan->id)->update($toUpdateNotificationPenyerahan);
        
            $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $penyerahan->id, 'soft_delete' => 0])
                                ->get();

        return view('logistik.admin.penyerahan.detail', ['details' => $details, 'penyerahan' => $penyerahan]);
    }

    public function postApproveDetailPenyerahan()
    {
        $idPenyerahan = \Input::All();
        $penyerahanSatuan = $idPenyerahan['penyerahanSatuan'];
        $pemyerahanJumlah = $idPenyerahan['pemyerahanJumlah'];

        $penyerahan = LogPengajuanMaterial::where('soft_delete', 0)
                            ->where('id', $idPenyerahan['id_penyerahan'])
                            ->first();

        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $penyerahan->id, 'soft_delete' => 0])
                            ->get();
                                
        if ($penyerahan) {      
            // $toUpdatedPenyerahan['cacatan_penyerahan'] = $cacatan;
            $toUpdatedPenerimaan['is_notif'] = 1;
            $permintaan = LogPenerimaanMaterial::where('soft_delete', 0)
                                                ->where('kode_penerimaan', $penyerahan->kode_penerimaan)
                                                ->update($toUpdatedPenerimaan);

            $penyarahanPermintaan = $penyerahan->pengajuanPenerimaanMaterial->kode_permintaan;

            $toUpdatedPermmintaan['status_penyerahan'] = 1;
            $toUpdatedPermmintaan['is_datang'] = 0;
            $permintaan = LogPermintaanMaterial::where('soft_delete', 0)
                                                ->where('kode_permintaan', $penyarahanPermintaan)
                                                ->update($toUpdatedPermmintaan);
            
            foreach ($details as $key => $detail) {
                $toUpdatedDetail['penyerahan_satuan'] = $penyerahanSatuan[$detail->material_id];
                $toUpdatedDetail['pemyerahan_jumlah'] = $pemyerahanJumlah[$detail->material_id];

                $updateDetail = LogDetailPengajuanMaterial::where('id',$detail->id)->update($toUpdatedDetail);
            }
            
            $toUpdatedPenyerahan['status_penyerahan'] = 1;
            $toUpdatedPenyerahan['updated_at'] = date('Y-m-d H:i:s');

            $updatedPenyerahan = LogPengajuanMaterial::where('id', $penyerahan->id)->update($toUpdatedPenyerahan);

            return redirect('Logistik/admin/penyerahan');
        }

        return view('logistik.admin.penyerahan.detail', ['details' => $details, 'penyerahan' => $penyerahan]);
    }
}

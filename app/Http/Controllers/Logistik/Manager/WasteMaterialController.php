<?php

namespace App\Http\Controllers\Logistik\Manager;

use App\Http\Controllers\Controller;
use App\Models\LogWaste;
use App\Models\LogWasteDetail;
use App\Models\LogWastePengajuan;
use App\Pegawai;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class WasteMaterialController extends Controller
{
    public function index()
    {
        $wastes = LogWaste::where('soft_delete', 0)->get();
        return view('logistik.manager.waste.index', ['wastes' => $wastes]);
    }

    public function getApprove($id)
    {
        $find = LogWastePengajuan::where('id', $id)->where('soft_delete', 0)->first();
        if ($find) {
            $waste = LogWaste::where('id', $find->waste_id)->where('soft_delete', 0)->first();
            if ($waste) {
                $details = LogWasteDetail::where('waste_id', $find->waste_id)->where('soft_delete', 0)->get();
            }
        }
        return view('logistik.manager.waste.approve', ['waste' => $waste, 'details' => $details]);
    }

    public function postApprove($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $find = LogWastePengajuan::where('id', $id)->where('soft_delete', 0)->first();
        if ($find) {
            //splem
            if (\Auth::user()->pegawai->posisi_id == 7) {
                $dt['is_splem'] = 1;
                $dt['is_splem_at'] = date('Y-m-d H:i:s');
                $dt['note_splem'] = \Input::get('note');
                $update = LogWastePengajuan::where('id', $id)->update($dt);
            } elseif (\Auth::user()->pegawai->posisi_id == 4) { //sem
                $dt['is_sem'] = 1;
                $dt['is_sem_at'] = date('Y-m-d H:i:s');
                $dt['note_sem'] = \Input::get('note');
                $update = LogWastePengajuan::where('id', $id)->update($dt);
            } elseif (\Auth::user()->pegawai->posisi_id == 5) { //scarm
                $dt['is_scarm'] = 1;
                $dt['is_scarm_at'] = date('Y-m-d H:i:s');
                $dt['note_scarm'] = \Input::get('note');
                $update = LogWastePengajuan::where('id', $id)->update($dt);
            }
        }
        return redirect('Logistik/manager/waste');
    }

}

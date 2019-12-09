<?php

namespace App\Http\Controllers\Logistik\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Models\LogWaste;
use App\Models\LogWasteDetail;
use App\Models\LogWastePengajuan;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class WasteMaterialController extends Controller
{
    public function index()
    {
        $wastes = LogWastePengajuan::where('soft_delete', 0)->get();
        return view('logistik.pm.waste.index', ['wastes' => $wastes]);
    }

    public function getApprove($id)
    {
        $find = LogWastePengajuan::where('id',$id)->where('soft_delete', 0)->first();
        if($find){
        	$waste = LogWaste::where('id',$find->waste_id)->where('soft_delete',0)->first();
        	if($waste){
        		$details = LogWasteDetail::where('waste_id',$find->waste_id)->where('soft_delete',0)->get();
        	}
        }
        return view('logistik.pm.waste.approve', ['waste' => $waste,'details'=>$details]);
    }

    public function postApprove($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
        $find = LogWastePengajuan::where('id',$id)->where('soft_delete', 0)->first();
        if($find){
        		$dt['is_pm'] = 1;
        		$dt['is_pm_at'] = date('Y-m-d H:i:s');
        		$dt['note_pm'] = \Input::get('note');;
        		$update = LogWastePengajuan::where('id',$id)->update($dt);
        }
        return redirect('Logistik/pm/waste');
    }
}

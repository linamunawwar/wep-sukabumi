<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Peralatan;

class PeralatanController extends Controller
{
    public function index()
    {
    	$alats = Peralatan::where('soft_delete',0)->get();
    	
        return view('manager.peralatan.index',['alats'=>$alats]);
    }

    public function getApprove($id)
    {
        $alat = Peralatan::where('id',$id)->update(['is_verif_sdm'=>1,'verif_sdm_at'=>date('Y-m-d H:i:s'),'verify_sdm_by' => \Auth::user()->id]);

        return redirect('manager/peralatan');
    }
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RkpController extends Controller
{
    public function index()
    {
    	$rkps = Rkp::where('soft_delete',0)->get();
        return view('admin.rkp.index',['rkps'=>$rkps]);
    }
}

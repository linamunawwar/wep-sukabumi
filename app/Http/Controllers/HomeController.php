<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Pegawai;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //admin
        if(Auth::user()->role_id == 1){
            return view('admin.home_admin');
        }
        
        //User
        if(Auth::user()->role_id == 2){
            $pegawai = Pegawai::find(Auth::user()->pegawai_id);
            return view('user.home_user',['pegawai'=>$pegawai]);
        }   

        //Manager
        if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4){
            return view('manager.home_manager');
        }

        //Project Manager
        if(Auth::user()->role_id == 5){
            return view('pm.home_pm');
        }
    }
}

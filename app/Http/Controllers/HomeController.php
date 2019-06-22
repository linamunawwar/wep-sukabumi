<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Pegawai;
use App\MemoPegawai;
use App\Cuti;
use App\Spj;
use App\Pecat;
use App\Resign;
use App\Izin;
use App\DisposisiTugas;
use App\SlipGaji;
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
            $pegawai = Pegawai::where('is_verif_admin',0)->where('soft_delete',0)->count();
            $memo = MemoPegawai::where('pegawai_id',Auth::user()->pegawai_id)->where('viewed_at',0)->where('soft_delete',0)->count();
            $cuti = Cuti::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $spj = Spj::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $pecat = Pecat::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $resign = Resign::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            return view('admin.home_admin',['pegawai'=>$pegawai,'memo'=>$memo,'cuti'=>$cuti,'spj'=>$spj,'pecat'=>$pecat,'resign'=>$resign]);
        }
        
        //User
        if(Auth::user()->role_id == 2){
            $pegawai = Pegawai::find(Auth::user()->pegawai_id);
            return view('user.home_user',['pegawai'=>$pegawai]);
        }   

        //Manager
        if(Auth::user()->role_id == 3){
            $memo = MemoPegawai::where('pegawai_id',Auth::user()->pegawai_id)->where('viewed_at',0)->where('soft_delete',0)->count();
            $cuti = Cuti::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $izin = Izin::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $pecat = Pecat::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $resign = Resign::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $disposisi = DisposisiTugas::where('status','!=',1)->where('soft_delete',0)
                    ->where('posisi_id',\Auth::user()->pegawai->posisi_id)->count();
            return view('manager.home_manager',['memo'=>$memo,'cuti'=>$cuti,'izin'=>$izin,'pecat'=>$pecat,'resign'=>$resign,'disposisi'=>$disposisi]);
        }

        //Manager SDM
        if(Auth::user()->role_id == 4){
            $memo = MemoPegawai::where('pegawai_id',Auth::user()->pegawai_id)->where('viewed_at',0)->where('soft_delete',0)->count();
            $cuti = Cuti::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $cuti_sdm = Cuti::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $cuti = $cuti + $cuti_sdm
            $izin = Izin::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $slip_gaji = SLipGaji::where('is_verif_sdm',0)->where('soft_delete',0)->count();
                 
            $pecat = Pecat::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $pecat_sdm = Pecat::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $pecat = $pecat + $pecat_sdm
            $resign = Resign::where('is_verif_mngr',0)->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            $resign_sdm = Resign::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $resign = $resign + $resign_sdm;
            $disposisi = DisposisiTugas::where('status','!=',1)->where('soft_delete',0)
                    ->where('posisi_id',\Auth::user()->pegawai->posisi_id)->count();
            return view('manager.home_manager_sdm',['memo'=>$memo,'cuti'=>$cuti,'izin'=>$izin,'pecat'=>$pecat,'resign'=>$resign,'disposisi'=>$disposisi,'slip_gaji'=>$slip_gaji ]);
        }

        //Project Manager
        if(Auth::user()->role_id == 5){
            return view('pm.home_pm');
        }
    }
}

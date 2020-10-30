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
use App\Rkp;
use App\Izin;
use App\Disposisi;
use App\DisposisiTugas;
use App\SlipGaji;
use App\Menu;
use App\Permission;
use App\Models\User;
use App\Models\LogMaterial;
use App\Models\LogPermintaanMaterial;
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
            $memo = MemoPegawai::where('user_id',Auth::user()->id)->where('viewed_at',0)->where('soft_delete',0)->count();
            $cuti = Cuti::where('is_verif_pengganti',1)->where('is_verif_admin',0)->where('soft_delete',0)->count();
            $spj = Spj::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $pecat = Pecat::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $resign = Resign::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            $rkp = Rkp::where('soft_delete',0)->where('viewed_at',null)->count();
            $disposisi = Disposisi::where('note_pm','!=',null)->where('soft_delete',0)->count();
            return view('admin.home_admin',['pegawai'=>$pegawai,'memo'=>$memo,'cuti'=>$cuti,'spj'=>$spj,'pecat'=>$pecat,'resign'=>$resign,'rkp'=>$rkp,'disposisi'=>$disposisi]);
        }
        
        //User
        if(Auth::user()->role_id == 2){
            $pegawai = Pegawai::find(Auth::user()->pegawai_id);
            $cuti = Cuti::where('pengganti',Auth::user()->pegawai_id)->where('is_verif_pengganti','!=',1)->get();
            session(['pengganti' =>count($cuti)]);
            return view('user.home_user',['pegawai'=>$pegawai,'cuti'=>$cuti]);
        }   

        //Manager
        if(Auth::user()->role_id == 3){
            $memo = MemoPegawai::where('user_id',Auth::user()->id)->where('viewed_at',0)->where('soft_delete',0)->count();
            $disposisi = DisposisiTugas::where('status','!=',1)->where('soft_delete',0)
                        ->where('posisi_id',\Auth::user()->pegawai->posisi_id)->count();

            if((\Auth::user()->pegawai->kode_bagian == 'QHSE') || (\Auth::user()->pegawai->kode_bagian == 'QC') || (\Auth::user()->pegawai->kode_bagian == 'HS')){
              $cutis_qhse = Cuti::where('is_verif_admin',1)->where('is_verif_mngr',0)->where('soft_delete',0)
                                ->whereHas('pegawai',function ($q){
                          $q->where('kode_bagian', 'QHSE');
                      })->count();

              $cutis_qc = Cuti::where('is_verif_admin',1)->where('is_verif_mngr',0)->where('soft_delete',0)
                                ->whereHas('pegawai',function ($q){
                          $q->where('kode_bagian', 'QC');
                      })->count();

              $cutis_hs = Cuti::where('is_verif_admin',1)->where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', 'HS');
                    })->count();

              $cuti= $cutis_qhse + $cutis_qc + $cutis_hs;
              

              //izin
              $izin_qhse = Izin::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'QHSE');
              })->count();

              $izin_qc = Izin::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'QC');
              })->count();

              $izin_hs = Izin::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'HS');
              })->count();

                $izin = $izin_qhse + $izin_hs + $izin_qc;

              //pecat
              $pecat_qhse = Pecat::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'QHSE');
              })->count();

              $pecat_qc = Pecat::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'QC');
              })->count();

              $pecat_hs = Pecat::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'HS');
              })->count();

                $pecat = $pecat_qhse + $pecat_qc + $pecat_hs;

              //resign
              $resign_qhse = Resign::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'QHSE');
              })->count();

              $resign_qc = Resign::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'QC');
              })->count();


              $resign_hs = Resign::where('is_verif_mngr',0)->where('soft_delete',0)
                        ->whereHas('pegawai',function ($q){
                  $q->where('kode_bagian', 'HS');
              })->count();

              $resign = $resign_qhse + $resign_qc + $resign_hs;

            }else{
                $cuti = Cuti::where('is_verif_admin',1)->where('is_verif_mngr',0)->where('soft_delete',0)
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
            }
            return view('manager.home_manager',['memo'=>$memo,'cuti'=>$cuti,'izin'=>$izin,'pecat'=>$pecat,'resign'=>$resign,'disposisi'=>$disposisi]);
        }

        //Manager SDM
        if(Auth::user()->role_id == 4){
            $memo = MemoPegawai::where('user_id',Auth::user()->id)->where('viewed_at',0)->where('soft_delete',0)->count();
            // $cuti = Cuti::where('is_verif_mngr',0)->where('soft_delete',0)
            //         ->whereHas('pegawai',function ($q){
            //             $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
            //         })->count();
            $cuti = Cuti::where('is_verif_pengganti',1)
                    ->where('is_verif_admin',1)
                    ->where('is_verif_mngr',1)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->orwhere('is_verif_mngr',0)
                    ->where('is_verif_sdm',0)
                    ->where('is_verif_pengganti',1)
                    ->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })
                    ->count();
            // $cuti = $cuti + $cuti_sdm;
            $izin = Izin::where('is_verif_mngr',1)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->orwhere('is_verif_mngr',0)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })
                    ->count();
            $slip_gaji = SLipGaji::whereNull('is_verif_sdm')->where('soft_delete',0)->count();
                 
            $pecat = Pecat::where('is_verif_mngr',1)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->orwhere('is_verif_mngr',0)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            // $pecat_sdm = Pecat::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            // $pecat = $pecat + $pecat_sdm;
            $resign = Resign::where('is_verif_mngr',1)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->orwhere('is_verif_mngr',0)
                    ->where('is_verif_sdm',0)
                    ->where('soft_delete',0)
                    ->whereHas('pegawai',function ($q){
                        $q->where('kode_bagian', \Auth::user()->pegawai->kode_bagian);
                    })->count();
            // $resign_sdm = Resign::where('is_verif_sdm',0)->where('soft_delete',0)->count();
            // $resign = $resign + $resign_sdm;
            $spj = Spj::where('is_verif_sdm','!=',1)->where('soft_delete',0)->count();
            $disposisi = DisposisiTugas::where('status','!=',1)->where('soft_delete',0)
                    ->where('posisi_id',\Auth::user()->pegawai->posisi_id)->count();
            return view('manager.home_manager_sdm',['memo'=>$memo,'cuti'=>$cuti,'izin'=>$izin,'pecat'=>$pecat,'resign'=>$resign,'disposisi'=>$disposisi,'slip_gaji'=>$slip_gaji,'spj'=>$spj ]);
        }

        //Project Manager
        if(Auth::user()->role_id == 5){
            $pegawai = Pegawai::where('is_verif_admin',0)->where('soft_delete',0)->count();
            $memo = MemoPegawai::where('user_id',Auth::user()->id)->where('viewed_at',0)->where('soft_delete',0)->count();
            $cuti = Cuti::where('is_verif_pm',0)
                    ->where('is_verif_pengganti',1)
                    ->where('is_verif_admin',1)
                    ->where('is_verif_mngr',1)
                    ->where('is_verif_sdm',1)
                    ->where('soft_delete',0)->count();
            $pecat = Pecat::where('is_verif_pm',0)->where('soft_delete',0)->count();
            $resign = Resign::where('is_verif_pm',0)->where('soft_delete',0)->count();
            $disposisi = Disposisi::where('note_pm',null)->where('soft_delete',0)->count();
            $rkp = Rkp::where('is_verif_pm',0)->where('soft_delete',0)->count();

            return view('pm.home_pm',['pegawai'=>$pegawai,'memo'=>$memo,'cuti'=>$cuti,'pecat'=>$pecat,'resign'=>$resign,'disposisi'=>$disposisi,'rkp'=>$rkp]);
        }

        if(Auth::user()->role_id == 6){
            $materials = LogMaterial::where('soft_delete',0)->count();
            $permintaan = LogPermintaanMaterial::where('soft_delete',0)->count();
            $permintaan_disetujui = LogPermintaanMaterial::where('soft_delete',0)
            ->where('is_pm',1)
            ->count();
            
            return view('logistik.admin.home',['materials'=>$materials,'permintaan'=>$permintaan,'permintaan_disetujui'=>$permintaan_disetujui]);
        }
    }

    public function insertPermission($role_id)
    {
        $menus = Menu::where('default_role',$role_id)->where('active',1)->get();
        $users = User::where('role_id',$role_id)->get();
        foreach ($users as $key => $user) {
            foreach ($menus as $key => $menu) {
                $permission = new Permission;
                $permission->id_menu = $menu->id;
                $permission->id_user = $user->id;
                $permission->save();
            }
        }
    }
}

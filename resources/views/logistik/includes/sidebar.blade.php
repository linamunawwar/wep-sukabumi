<div class="col-md-3 left_col">
    <div class="left_col scroll-view" style="background: #00004E;">
        <div class="navbar nav_title" style="border: 0; background: white; width: 100%; margin-bottom: 20px;">
            <a href="{{ url('/') }}" class="site_title"><img src="{{asset('public/img/Waskita-noback.png')}}" width="40px" height="25px" style="color: white!important;"> <span style="color: #172D44 !important;">WEP - Logistik WEP </span></a>
        </div>
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="background: #00004E;">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if((Auth::user()->pegawai->kode_bagian == 'SL') || (Auth::user()->role_id == 2) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4) || (Auth::user()->role_id == 5))
                        <li>
                            <a href="{{url('/Logistik')}}">
                                <i class="fa fa-laptop"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        <!-------------------------PERMINTAAN ------------------------->
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('Logistik/user/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('Logistik/manager/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                    @if(count(notifApprovePermintaanManager()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; ">
                                            {{count(notifApprovePermintaanManager())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('Logistik/pm/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                    @if(count(notifApprovePermintaanManager()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; ">
                                            {{count(notifApprovePermintaanManager())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('Logistik/admin/permintaan/')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        <!------------------------------------------------------------->
                        <!-------------------------PENERIMAAN ------------------------->
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('Logistik/user/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                    @if(count(notif_penerimaan_baru()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="Barang yang diminta datang">
                                            {{count(notif_penerimaan_baru())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('Logistik/manager/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                    @if(count(notifApprovePenerimaanManager()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="Harus Diapprove">
                                            {{count(notifApprovePenerimaanManager())}}
                                        </span>
                                    @endif
                                    @if(count(notif_penerimaan_baru()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="Barang yang diminta datang">
                                            {{count(notif_penerimaan_baru())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('Logistik/pm/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                    @if(count(notif_penerimaan_baru()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="Barang yang diminta datang" >
                                            {{count(notif_penerimaan_baru())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('Logistik/admin/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                    @if(count(notif_penerimaan_baru()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="Barang yang diminta datang">
                                            {{count(notif_penerimaan_baru())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        <!--------------------------------------------------->
                        <!--------------Pengajuan Pemakaian------------------>
                        @if((Auth::user()->role_id == 2) && ((Auth::user()->pegawai->posisi_id == 46) || (Auth::user()->pegawai->posisi_id == 45)))
                            <li>
                                <a href="{{url('Logistik/user/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                    @if(count(notif_konfirmasi_penerimaan()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="konfirmasi penerimaan">
                                            {{count(notif_konfirmasi_penerimaan())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @elseif(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('Logistik/user/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                    @if(count(notif_konfirmasi_penerimaan()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="konfirmasi penerimaan">
                                            {{count(notif_konfirmasi_penerimaan())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('Logistik/manager/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                    @if(count(notifApprovePengajuanManager()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="Harus Diapprove">
                                            {{count(notifApprovePengajuanManager())}}
                                        </span>
                                    @endif
                                    @if(count(notif_konfirmasi_penerimaan()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="konfirmasi penerimaan">
                                            {{count(notif_konfirmasi_penerimaan())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('Logistik/pm/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                    @if(count(notif_konfirmasi_penerimaan()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="konfirmasi penerimaan">
                                            {{count(notif_konfirmasi_penerimaan())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('Logistik/admin/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                    @if(count(notif_konfirmasi_penerimaan()) != 0)
                                        <span class="badge bg" style="background-color: #1AAD19; " title="konfirmasi penerimaan">
                                            {{count(notif_konfirmasi_penerimaan())}}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        <!------------------------------------------------------------->
                        <!------------------ PERMINTAAN PENYERAHAN -------------------->
                        {{--  @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('Logistik/user/penyerahan')}}">
                                    <i class="fa fa-list"></i>
                                    Penyerahan Barang
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('Logistik/manager/penyerahan')}}">
                                    <i class="fa fa-list"></i>
                                    Penyerahan Barang
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('Logistik/pm/penyerahan')}}">
                                    <i class="fa fa-list"></i>
                                    Penyerahan Barang
                                </a>
                            </li>
                        @endif  --}}
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('Logistik/admin/penyerahan')}}">
                                    <i class="fa fa-list"></i>
                                    Penyerahan Barang
                                </a>
                            </li>
                        @endif
                        <!---------------------------------------------------->
                        <!--------------------------WASTE MATERIAL------------>
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('Logistik/manager/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('Logistik/pm/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li><a><i class="fa fa-trash"></i> Waste Material <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('Logistik/admin/waste')}}"> Data Waste Material</a></li>
                                    <li><a href="{{url('Logistik/admin/waste/pengajuan')}}"> Pengajuan Data Waste Material</a></li>
                                </ul>
                            </li>
                        @endif
                        <!------------------------------------------------------>
                        <li><a><i class="fa fa-sign-out"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(Auth::user()->role_id == 2)
                                <li><a href="{{url('Logistik/user/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('Logistik/user/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('Logistik/user/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('Logistik/user/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('Logistik/user/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4)) 
                                <li><a href="{{url('Logistik/manager/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('Logistik/manager/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('Logistik/manager/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('Logistik/manager/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('Logistik/manager/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if(Auth::user()->role_id == 5)
                                <li><a href="{{url('Logistik/pm/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('Logistik/pm/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('Logistik/pm/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('Logistik/pm/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('Logistik/pm/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if(Auth::user()->role_id == 6)
                                <li><a href="{{url('Logistik/admin/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('Logistik/admin/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('Logistik/admin/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('Logistik/admin/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('Logistik/admin/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                        </ul>
                        <!------------------------- MASTER ---------------------------->
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4) || (Auth::user()->role_id == 6))
                            <li><a><i class="fa fa-sign-out"></i> Tabel Master <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                    <li><a href="{{url('Logistik/admin/material/')}}">Material</a></li>
                                    <li><a href="{{url('Logistik/admin/lokasi')}}">Lokasi Pekerjaan</a></li>
                                    <li><a href="{{url('Logistik/admin/jenis_pekerjaan')}}">Jenis Pekerjaan</a></li>
                            </ul>
                        @endif
                        <!------------------------------------------------------------->
                    @endif
                    

                </ul>
            </div>
            
        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small" style="width: 230px;background: #00004E;">
            <a data-toggle="tooltip" data-placement="top" title="Settings" style="background: #000030;">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen" style="background: #000030;">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock" style="background: #000030;">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}" style="background: #000030;">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
<div class="col-md-3 left_col" style="width: 240px; ">
    <div class="left_col scroll-view" style="background: #00004E;">
        <div class="navbar nav_title" style="border: 0; background: white; width: 100%; margin-bottom: 10px;">
            <a href="{{ url('/') }}" class="site_title"><img src="{{asset('public/img/Waskita-noback.png')}}" width="40px" height="25px" style="color: white!important;"> <span style="color: #172D44 !important;">WEP - Logistik WEP </span></a>
        </div>
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="background: #00004E;">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if((Auth::user()->pegawai->kode_bagian == 'SL') || (\Auth::user()->role_id == 3) || (\Auth::user()->role_id == 4) || (\Auth::user()->role_id == 5))
                        <li>
                            <a href="{{url('/logistik')}}">
                                <i class="fa fa-laptop"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        <!-------------------------PERMINTAAN ------------------------->
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('logistik/user/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('logistik/manager/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('logistik/pm/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('logistik/admin/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        <!------------------------------------------------------------->
                        <!-------------------------PENERIMAAN ------------------------->
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('logistik/user/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('logistik/manager/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('logistik/pm/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('logistik/admin/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                        <!--------------------------------------------------->
                        <!--------------Pengajuan Pemakaian------------------>
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('logistik/user/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('logistik/manager/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('logistik/pm/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('logistik/admin/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                        <!---------------------------------------------------->
                        <!--------------------------WASTE MATERIAL------------>
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('logistik/user/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('logistik/manager/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('logistik/pm/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li><a><i class="fa fa-trash"></i> Waste Material <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{url('logistik/admin/waste')}}"> Data Waste Material</a></li>
                                    <li><a href="{{url('logistik/admin/waste/pengajuan')}}"> Pengajuan Data Waste Material</a></li>
                                </ul>
                            </li>
                        @endif
                        <!------------------------------------------------------>
                        <li><a><i class="fa fa-sign-out"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(Auth::user()->role_id == 2)
                                <li><a href="{{url('logistik/user/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('logistik/user/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('logistik/user/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('logistik/user/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('logistik/user/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4)) 
                                <li><a href="{{url('logistik/manager/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('logistik/manager/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('logistik/manager/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('logistik/manager/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('logistik/manager/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if(Auth::user()->role_id == 5)
                                <li><a href="{{url('logistik/pm/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('logistik/pm/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('logistik/pm/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('logistik/pm/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('logistik/pm/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if(Auth::user()->role_id == 6)
                                <li><a href="{{url('logistik/admin/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('logistik/admin/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('logistik/admin/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('logistik/admin/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('logistik/admin/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                        </ul>
                        <!------------------------- MASTER ---------------------------->
                        <li><a><i class="fa fa-book"></i> Tabel Master <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(Auth::user()->role_id == 6)
                                <li><a href="{{url('logistik/admin/material/')}}">Material</a></li>
                                <li><a href="{{url('logistik/admin/lokasi')}}">Lokasi Pekerjaan</a></li>
                                <li><a href="{{url('logistik/admin/jenis_pekerjaan')}}">Jenis Pekerjaan</a></li>
                            @endif
                        </ul>
                        <!------------------------------------------------------------->
                    @endif
                    

                </ul>
            </div>
            
        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small" style="width: 240px;background: #00004E;">
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
<div class="col-md-3 left_col" style="width: 240px; ">
    <div class="left_col scroll-view" style="background: #00004E;">
        <div class="navbar nav_title" style="border: 0; background: white; width: 100%; margin-bottom: 10px;">
            <a href="{{ url('/') }}" class="site_title"><img src="{{asset('public/img/Waskita-noback.png')}}" width="40px" height="25px" style="color: white!important;"> <span style="color: #172D44 !important;">WEP -  Becakayu 2A</span></a>
        </div>
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="background: #00004E;">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if(Auth::user()->pegawai->kode_bagian == 'SL')
                        <li>
                            <a href="{{url('/logistik')}}">
                                <i class="fa fa-laptop"></i>
                                Dashboard
                            </a>
                        </li>
                        <!-------------------------PERMINTAAN ------------------------->
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('user/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('manager/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('pm/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('admin/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Permintaan Barang
                                </a>
                            </li>
                        @endif
                        <!------------------------------------------------------------->
                        <!-------------------------PENERIMAAN ------------------------->
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('user/permintaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('manager/penerimaah')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('pm/penerimaah')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('admin/penerimaan')}}">
                                    <i class="fa fa-list"></i>
                                    Penerimaan Barang
                                </a>
                            </li>
                        @endif
                        <!--------------------------------------------------->
                        <!--------------Pengajuan Pemakaian------------------>
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('user/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('manager/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('pm/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('admin/pengajuan')}}">
                                    <i class="fa fa-list"></i>
                                    Pengajuan Pemakaian
                                </a>
                            </li>
                        @endif
                        <!---------------------------------------------------->
                        <!--------------------------WASTE MATERIAL------------>
                        @if(Auth::user()->role_id == 2)
                            <li>
                                <a href="{{url('user/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                        @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                            <li>
                                <a href="{{url('manager/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                         @if(Auth::user()->role_id == 5)
                            <li>
                                <a href="{{url('pm/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role_id == 6)
                            <li>
                                <a href="{{url('admin/waste')}}">
                                    <i class="fa fa-list"></i>
                                    Waste Material
                                </a>
                            </li>
                        @endif
                        <!------------------------------------------------------>
                        <li><a><i class="fa fa-sign-out"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(Auth::user()->role_id == 2)
                                <li><a href="{{url('user/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('user/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('user/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('user/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('user/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4)) 
                                <li><a href="{{url('manager/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('manager/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('manager/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('manager/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('manager/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if(Auth::user()->role_id == 5)
                                <li><a href="{{url('pm/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('pm/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('pm/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('pm/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('pm/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
                            @if(Auth::user()->role_id == 6)
                                <li><a href="{{url('admin/kartu_gudang')}}">Kartu Gudang</a></li>
                                <li><a href="{{url('admin/eval_mingguan')}}">Evaluasi Mingguan Pengadaan</a></li>
                                <li><a href="{{url('admin/harian_gudang')}}">Harian Gudang</a></li>
                                <li><a href="{{url('admin/eval_pakai')}}">Evaluasi Pemakaian Material</a></li>
                                <li><a href="{{url('admin/harian_pakai')}}">Harian Pemakaian Material</a></li>
                            @endif
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
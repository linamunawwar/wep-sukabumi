<div class="col-md-3 left_col" style="width: 240px; position: ;">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0; background: #E7E7E7; width: 100%; margin-bottom: 10px;">
            <a href="{{ url('/') }}" class="site_title"><img src="{{asset('public/img/Waskita-noback.png')}}" width="40px" height="25px"> <span style="color: #172D44 !important;">WEP -  Becakayu 2A</span></a>
        </div>
        
        <!-- <div class="clearfix"></div> -->
        
        <!-- menu profile quick info -->
        <!-- <div class="profile">
            <div class="profile_pic">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div> -->
        <!-- /menu profile quick info -->
        
        <br />
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li>
                        <a href="{{url('/')}}">
                            <i class="fa fa-laptop"></i>
                            Dashboard
                            <span class="label label-success pull-right">Flag</span>
                        </a>
                    </li>
                    <li><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                                <li><a href="{{url('/pegawai')}}">Data Pegawai</a></li>
                                <li><a href="{{url('pegawai/struktur')}}">Struktur Pegawai</a></li>
                                <li><a href="{{url('pegawai/prod5')}}">PROD 05</a></li>
                                <li><a href="{{url('pegawai/pecat')}}">Pemecatan</a></li>
                                <li><a href="{{url('pegawai/resign')}}">Pengajuan Resign</a></li>
                            @endif
                            @if(Auth::user()->role_id == 2)
                                <li><a href="{{url('/pegawai/user')}}">Data Pegawai</a></li>
                                <li><a href="{{url('pegawai/user/struktur')}}">Struktur Pegawai</a></li>
                                <li><a href="{{url('pegawai/user/resign')}}">Pengajuan Resign</a></li>
                            @endif

                        </ul>
                    </li>
                    <li><a><i class="fa fa-sign-out"></i> Cuti / Izin <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                             @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                                <li><a href="{{url('cuti')}}">Cuti</a></li>
                                <li><a href="{{url('izin')}}">Izin</a></li>
                            @endif
                            @if(Auth::user()->role_id == 2)
                                <li><a href="{{url('user/cuti')}}">Cuti</a></li>
                                <li><a href="{{url('user/izin')}}">Izin</a></li>
                                <li><a href="{{url('user/serah_tugas')}}">Penyerahan Tugas</a></li>
                            @endif
                        </ul>
                    </li>
                     @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                        <li><a href="{{url('gaji')}}"><i class="fa fa-money"></i>Gaji - Tunjangan </a>
                         </li>
                    @endif
                    @if(Auth::user()->role_id == 2)
                        <li><a><i class="fa fa-money"></i>Gaji - Tunjangan <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('user/gaji')}}"><i class="fa fa-money"></i>Data Gaji</a></li>
                                <li><a href="{{url('user/gaji/slip_gaji')}}"><i class="fa fa-credit-card"></i>Pengajuan Slip Gaji</a></li>
                            </ul>
                        </li>
                    @endif
                    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))    
                        <li><a href="{{url('/memo')}}"><i class="fa fa-paper-plane"></i>Pesan Internal </a>
                    @endif
                    @if(Auth::user()->role_id == 2)
                        <li><a href="{{url('/user/memo')}}"><i class="fa fa-paper-plane"></i>Pesan Internal </a></li>
                    @endif


                    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                        <li><a href="{{url('spj')}}"><i class="fa fa-exchange"></i>SPJ</a></li>
                    @endif

                    @if(Auth::user()->role_id == 2)
                         <li><a href="{{url('/user/spj')}}"><i class="fa fa-exchange"></i>SPJ</a></li>
                    @endif

                    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                        <li><a><i class="fa fa-envelope"></i>Disposisi <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('surat_masuk')}}">List Surat Masuk</a></li>
                                <li><a href="{{url('disposisi')}}">List Disposisi</a></li>
                            </ul>
                        </li>
                    @endif

                    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                    <li>
                        <a href="{{url('rkp')}}">
                            <i class="fa fa-list-alt"></i>
                            Rencana Kebutuhan Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="{{url('pelatihan')}}">
                            <i class="fa fa-list"></i>
                            Form Kebutuhan Pelatihan
                        </a>
                    </li>
                    <li>
                        <a href="{{url('peralatan')}}">
                            <i class="fa fa-gears"></i>
                            Peralatan Penunjang
                            <span class="label label-success pull-right">Flag</span>
                        </a>
                    </li>
                    @endif

                    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                    <li>
                        <a href="{{url('arsip')}}">
                            <i class="fa fa-folder-open"></i>
                            Arsip Berkas
                            <span class="label label-success pull-right">Flag</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->role_id == 2)
                    <li>
                        <a href="{{url('user/arsip')}}">
                            <i class="fa fa-folder-open"></i>
                            Arsip Berkas
                            <span class="label label-success pull-right">Flag</span>
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
            
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small" style="width: 238px;">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
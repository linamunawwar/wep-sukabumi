<div class="col-md-3 left_col" style="width: 240px; ">
    <div class="left_col scroll-view" style="background: #00004E;">
        <div class="navbar nav_title" style="border: 0; background: white; width: 100%; margin-bottom: 10px;">
            <a href="{{ url('/') }}" class="site_title"><img src="{{asset('public/img/Waskita-noback.png')}}" width="40px" height="25px" style="color: white!important;"> <span style="color: #172D44 !important;">WEP -  Becakayu 2A</span></a>
        </div>
        <?php
            use App\Permission;
            $menus = Permission::where('id_user', Auth::user()->id)->get();
            foreach ($menus as $key => $value) {
                if($value->menu->id_parent == 0){
                    $parent[$value->id_menu]['id_menu']=$value->id_menu;
                    $parent[$value->id_menu]['nama']=$value->menu->nama;
                    $parent[$value->id_menu]['alias']=$value->menu->alias;
                    $parent[$value->id_menu]['direktori']=$value->menu->direktori;
                    $parent[$value->id_menu]['icon']=$value->menu->icon;
                    $i=0;
                }else{
                    if(array_key_exists($value->menu->id_parent, $parent)){
                        $parent[$value->menu->id_parent]['sub'][$i]['id_menu'] = $value->id_menu;
                        $parent[$value->menu->id_parent]['sub'][$i]['nama'] = $value->menu->nama;
                        $parent[$value->menu->id_parent]['sub'][$i]['alias'] = $value->menu->alias;
                        $parent[$value->menu->id_parent]['sub'][$i]['direktori'] = $value->menu->direktori;
                        $parent[$value->menu->id_parent]['sub'][$i]['icon'] = $value->menu->icon;
                        $i++;
                    }
                }
            }
        ?>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="background: #00004E;">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if((Auth::user()->pegawai->posisi_id == 45) || (Auth::user()->pegawai->posisi_id == 46) || (\Auth::user()->role_id == 3) || (\Auth::user()->role_id == 4) || (\Auth::user()->role_id == 5))
                        <li>
                            <a href="{{url('/Logistik')}}">
                                <i class="fa fa-laptop"></i>
                                LOGISTIK
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{url('/')}}">
                            <i class="fa fa-laptop"></i>
                            Dashboard
                        </a>
                    </li>
                    @if(Auth::user()->pegawai_id=='SO151094')
                        @foreach($parent as $menu)
                            <li>
                                @if($menu['direktori'] != '')
                                    <a href="{{url($menu['direktori'])}}">
                                @else
                                    <a>
                                @endif
                                    <i class="fa {{$menu['icon']}}"></i>
                                    {{$menu['alias']}}
                                    @if(array_key_exists('sub',$menu))
                                        <span class="fa fa-chevron-down"></span>
                                    @endif
                                </a>
                                @if(array_key_exists('sub',$menu))
                                    <ul class="nav child_menu">
                                        @foreach($menu['sub'] as $sub)
                                            <li>
                                                <a href="{{url($sub['direktori'])}}">
                                                    <i class="fa {{$sub['icon']}}"></i>{{$sub['alias']}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                    @else
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4) || (Auth::user()->role_id == 5)) 
                                <li>
                                <a href="{{url('user/pegawai')}}">
                                    <i class="fa fa-list"></i>
                                    Data Diri
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 1)
                                <li><a><i class="fa fa-lock"></i>Menu & Permissions <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('admin/menu')}}"><i class="fa fa-unlock-alt"></i>Master Menu</a></li>
                                        <li><a href="{{url('admin/permission')}}"><i class="fa fa-unlock"></i>Permissions Pegawai</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    @if(Auth::user()->role_id == 1) 
                                        <li><a href="{{url('admin/pegawai')}}">Data Pegawai</a></li>
                                        <li><a href="{{url('admin/pegawai_non_aktif')}}">Data Pegawai Non Aktif</a></li>
                                        <li><a href="{{url('admin/pegawai/struktur')}}">Struktur Pegawai</a></li>
                                        <li><a href="{{url('admin/pegawai/prod05')}}">PROD 05</a></li>
                                        <li><a href="{{url('admin/pegawai/pecat')}}">Pemberhentian Kerja</a></li>
                                        <li><a href="{{url('admin/pegawai/resign')}}">Pengajuan Resign</a></li>
                                        <li><a href="{{url('admin/pegawai/pelatihan')}}">Monitoring Pelatihan</a></li>
                                    @endif

                                    @if(Auth::user()->role_id == 2)
                                        <li><a href="{{url('user/pegawai')}}">Data Pegawai</a></li>
                                        <li><a href="{{url('user/pegawai/struktur')}}">Struktur Pegawai</a></li>
                                        <li><a href="{{url('user/pegawai/resign')}}">Pengajuan Resign</a></li>
                                    @endif

                                    @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                                        <li><a href="{{url('manager/pegawai')}}">Data Pegawai</a></li>
                                        <li><a href="{{url('manager/pegawai_non_aktif')}}">Data Pegawai Non Aktif</a></li>
                                        <li><a href="{{url('manager/pegawai/struktur')}}">Struktur Pegawai</a></li>
                                        <li><a href="{{url('manager/pegawai/pecat')}}">Pemberhentian Kerja</a></li>
                                        <li><a href="{{url('manager/pegawai/resign')}}">Pengajuan Resign</a></li>
                                    @endif 

                                    @if(Auth::user()->role_id == 5)
                                        <li><a href="{{url('pm/pegawai')}}">Data Pegawai</a></li>
                                        <li><a href="{{url('pm/pegawai_non_aktif')}}">Data Pegawai Non Aktif</a></li>
                                        <li><a href="{{url('pm/pegawai/struktur')}}">Struktur Pegawai</a></li>
                                        <li><a href="{{url('pm/pegawai/pecat')}}">Pemberhentian Kerja</a></li>
                                        <li><a href="{{url('pm/pegawai/resign')}}">Pengajuan Resign</a></li>
                                    @endif
                                    
                                </ul>
                            </li>
                            <li><a><i class="fa fa-sign-out"></i> Cuti / Izin <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    @if(Auth::user()->role_id == 1)
                                        <li><a href="{{url('admin/cuti')}}">Cuti</a></li>
                                        <li><a href="{{url('admin/izin')}}">Izin</a></li>
                                    @endif

                                    @if(Auth::user()->role_id == 2)
                                        <li><a href="{{url('user/cuti')}}">Cuti</a></li>
                                        <li><a href="{{url('user/izin')}}">Izin</a></li>
                                        <li><a href="{{url('user/cuti/serah_tugas')}}">Penyerahan Tugas</a></li>
                                    @endif

                                    @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                                        <li><a href="{{url('manager/cuti')}}">Cuti</a></li>
                                        <li><a href="{{url('manager/pengajuan_cuti')}}">Pengajuan Cuti</a></li>
                                        <li><a href="{{url('manager/izin')}}">Izin</a></li>
                                        <li><a href="{{url('manager/pengajuan_izin')}}">Pengajuan Izin</a></li>
                                    @endif

                                    @if(Auth::user()->role_id == 5)
                                        <li><a href="{{url('pm/cuti')}}">Cuti</a></li>
                                        <li><a href="{{url('pm/pengajuan_cuti')}}">Pengajuan Cuti</a></li>
                                        <!-- <li><a href="{{url('pm/izin')}}">Izin</a></li> -->
                                        <li><a href="{{url('pm/pengajuan_izin')}}">Pengajuan Izin</a></li>
                                    @endif


                                </ul>
                            </li>
                             @if(Auth::user()->role_id == 1)
                                <li><a><i class="fa fa-money"></i>Gaji - Tunjangan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('admin/gaji')}}"><i class="fa fa-money"></i>Data Gaji</a></li>
                                        <li><a href="{{url('admin/gaji/slip_gaji')}}"><i class="fa fa-credit-card"></i>Pengajuan Slip Gaji</a></li>
                                    </ul>
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
                            @if(Auth::user()->role_id == 3)
                                <li><a href="{{url('manager/gaji')}}"><i class="fa fa-money"></i>Gaji - Tunjangan </a>
                                 </li>
                            @endif
                            @if(Auth::user()->role_id == 4)
                                <li><a><i class="fa fa-money"></i>Gaji - Tunjangan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('manager/gaji')}}"><i class="fa fa-money"></i>Data Gaji</a></li>
                                        <li><a href="{{url('manager/gaji/slip_gaji')}}"><i class="fa fa-credit-card"></i>Pengajuan Slip Gaji</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == 5)
                                <li><a href="{{url('pm/gaji')}}"><i class="fa fa-money"></i>Gaji - Tunjangan </a>
                                 </li>
                            @endif

                            @if(Auth::user()->role_id == 1)
                                <li><a href="{{url('admin/memo')}}"><i class="fa fa-paper-plane"></i>Pesan Internal </a>
                            @endif
                            @if(Auth::user()->role_id == 2)
                                <li><a href="{{url('/user/memo')}}"><i class="fa fa-paper-plane"></i>Pesan Internal </a></li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                                <li><a href="{{url('manager/memo')}}"><i class="fa fa-paper-plane"></i>Pesan Internal </a>
                            @endif
                            @if(Auth::user()->role_id == 5)
                                <li><a href="{{url('/pm/memo')}}"><i class="fa fa-paper-plane"></i>Pesan Internal </a></li>
                            @endif


                            @if(Auth::user()->role_id == 1)
                                <li><a href="{{url('admin/spj')}}"><i class="fa fa-exchange"></i>SPJ</a></li>
                            @endif

                            @if(Auth::user()->role_id == 2)
                                 <li><a href="{{url('/user/spj')}}"><i class="fa fa-exchange"></i>SPJ</a></li>
                            @endif

                            @if(Auth::user()->role_id == 4) 
                                <li><a><i class="fa fa-exchange"></i>SPJ <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('manager/spj')}}"><i class="fa fa-exchange"></i>Pengajuan SPJ Pegawai</a></li>
                                        <li><a href="{{url('manager/spj/pengajuan')}}"><i class="fa fa-list"></i>List Daftar Pengajuan SPJ Pegawai</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == 3)
                                 <li><a href="{{url('/manager/spj')}}"><i class="fa fa-exchange"></i>SPJ</a></li>
                            @endif

                            @if(Auth::user()->role_id == 5)
                                 <li><a href="{{url('/pm/spj')}}"><i class="fa fa-exchange"></i>SPJ</a></li>
                            @endif

                            @if((Auth::user()->role_id == 1) || (Auth::user()->pegawai_id == 'SE150795'))
                                <li><a><i class="fa fa-envelope"></i>Disposisi Surat Masuk<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <!-- <li><a href="{{url('admin/surat_masuk')}}">List Surat Masuk</a></li> -->
                                        <li><a href="{{url('admin/disposisi')}}">List Disposisi Surat Masuk</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                                <li><a href="{{url('manager/disposisi')}}"><i class="fa fa-envelope"></i>List Disposisi Surat Masuk</a></li>
                            @endif
                            @if(Auth::user()->role_id == 5)
                                <li><a><i class="fa fa-envelope"></i>Disposisi Surat Masuk<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <!-- <li><a href="{{url('pm/surat_masuk')}}">List Surat Masuk</a></li> -->
                                        <li><a href="{{url('pm/disposisi')}}">List Disposisi Surat Masuk</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if((Auth::user()->role_id == 1) || (Auth::user()->pegawai_id == 'SE150795') || (Auth::user()->pegawai_id == 'HS051096') || (Auth::user()->pegawai_id == 'SC110293') || (Auth::user()->pegawai_id == 'SO151294') || (Auth::user()->pegawai_id == 'SA180894') || (Auth::user()->pegawai_id == 'SC200891') || (Auth::user()->pegawai_id == 'HS190994'))
                             <li>
                                <a href="{{url('admin/surat_keluar')}}">
                                    <i class="fa fa-envelope-o"></i>
                                    Surat Keluar
                                </a>
                            </li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                             <li>
                                <a href="{{url('manager/surat_keluar')}}">
                                    <i class="fa fa-envelope-o"></i>
                                    Surat Keluar
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 5)
                             <li>
                                <a href="{{url('pm/surat_keluar')}}">
                                    <i class="fa fa-envelope-o"></i>
                                    Surat Keluar
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 1)
                                <li>
                                    <a href="{{url('admin/rkp')}}">
                                        <i class="fa fa-list-alt"></i>
                                        Rencana Kebutuhan Pegawai
                                    </a>
                                </li>
                            @endif
                            @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))  
                                <li>
                                    <a href="{{url('manager/rkp')}}">
                                        <i class="fa fa-list-alt"></i>
                                        Rencana Kebutuhan Pegawai
                                    </a>
                                </li>
                            @endif
                            <!-- @if(Auth::user()->role_id == 4)
                                <li><a><i class="fa fa-list-alt"></i>Rencana Kebutuhan Pegawai <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('manager/rkp')}}">Pengajuan RKP</a></li>
                                        <li><a href="{{url('manager/sdm/rkp')}}">Kebutuhan Pegawai</a></li>
                                    </ul>
                                </li>
                            @endif -->
                            @if(Auth::user()->role_id == 5)
                                <li>
                                    <a href="{{url('pm/rkp')}}">
                                        <i class="fa fa-list-alt"></i>
                                        Rencana Kebutuhan Pegawai
                                    </a>
                                </li>
                            @endif
                            <!-- @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4) || (Auth::user()->role_id == 5))
                            <li>
                                <a href="{{url('pelatihan')}}">
                                    <i class="fa fa-list"></i>
                                    Form Kebutuhan Pelatihan
                                </a>
                            </li>
                            
                            @endif -->
                            @if(Auth::user()->role_id == 1)
                                <li>
                                    <a href="#">
                                        <i class="fa fa-gears"></i>
                                        Inventaris Proyek
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('admin/peralatan/data')}}">Data Inventaris Proyek</a></li>
                                        <li><a href="{{url('admin/peralatan')}}">Peminjaman Inventaris Proyek</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == 3)
                                <li>
                                <a href="{{url('manager/peralatan')}}">
                                    <i class="fa fa-gears"></i>
                                    Inventaris Proyek
                                </a>
                            </li>
                            @endif

                            @if((Auth::user()->role_id == 2) || (Auth::user()->role_id == 3) || (Auth::user()->role_id == 4) || (Auth::user()->role_id == 5))
                            <li>
                                <a href="{{url('arsip')}}">
                                    <i class="fa fa-folder-open"></i>
                                    Arsip Berkas
                                </a>
                            </li>
                            @endif

                            @if(Auth::user()->role_id == 1)
                            <li>
                                <a href="{{url('admin/arsip')}}">
                                    <i class="fa fa-folder-open"></i>
                                    Arsip Berkas
                                </a>
                            </li>
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
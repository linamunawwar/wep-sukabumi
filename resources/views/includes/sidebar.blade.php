<div class="col-md-3 left_col" style="width: 240px;">
    <div class="left_col scroll-view" style="background: #00004E;">
        <div class="navbar nav_title" style="border: 0; background: white; width: 100%; margin-bottom: 10px;">
            <a href="{{ url('/') }}" class="site_title"><img src="{{asset('public/img/Waskita-noback.png')}}" width="40px" height="25px" style="color: white!important;"> <span style="color: #172D44 !important;">WEP -  Becakayu 2A</span></a>
        </div>
        <?php
            use App\Permission;
            $menus = Permission::where('id_user', Auth::user()->id)->whereHas('menu',function ($q){
                $q->where('active',1);
            })->orderBy('id_menu')->get();
            $parent = array();
            foreach ($menus as $key => $value) {
                if($value->menu->id_parent == 0){
                    $parent[$value->id_menu]['id_menu']=$value->id_menu;
                    $parent[$value->id_menu]['nama']=$value->menu->nama;
                    $parent[$value->id_menu]['alias']=$value->menu->alias;
                    $parent[$value->id_menu]['direktori']=$value->menu->direktori;
                    $parent[$value->id_menu]['icon']=$value->menu->icon;
                    $i=0;
                }else{
                    // if(array_key_exists($value->menu->id_parent, $parent)){
                        $parent[$value->menu->id_parent]['sub'][$i]['id_menu'] = $value->id_menu;
                        $parent[$value->menu->id_parent]['sub'][$i]['nama'] = $value->menu->nama;
                        $parent[$value->menu->id_parent]['sub'][$i]['alias'] = $value->menu->alias;
                        $parent[$value->menu->id_parent]['sub'][$i]['direktori'] = $value->menu->direktori;
                        $parent[$value->menu->id_parent]['sub'][$i]['icon'] = $value->menu->icon;
                        $i++;
                    // }
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
                    @if(Auth::user()->role_id == 1)
                        <li><a><i class="fa fa-lock"></i>Menu & Permissions <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('admin/menu')}}"><i class="fa fa-unlock-alt"></i>Master Menu</a></li>
                                <li><a href="{{url('admin/permission')}}"><i class="fa fa-unlock"></i>Permissions Pegawai</a></li>
                            </ul>
                        </li>
                    @endif
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
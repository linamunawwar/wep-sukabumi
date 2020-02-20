<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu" style="margin-left: 0px; margin-bottom: 0px; background: #8C001B; color: white!important;">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle" style="color: white!important;"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right" style="color: white!important;">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}">
                        {{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{url('/password')}}"><i class="fa fa-key pull-right"></i> Ganti Password</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                    @if(Auth::user()->role_id == 1)
                        <a href="{{url('admin/memo')}}" class="dropdown-toggle info-number" aria-expanded="false" style="color: white!important;">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    @endif
                    @if(Auth::user()->role_id == 2)
                        <a href="{{url('user/memo')}}" class="dropdown-toggle info-number" aria-expanded="false" style="color: white!important;">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    @endif
                    @if((Auth::user()->role_id == 3) || (Auth::user()->role_id == 4))
                        <a href="{{url('manager/memo')}}" class="dropdown-toggle info-number" aria-expanded="false" style="color: white!important;">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    @endif
                    @if(Auth::user()->role_id == 5)
                       <a href="{{url('pm/memo')}}" class="dropdown-toggle info-number" aria-expanded="false" style="color: white!important;">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    @endif

                    <!-- <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <i class="fa fa-envelope-o"></i>
                    </a> -->
                    <!-- <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul> -->
                </li>
                @if(Auth::user()->role_id == 6)
                    <li>
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            Permintaan Penyerahan 
                            @if(count(notif_permintaan_penyerahan()) != 0)
                                <span class="badge bg" style="background-color: #1AAD19; ">
                                    {{count(notif_permintaan_penyerahan())}}
                                </span>
                            @endif
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @foreach(notif_permintaan_penyerahan() as $key=>$serah)
                            <li>
                                <a href='{{url("Logistik/admin/penyerahan/detail/$serah->id")}}'>
                                    <span>
                                      <span>{{$serah->kode_penerimaan}}</span>
                                      <?php
                                        $tgl = explode(' ',$serah->is_splem_at);
                                        $tgl[0] = konversi_tanggal($tgl[0]);
                                      ?>
                                      <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                        <span class="message">
                                          Kode Penerimaan {{$serah->kode_penerimaan}} telah disetujui dan diserahkan
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @if($key == 4)
                               <?php break;?>
                            @endif
                            @endforeach
                            <li>
                                <div class="text-center">
                                    <a href="{{url('Logistik/admin/penyerahan/')}}">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            Order Diterima
                            @if(count(notif_order_diterima()) != 0)
                                <span class="badge bg" style="background-color: #1AAD19; ">
                                    {{count(notif_order_diterima())}}
                                </span>
                            @endif
                            
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @foreach(notif_order_diterima() as $key=>$order)
                            <li>
                                <a href='{{url("Logistik/admin/penerimaan/notif/detail/$order->id")}}'>
                                    <span>
                                      <span>{{$order->kode_permintaan}}</span>
                                      <?php
                                        $tgl = explode(' ',$order->is_pm_at);
                                        $tgl[0] = konversi_tanggal($tgl[0]);
                                      ?>
                                      <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                        <span class="message">
                                          Kode Permintaan {{$order->kode_permintaan}} telah diterima dengan Kode Penerimaan {{$order->kode_penerimaan}}
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @if($key == 4)
                               <?php break;?>
                            @endif
                            @endforeach
                            <li>
                                <div class="text-center">
                                    <a href="{{url('Logistik/admin/notif/order_diterima')}}">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            Permintaan Disetujui
                            @if(count(notif_permintaan_disetujui()) != 0)
                                <span class="badge bg" style="background-color: #1AAD19; ">
                                    {{count(notif_permintaan_disetujui())}}
                                </span>
                            @endif
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @foreach(notif_permintaan_disetujui() as $key=>$permintaan)
                            <li>
                                <a href='{{url("Logistik/admin/permintaan/notif/detail/$permintaan->id")}}'>
                                    <span>
                                      <span>{{$permintaan->kode_permintaan}}</span>
                                      <?php
                                        $tgl = explode(' ',$permintaan->is_pm_at);
                                        $tgl[0] = konversi_tanggal($tgl[0]);
                                      ?>
                                      <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                        <span class="message">
                                          Kode Permintaan {{$permintaan->kode_permintaan}} telah disetujui
                                        </span>
                                    </span>
                                </a>
                            </li>
                            @if($key == 4)
                               <?php break;?>
                            @endif
                            @endforeach
                            <li>
                                <div class="text-center">
                                    <a href="{{url('Logistik/admin/notif/permintaan_disetujui')}}">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    
                @endif
                @if(Auth::user()->role_id == 2)
                    <li>
                        <a href="{{url('user/cuti/serah_tugas')}}" class="info-number" style="color: white!important;">
                            <i class="fa fa-user"></i>
                            @if(session('pengganti') != 0)
                            <span class="badge bg-green">{{session('pengganti')}}</span>
                            @endif
                        </a>
                        <!-- <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <div class="text-center">
                                    <a>
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul> -->
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
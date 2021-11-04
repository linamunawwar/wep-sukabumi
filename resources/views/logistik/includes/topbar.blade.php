<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu" style="margin-left: 0px; margin-bottom: 0px; background: #8C001B; color: white!important;">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle" style="color: white!important;"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right" style="color: white!important; width:75%;">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <img src="{{ Gravatar::src(Auth::user()->email) }}">
                        {{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{url('/password')}}"><i class="fa fa-key pull-right"></i> Ganti Password</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
                <li>                      
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <i class="fa fa-bell-o fa-5x" title="Notifikasi" alt="Notifikasi"></i> 
                        @if(count(notif_penerimaan_baru()) != 0)
                            <span class="badge bg" style="background-color: #1AAD19; ">
                                {{count(notif_penerimaan_baru())}}
                            </span>
                        @endif
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach(notif_penerimaan_baru() as $key=>$serah)
                        <li>
                            <a href='{{url("Logistik/admin/penerimaan/detail/$serah->id")}}'>
                                <span>
                                  <span>{{$serah->kode_penerimaan}}</span>
                                  <?php
                                    $tgl = explode(' ',$serah->is_admin_at);
                                    $tgl[0] = konversi_tanggal($tgl[0]);
                                  ?>
                                  <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                    <span class="message">
                                      Form BPM dengan Kode Permintaan {{$serah->kode_permintaan}} telah datang dengan kode penerimaan {{$serah->kode_penerimaan}}
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
                                <a href="{{url('Logistik/admin/penerimaan/')}}">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                @if(\Auth::user()->role_id == 6)
                <li>                      
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <i class="fa fa-check-square-o" title="Permintaan Penyerahan"></i> 
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
                                      Pengajuan Pemakaian dengan Kode Penerimaan {{$serah->kode_penerimaan}} telah disetujui, Harap segera diserahkan
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
                @endif
                <li>
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <i class="fa fa-list-alt" title="Konfirmasi Penerimaan"></i>
                        @if(count(notif_konfirmasi_penerimaan()) != 0)
                            <span class="badge bg" style="background-color: #1AAD19; ">
                                {{count(notif_konfirmasi_penerimaan())}}
                            </span>
                        @endif
                        
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach(notif_konfirmasi_penerimaan() as $key=>$order)
                        <li>
                            @if(\Auth::user()->role_id == 6)
                                <a href='{{url("Logistik/admin/pengajuan/konfirmasi/$order->id")}}'>
                            @else
                                <a href='{{url("Logistik/user/pengajuan/konfirmasi/$order->id")}}'>
                            @endif
                                <span>
                                  <span>{{$order->kode_permintaan}}</span>
                                  <?php
                                    $tgl = explode(' ',$order->updated_at);
                                    $tgl[0] = konversi_tanggal($tgl[0]);
                                  ?>
                                  <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                    <br>
                                    <span class="message">
                                      Pengajuan Pemakaian dengan Kode Penerimaan {{$order->kode_penerimaan}} telah diserahkan, mohon segera dikonfirmasi
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
                <!-- notifikasi permintaan diproses = notifikasi jika ada permintaan yg disetujui/ direject -->
                <li>
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <i class="fa fa-tasks" title="Permintaan Diproses"></i>
                        @if(count(notif_permintaan_diproses()) != 0)
                            <span class="badge bg" style="background-color: #1AAD19; ">
                                {{count(notif_permintaan_diproses())}}
                            </span>
                        @endif
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach(notif_permintaan_diproses() as $key=>$permintaan)
                            @if(($permintaan->is_som == 0) || ($permintaan->is_slem == 0) || ($permintaan->is_scarm == 0))
                                <li style="background-color: hsla(14, 100%, 53%, 0.6); color: white;">
                                    <a href='{{url("Logistik/admin/permintaan/edit/$permintaan->id")}}'>
                                        <span>
                                          <span>{{$permintaan->kode_permintaan}}</span>
                                          <?php
                                            $tgl = explode(' ',$permintaan->updated_at);
                                            $tgl[0] = konversi_tanggal($tgl[0]);
                                          ?>
                                          <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                            <span class="message">
                                              Kode Permintaan {{$permintaan->kode_permintaan}} telah ditolak
                                            </span>
                                        </span>
                                    </a>
                                </li>                                  
                            @else
                                <li>
                                    @if(\Auth::user()->role_id == 6)
                                        <a href='{{url("Logistik/admin/permintaan/notif/detail/$permintaan->id")}}'>
                                    @elseif(\Auth::user()->role_id == 2)
                                        <a href='{{url("Logistik/user/permintaan/notif/detail/$permintaan->id")}}'>
                                    @elseif((\Auth::user()->role_id == 3) || (\Auth::user()->role_id == 4))
                                        <a href='{{url("Logistik/manager/permintaan/notif/detail/$permintaan->id")}}'>
                                    @elseif(\Auth::user()->role_id == 5)
                                        <a href='{{url("Logistik/pm/permintaan/notif/detail/$permintaan->id")}}'>
                                    @endif
                                    
                                        <span>
                                          <span>{{$permintaan->kode_permintaan}}</span>
                                          <?php
                                            $tgl = explode(' ',$permintaan->updated_at);
                                            $tgl[0] = konversi_tanggal($tgl[0]);
                                          ?>
                                          <span class="time">{{$tgl[0]}}  {{$tgl[1]}}</span>
                                            <span class="message">
                                              Kode Permintaan {{$permintaan->kode_permintaan}} telah disetujui
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif
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
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation
top navigation -->
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

                    <li>                      
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            <i class="fa fa-bell-o"></i> 
                            @if(count(notif_penerimaan_order_diterima()) != 0)
                                <span class="badge bg" style="background-color: #1AAD19; ">
                                    {{count(notif_penerimaan_order_diterima())}}
                                </span>
                            @endif
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @foreach(notif_penerimaan_order_diterima() as $key=>$serah)
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
                                    <a href="{{url('Logistik/admin/penerimaan/')}}">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
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
                    @endif
                    <li>
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            Order Diterima
                            @if(count(notif_permintaan_penyerahan()) != 0)
                                <span class="badge bg" style="background-color: #1AAD19; ">
                                    {{count(notif_permintaan_penyerahan())}}
                                </span>
                            @endif
                            
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @foreach(notif_permintaan_penyerahan() as $key=>$order)
                            <li>
                                <a href='{{url("Logistik/admin/permintaan/konfirmasi/$order->id")}}'>
                                    <span>
                                      <span>{{$order->kode_permintaan}}</span>
                                      <?php
                                        $tgl = explode(' ',$order->is_scarm_at);
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
                    <!-- notifikasi permintaan diproses = notifikasi jika ada permintaan yg disetujui/ direject -->
                    <li>
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            Permintaan Diproses
                            @if(count(notif_permintaan_diproses()) != 0)
                                <span class="badge bg" style="background-color: #1AAD19; ">
                                    {{count(notif_permintaan_diproses())}}
                                </span>
                            @endif
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            @foreach(notif_permintaan_diproses() as $key=>$permintaan)
                                @if($permintaan->is_scarm == 1)
                                    <li>
                                        <a href='{{url("Logistik/admin/permintaan/notif/detail/$permintaan->id")}}'>
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
                                @elseif($permintaan->is_scarm == 0)
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
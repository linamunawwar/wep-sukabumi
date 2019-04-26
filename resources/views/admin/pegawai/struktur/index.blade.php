  @extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Struktur Pegawai </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="{{url('pegawai/create')}}"><button class="btn btn-success"> <i class="fa fa-print"></i>  Cetak</button></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul id="ul-data" style="display: none;">
              @foreach($level as $lvl)
                @if($lvl->level == 0)
                  <li id="{{$lvl->id}}" title="{{$lvl->posisi}}">
                @else
                <ul>
                  @foreach($posisi[$lvl->level] as $pegawai)
                    <li id="{{$pegawai->id}}" title="{{$pegawai->posisi}}">
                  @endforeach
                </ul>
                @endif
              @endforeach

              <li id="1" title="Lao Lao">general manager
                  <ul>
                      <li id="2" title="Bo Miao">department manager</li>
                      <li id="3" title="Su Miao">department manager
                        <ul>
                            <li id="4" title="Tie Hua">senior engineer</li>
                            <li id="5" title="Hei Hei">senior engineer
                                <ul>
                                    <li id="6" title="Pang Pang">engineer</li>
                                    <li id="7" title="Xiang Xiang">engineer</li>
                                </ul>
                            </li>
                        </ul>
                      </li>
                  </ul>
              </li>
            </ul>
            <div id="chart-container"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
  <script type="text/javascript">
    console.log('sf');
    // sample of core source code
    // var datascource = {
    //   'name': 'Lao Lao',
    //   'title': 'Project Manager',
    //   'relationship': '001',
    //   'children': [
    //     { 'name': 'Bo Miao', 'title': 'department manager', 'relationship': '110' },
    //     { 'name': 'Su Miao', 'title': 'department manager', 'relationship': '111',
    //       'children': [
    //         { 'name': 'Tie Hua', 'title': 'senior engineer', 'relationship': '110' },
    //         { 'name': 'Hei Hei', 'title': 'senior engineer', 'relationship': '110' }
    //       ]
    //     },
    //     { 'name': 'Yu Jie', 'title': 'department manager', 'relationship': '111' }
    //   ]
    // };

    // $('#chart-container').orgchart({
    //   'data' : datascource,
    //   'depth': 2,
    //   'nodeTitle': 'name',
    //   'nodeContent': 'title'
    // });
    $('#chart-container').orgchart({
        nodeTitle: 'title',
        nodeContent: 'content',
        data: $('#ul-data')
    });

  </script>
@endpush
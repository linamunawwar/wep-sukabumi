  @extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
      #chart-container { background-color: #eee; }
      .orgchart { background: #fff; padding: 0px; }
      .orgchart .node .title { background-color: #006699; width: 100%; height: 100%; white-space: initial;}
      .orgchart .node .content { border-color: #006699; width: 100%; height: auto; min-height:20px;  white-space: initial; white-space: pre-line;}
      .orgchart .nodes .title { background-color: #006699; width: 100%; height: 100%; white-space: initial;}
      .orgchart .nodes .content { border-color: #006699; width: 100%; height: 100%;min-height: 20px; white-space: initial; white-space: pre-line;}
      .orgchart .node .level-3 { background-color: #8C001B; width: 100%; height: 100%; white-space: initial;}
      .orgchart .node .level-4 { background-color: #a9a9a9; width: 100%; height: 100%; white-space: initial; color: black;}
      .orgchart .lines .topLine {
        border-color: #006699;
      }

      .orgchart .lines .rightLine {
              border-color: #006699;
      }

      .orgchart .lines .leftLine {
              border-color: #006699;
      }

      .orgchart .lines .downLine {
              background-color: #006699;
      }

      .orgchart .verticalNodes>td::before {
              border-color: #006699;
      }

      .orgchart .verticalNodes ul>li::before, .orgchart .verticalNodes ul>li::after {
              border-color: #006699;
      }
    </style>
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Struktur Pegawai </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul id="ul-data" style="display: none;" >
              @foreach($posisi as $pos)
              <li id="{{$pos->id}}" title="{{$pos->posisi}}">
                @foreach($pos->anggota as $anggota)
                  {{$anggota->nama}}
                @endforeach
                @if(count($pos->anak) != 0)
                    <ul>
                      @foreach($pos->anak as $anak)
                        <li id="{{$anak->id}}" title="{{$anak->posisi}}">
                          @foreach($anak->anggota as $anggota1)
                            {{$anggota1->nama}}<br>
                          @endforeach
                          @if(count($anak->anak) != 0)
                              <ul>
                                @foreach($anak->anak as $anak2)
                                    <li id="{{$anak->id}}" title="{{$anak2->posisi}}">
                                    @foreach($anak2->anggota as $anggota2)
                                      <li id="{{$anggota2->id}}" title="{{$anak2->posisi}}">
                                        {{$anggota2->nama}}
                                      </li>
                                    @endforeach
                                    @if(count($anak2->anak) != 0)
                                      <ul>
                                        @foreach($anak2->anak as $anak3)
                                            @foreach($anak3->anggota as $anggota3)
                                                <li id="{{$anggota3->id}}" title="{{$anak3->posisi}}" >
                                                  {!!$anggota3->nama!!}
                                                </li>                         
                                            @endforeach
                                            @if(count($anak3->anak) != 0)
                                              <ul>
                                                @foreach($anak3->anak as $anak4)
                                                  <li id="{{$anak4->id}}" title="{{$anak4->posisi}}">
                                                @endforeach
                                              </ul>
                                            @else
                                            @endif
                                        @endforeach
                                      </ul>
                                    @else
                                  </li>
                                    @endif
                                @endforeach
                              </ul>
                            @else
                              </li>
                            @endif
                      @endforeach
                    </ul>
                @else
                  </li>
                @endif
              @endforeach
            </ul>


              <!-- <li id="1" title="Lao Lao">general manager
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
                  </ul> -->
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
    var nodeTemplate = function(data) {
      console.log(data);
      return `
        <div class="title  level-${data.level}">${data.title}</div>
          <div class="content" style="white-space:pre-line;">${data.content}</div>
      `;
    };

    $('#chart-container').orgchart({
        nodeTitle: 'title',
        nodeContent: 'content',
        verticalLevel: 3,
        visibleLevel: 4,
        exportButton: true,
        exportFilename: 'Struktur Organisasi',
        exportFileextension :'pdf',
        data: $('#ul-data'),
        nodeTemplate: nodeTemplate
    });

  </script>
@endpush
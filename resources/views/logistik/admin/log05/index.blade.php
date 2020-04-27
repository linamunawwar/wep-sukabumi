@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}

	#datatable tbody tr td {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
</style>

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Buku Harian Gudang (Log-05) </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <div id="SearchForm">
								<div class="row">
									<div class="col-md-12"  style="padding: 0; margin: 0;">
										<div class="form-group">
											<label style="line-height:20px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Tanggal Mulai</label>
											<div class="col-md-3 col-sm-3 col-xs-3">
                                                <div class='input-group date' id='datepicker1' class="datepicker">
                                                    <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                                                    @if(isset($dataInput) && $dataInput['tanggal_mulai'])
                                                   		<input type='text' value="{{$dataInput['tanggal_mulai']}}" name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
                                                   	@else
                                                   		<input type='text' value='' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
                                                   	@endif
                                                </div>                                     
											</div>
										</div>
										<div class="form-group" style="margin-top:-6em;">
											<label style="line-height:20px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Tanggal Selesai</label>
											<div class="col-md-3 col-sm-3 col-xs-3">
                                                <div class='input-group date' id='datepicker2' class="datepicker">
                                                    <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                                                    @if(isset($dataInput) && $dataInput['tanggal_selesai'])
                                                    	<input type='text' value="{{$dataInput['tanggal_selesai']}}" name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
                                                    @else
                                                    	<input type='text' value='' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
                                                    @endif
                                                </div>                                      
                                            </div>	
                                            <div class="col-md-1">
                                                <button class="btn btn-success pull-right" id="search" name="proses" value="1">Proses</button>
                                            </div>
                                        </div>                                        
									</div>
								</div>
							</div>   
							<br><br>
							<input type="hidden" name="download" value="{{$show}}">
							@if($show == 1)
								@if(count($data) == 0)
									<br>
									<br>
									<div class="alert alert-danger">
									  <div class="isi">Data tidak ditemukan!
									  </div>
									</div>
								@else
									<button type="submit" name="unduh" value="1" class="btn btn-primary pull-right">Download</button>
									<div class="Laporan">
										<table class="table" style="font-size: 12px; text-align: center;">
										    <tr>
										      <th><img src="../../public/img/Waskita.png" width="30" height="30"></th>
										      <th colspan="3"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
										      <th></th>
										      <td style="border: 1px solid #000000;  " colspan="3" align="center">Formulir Log-05</td>
										    </tr>
										    <tr>
										      <th></th>
										      <th></th>
										      <th></th>
										      <th></th>
										      <th></th>
										      <td colspan="2" style="border: 1px solid #000000;">Edisi : Mei 2019 </b></td>
											<td style="border: 1px solid #000000;">Revisi : 0 </td>
										    
										    <tr>
										      <td style="padding-left: 10px;">Business Unit</td>
										    </tr>
										    <tr>   
										      <td>Proyek</td>
										      <td colspan="2">: </td>
										      <td></td>
										      <td colspan="3" style="font-weight: bold;"> No. AB</td>
										    </tr>
										    <tr>
										      <td colspan="8" style="text-align: center;border: 1px solid #000000"><h4><b>BUKU HARIAN GUDANG</b></h4></td>
										    </tr>
										    <tr></tr>
										    <tr>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td colspan="3">Halaman :
										        </td>
										    </tr>
										    <tr class="thead-light" >
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 2%; height:20;" align="center">No</td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 10%; height:20;" align="center"> Tanggal </td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 15px; height:20;" align="center"> Nama Bahan </td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12%;" colspan="2" align="center"> Volume Masuk </td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12%;" colspan="2" align="center"> Volume Keluar </td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 20%; height:20;" align="center"> Keterangan </td>
										    </tr>
										    @foreach ($data as $key => $value)
										    <tr class="thead-light" style="text-align: center;">
										        @foreach ($value['data'] as $key1 => $val)
										          @if ($val['material'] != '')
										          	@if($key1 == 0)
										              <tr>
										                <td style="border: 1px double #000000;" align="center">{{ $key }}</td>
										        		<td style="border: 1px double #000000;" align="center">{{ konversi_tanggal($value['tanggal']) }}</td>
										                <td style="border: 1px double #000000;" align="left">{{ $val['material'] }}</td>
										                <td style="border: 1px double #000000;">{{ $val['jml_terima'] }}</td>
										                <td style="border: 1px double #000000; width: 3%;">{{ $val['satuan'] }}</td>
										                <td style="border: 1px double #000000;">{{ $val['jml_keluar'] }}</td>
										                <td style="border: 1px double #000000; width: 3%;">{{ $val['satuan'] }}</td>
										                <td style="border: 1px double #000000;"> </td>
										              </tr>
										            @else
										              <tr>
										                <td style="border: 1px double #000000;"></td>
										                <td style="border: 1px double #000000;"></td>
										                <td style="border: 1px double #000000;" align="left">{{ $val['material'] }}</td>
										                <td style="border: 1px double #000000;">{{ $val['jml_terima'] }}</td>
										                <td style="border: 1px double #000000; width: 3%;">{{ $val['satuan'] }}</td>
										                <td style="border: 1px double #000000;">{{ $val['jml_keluar'] }}</td>
										                <td style="border: 1px double #000000; width: 3%;">{{ $val['satuan'] }}</td>
										                <td style="border: 1px double #000000;"> </td>
										              </tr>    
										            @endif              
										          @else
										          	<td style="border: 1px double #000000;">{{ $key }}</td>
										        	<td style="border: 1px double #000000;">{{ konversi_tanggal($value['tanggal']) }}</td>
										            <td style="border: 1px double #000000;">{{ $val['material'] }}</td>
										            <td style="border: 1px double #000000;">{{ $val['jml_terima'] }}</td>
										            <td style="border: 1px double #000000;">{{ $val['satuan'] }}</td>
										            <td style="border: 1px double #000000;">{{ $val['jml_keluar'] }}</td>
										            <td style="border: 1px double #000000;">{{ $val['satuan'] }}</td>
										            <td style="border: 1px double #000000;"> </td>
										          @endif
										        @endforeach
										    </tr>
										    @endforeach
										    <tr></tr>
										    <tr>
										      <td></td>
										      <td></td>
										      <td></td>
										      <td></td>
										      <td></td>
										      <td></td>
										      <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> Tanggal </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> Diisi Oleh, </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> SPLEM </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td colspan="2" style="height:70;"> 
										            @if(file_exists('upload/pegawai/'.$splem->nip.'/'.$splem->ttd))
												        <img src="{{url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd}}" width="100" align="center">
												      @endif    
										        </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> {{ $splem->nama }} </td>
										        <td></td>
										    </tr>
										  </table>
    
									</div>
								@endif
							@endif                             
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- /page content -->
@endsection
@push('scripts')
  <script type="text/javascript">
  	$('#datepicker1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});

	$('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});
  </script>
 @endpush
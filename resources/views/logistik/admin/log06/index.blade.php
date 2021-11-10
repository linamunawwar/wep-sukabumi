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
	.table tbody tr td{
		padding: 3px !important;
	}

</style>

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Evaluasi Pemakaian Material (Log-05) </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Mulai :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker1' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
										@if(isset($data) && $data['tanggal_mulai'])
						                	<input type='text' value="{{$data['tanggal_mulai']}}" name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						                @else
						                	<input type='text' value='' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						                @endif
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Selesai :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker2' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
										@if(isset($data) && $data['tanggal_selesai'])
						                	<input type='text' value="{{$data['tanggal_selesai']}}" name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						               	@else
						               		<input type='text' value='' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						               	@endif
						            </div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4">
									<button type="submit" name="proses" class="btn btn-success" value="1">Proses</button>
								</div>
							</div>
						<input type="hidden" name="download" value="{{$show}}">
						@if($show == 1)
							@if(count($materials) == 0)
								<br>
								<br>
								<div class="alert alert-danger">
								  <div class="isi">Data tidak ditemukan!
								  </div>
								</div>
							@else
								<button type="submit" name="unduh" value="1" class="btn btn-primary pull-right">Download</button>
								<div class="Laporan">
									<table class="table" cellspacing="0" style="font-size: 12;">
									  <tr>
									    <th><img src="../../public/img/Waskita.png" width="30" height="30"></th>
									    <th colspan="4"><b style="font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
									    <td></td>
									    <td></td>
									    <td style="border: 1px solid #000000;  " colspan="2" align="center"><b>Formulir Log-05</b></td>
									  </tr>
									  <tr>
									    <!-- <td style="font-size: 14px;">Periode</td>
									  	<td style="font-size: 14px;">: {{$data['tanggal_mulai']}} s.d {{$data['tanggal_selesai']}}</td> -->
									    <th></th>
									    <th></th>
									    <th></th>
									    <th></th>
									    <th></th>
									    <th></th>
									    <th></th>
									    <td style="border: 1px solid #000000;">Edisi : Mei 2019</b></td>
									    <td style="border: 1px solid #000000;">Revisi : 0 </td>
									  <tr>
									    <td style="padding-left: 10px; font-size: 14px;">Business Unit</td>
									  </tr>
									  <tr>   
									    <td style="font-size: 14px;">Proyek</td>
									    <td colspan="3" style="font-size: 14px;">: Proyek Jalan Tol Becakayu Seksi 2A Ujung</td>
									    <td></td>
									    <td colspan="3" style="font-weight: bold;"> No. AB</td>
									  </tr>
									</table>

									<table class="table table-striped" style="text-align: center;">
									  <tr>
									    <td colspan="9" style="text-align: center;border: 1px solid #000000"><h4><b>LAPORAN EVALUASI PEMAKAIAN BAHAN</b></h4></td>
									  </tr>
									  <tr>
									    <td></td>
									  </tr>
									</table>
									<table class="table table-striped" style="table-layout:fixed;">
									  <tr class="thead-light" >
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11; width: 100px;" rowspan="2" align="center">Asal Bahan *)</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11; width: 300px;" width="27" rowspan="2" align="center">JENIS BAHAN</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11; width: 300px;" colspan="3" align="center">VOLUME BAHAN</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11; width: 300;" colspan="3" align="center">SISA STOCK (FIFO)</td>
									  </tr>
									  <tr class="thead-light" style="text-align: center;">
									    <td style="border: 1px double #000000;font-weight: bold; font-size: 11;">KEBUTUHAN</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;">MASUK</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;">TERPAKAI</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;">JUMLAH</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11; width: 10px;" >HRG_SAT</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;" >JML_HRG</td>
									  </tr>
									  <tr class="thead-light" style="text-align: center;">
									    <td style="border: 1px double #000000;font-weight: bold; font-size: 11;">1</td>
									    <td style="border: 1px double #000000;font-weight: bold; font-size: 11;">2</td>
									    <td style="border: 1px double #000000;font-weight: bold; font-size: 11;">3</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;">4</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;">5</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;">6 = 4-5</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;" >7</td>
									    <td style="border: 1px double #000000; font-weight: bold; font-size: 11;" >8 = 6x7</td>
									  </tr>
									  <?php $i =1; ?>
									  @foreach($materials as $key=> $data)
									    <tr>
									      <td style="border: 1px solid #000000;font-size: 12"  align="left" ></td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="left" >{{$data['nama']}}</td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="left">{{$data['kebutuhan']}}</td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="right">{{$data['masuk']}}</td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="right">{{$data['terpakai']}}</td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="right">{{$data['masuk'] - $data['terpakai']}}</td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="right">{{$data['harga']}}</td>
									      <td style="border: 1px solid #000000;font-size: 12"  align="right">{{($data['masuk'] - $data['terpakai'])*$data['harga']}}</td>
									    </tr>
									    <?php $i++; ?>
									  @endforeach
									  @if(count($materials) < 33)
									    <?php
									      for($i=count($materials);$i<=40;$i++){
									        echo '<tr style="height:25;">
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									              <td style="border: 1px solid #000000;"  align="center"></td>
									            </tr>';
									      }
									    ?>
									  @endif
									  <tr>
									    <td colspan="2" style="border: 1px solid #000000; height: 24px;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									  </tr>
									  <tr>
									    <td colspan="2" style="border: 1px solid #000000; height: 24px;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									    <td style="border: 1px solid #000000;"></td>
									  </tr>
									  <tr>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									  </tr>
									  <tr>
									    <td style="font-size: 12;">*) Diisi :</td>
									    <td colspan="2" style="font-size: 12;" >1 - Dikerjakan Sendiri</td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td style="font-size: 12;" colspan="2">Bekasi, {{date('d-m-Y')}}</td>
									  </tr>
									  <tr>
									    <td></td>
									    <td colspan="2" style="font-size: 12;">2 - Disub-kontraktorkan</td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td align="center" style="font-size: 12;" >SPLEM</td>
									  </tr>
									  <tr>
									    <td></td>
									    <td colspan="2" style="font-size: 12;">3 - Diadakan oleh Pemberi Tugas<br> 4 - Material Impor<br>5 - Material Pendukung</td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td style="text-align: center;">
									      @if(file_exists('upload/pegawai/'.$splem->nip.'/'.$splem->ttd))
									        <img src="{{url('upload/pegawai').'/'.$splem->nip.'/'.$splem->ttd}}" width="100" align="center">
									      @endif
									    </td>
									  </tr>
									  <tr>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td colspan="2" align="center" style="font-size: 12;">{{$splem->nama}}</td>
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
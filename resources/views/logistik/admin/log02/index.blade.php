@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

<style>
	#kartuGudang th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 14px;
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
						<h2>Laporan Kartu Gudang </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div id="SearchForm">
								<div class="row">
									<div class="col-md-12"  style="padding: 0; margin: 0;">
										<div class="form-group">
											<label style="line-height:20px;" class="control-label col-md-1 col-sm-1 col-xs-1" for="nama">Material <span class="required">*</span>:</label>
											<div class="col-md-3 col-sm-3 col-xs-3">
												@if(isset($data2) && $material)
													<select class="form-control material" name="material" required="required" id="material">
														<option value="">Pilih Material </option>
														@foreach ($materials as $mt)
															<?php $selected = ($mt->id == $material->id)? 'selected' : ''; ?>
															<option value="{{ $mt->id }}" {{$selected}}>{{ $mt->nama }}</option>
														@endforeach                                                
													</select>
												@else
													<select class="form-control material" name="material" required="required" id="material">
														<option value="">Pilih Material </option>
														@foreach ($materials as $mt)
															<option value="{{ $mt->id }}">{{ $mt->nama }}</option>
														@endforeach                                                
													</select>
												@endif                                            
											</div>
										</div>
										<div class="form-group" style="margin-top:-6em;">
											<label style="line-height:20px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Bulan / Tahun <span class="required">*</span>:</label>
											<div class="col-md-2 col-sm-2 col-xs-2">
												@if(isset($data2) && $data2['bulan'])
													<select class="form-control bulan" name="bulan" required="required" id="bulan">
														<option value="">Pilih Bulan </option>
														@for ($bulan = 0; $bulan < 12; $bulan++)
															<?php $selected = ($idBln[$bulan] == $data2['bulan'])? 'selected': '';?>
															<option value="{{ $idBln[$bulan] }}" {{$selected}}>{{ $bln[$bulan] }}</option>
														@endfor                                                
													</select>
												@else
													<select class="form-control bulan" name="bulan" required="required" id="bulan">
														<option value="">Pilih Bulan </option>
														@for ($bulan = 0; $bulan < 12; $bulan++)
															<option value="{{ $idBln[$bulan] }}">{{ $bln[$bulan] }}</option>
														@endfor                                                
													</select>
												@endif                                            
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2">
												@if(isset($data2) && $data2['tahun'])
													<select class="form-control tahun" name="tahun" required="required" id="tahun">
														<option value="">Pilih Tahun</option>
														@for ($tahun = 2017; $tahun <= Date('Y'); $tahun++)
															<?php $selected = ($tahun == $data2['tahun'])? 'selected': ''; ?>
															<option value="{{ $tahun }}" {{$selected}}>{{ $tahun }}</option>
														@endfor                                                
													</select>
												@else
													<select class="form-control tahun" name="tahun" required="required" id="tahun">
														<option value="">Pilih Tahun</option>
														@for ($tahun = 2017; $tahun <= Date('Y'); $tahun++)
															<option value="{{ $tahun }}">{{ $tahun }}</option>
														@endfor                                                
													</select>
												@endif                                            
											</div>                                        
											<div class="col-md-1">
												<button class="btn btn-success pull-right" id="search" name="proses" value="1">Proses</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
							<br>
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
										<table class="table" style="font-size: 12px;">
										    <tr>
										      <th><img src="../../public/img/Waskita.png" width="30" height="30"></th>
										      <th colspan="2"><b style="font-weight: 3; font-size:16px; ">PT. WASKITA KARYA (Persero) Tbk</b></th>
										      <td></td>
										      <td></td>
										      <td style="border: 1px solid #000000;  " colspan="2" align="center">Formulir Log-02</td>
										    </tr>
										    <tr>
										      <th></th>
										      <th></th>
										      <th></th>
										      <th></th>
										      <th></th>
										      <td style="border: 1px solid #000000;">Edisi : </b></td>
										      <td style="border: 1px solid #000000;">Revisi : </td>
										    
										    <tr>
										      <td style="padding-left: 10px;">Business Unit</td>
										    </tr>
										    <tr>  
										      <td>Proyek</td>
										      <td>: </td>
										      <td> </td>
										      <td> </td>
										      <td colspan="2" style="font-weight: bold;"> No. AB</td>
										    </tr>
										    <tr>
										      <td colspan="7" style="text-align: center;border: 1px solid #000000; background-color: #ddd5;"><h4><b>KARTU GUDANG</b></h4></td>
										    </tr>
										    <tr></tr>
										    <tr>
										        <th colspan="3">Bulan : {{ $bulanIni }}</th>
										        <td></td>
										        <th colspan="3">Nama Bahan :  {{ $material->nama }}
										        </th>
										    </tr>
										    <tr class="thead-light" >
										      <td style="border: 1px double #000000; font-weight: bold;  width: 13;" colspan="3" align="center">PENERIMAAN</td>
										      <td style="border: 1px double #000000; font-weight: bold;width: 13;" colspan="2" align="center"> PENGELUARAN </td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center"> Sisa </td>
										      <td style="border: 1px double #000000; font-weight: bold; font-size: 10; width: 12;" rowspan="2" align="center"> Keterangan </td>
										    </tr>
										    <tr class="thead-light" style="text-align: center;">
										      <td style="border: 1px double #000000;font-weight: bold;">Tanggal</td>
										      <td style="border: 1px double #000000; font-weight: bold;">Jumlah</td>
										      <td style="border: 1px double #000000; font-weight: bold;">Jumlah Terusan</td>
										      <td style="border: 1px double #000000; font-weight: bold;">Jumlah</td>
										      <td style="border: 1px double #000000; font-weight: bold;" >Jumlah Terusan</td>
										    </tr>
										    @foreach ($data as $key => $val)
										    <tr class="thead-light" style="text-align: center;">
										        <td style="border: 1px double #000000;">{{ $key }}</td>
										        <td style="border: 1px double #000000;">{{ $val['jml_terima'] }}</td>
										        <td style="border: 1px double #000000;">{{ $val['trs_terima'] }}</td>
										        <td style="border: 1px double #000000;">{{ $val['jml_keluar'] }}</td>
										        <td style="border: 1px double #000000;">{{ $val['trs_keluar'] }}</td>
										        <td style="border: 1px double #000000;">{{ $val['sisa'] }}</td>
										        <td style="border: 1px double #000000;"></td>
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
										        <td colspan="2" style="text-align: center;"> Tanggal </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td colspan="2" style="text-align: center;">Mengetahui</td>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> Diisi Oleh, </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td colspan="2" style="text-align: center;">SPLEM</td>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> Petugas Gudang </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td colspan="2" style="height:70;">
										            @if(file_exists("upload/pegawai/$splem->nip/$splem->ttd"))
										                <img src="upload/pegawai/{{$splem->nip}}/{{$splem->ttd}}" width="100" align="center">
										            @endif
										        </td>
										        <td></td>
										    </tr>
										    <tr>
										        <td></td>
										        <td colspan="2" style="text-align: center;"> {{ $splem->nama }} </td>
										        <td></td>
										        <td colspan="2" style="text-align: center;">  </td>
										        <td></td>
										    </tr>
										    <tr></tr>
										    <tr>
										      <td></td>
										      <td> <b><u> Catatan : </u></b> </td>
										      <td colspan="3" >Dibuat Rangkap 2</td>
										      <td></td>
										      <td></td>
										    </tr>
										    <tr>
										      <td></td>
										      <td></td>
										      <td colspan="3">1 - Untuk Gudang</td>
										      <td></td>
										      <td></td>
										    </tr>    
										    <tr>
										      <td></td>
										      <td></td>
										      <td colspan="3">2 - SPLEM</td>
										      <td></td>
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
	$('#material').select2();
	$('#bulan').select2();
	$('#tahun').select2();
  </script>
 @endpush

@extends('logistik.layouts.blank')

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
						<h2>Waste Material </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Nama Material :</label>
								<p style="display: inline-block;" id="nama_material">{{$waste->wasteMaterial->nama}}</p>
								<input type="hidden" name="material_id" id="material_id">
							</div>
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Jenis Pekerjaan :</label>
								<p style="display: inline-block;" id="jenis_kerja">{{$waste->wasteJenisKerja->nama}}</p>
								<input type="hidden" name="jenis_kerja_id" id="jenis_kerja_id">
							</div>
							<div class="form-group">
								<label style="display: inline-block;" for="nama">Periode :</label>
								<p style="display: inline-block;" id="periode">{{$waste->bulan}} {{$waste->tahun}}</p>
								<input type="hidden" name="bulan" id="bulan">
								<input type="hidden" name="tahun" id="tahun">
							</div>
							<div class="form-group" style="display: none;">
								<label style="display: inline-block;" for="nama">Volume Pekerjaan :</label>
								<p style="display: inline-block;" id="periode">{{$waste->volume_pekerjaan}}</p>
							</div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered waste" id="table_waste">
								<tr>
									<th rowspan="2">No.</th>
									<th rowspan="2">Lokasi Pekerjaan</th>
									<th rowspan="2" style="width: 150px;">Kalap/ Pelaksama</th>
									<th colspan="2">Progres Pekerjaan</th>
									<th rowspan="2" style="width: 20px;">Volume Bahan Sesuai Progres</th>
									<th rowspan="2">Realisasi Pemakaian Bahan</th>
									<th rowspan="2">Waste dalam Satuan Volume</th>
									<th colspan="3">Waste Bahan (%)</th>
									<th rowspan="2">Keterangan</th>
								</tr>
								<tr>
									<th>%</th>
									<th>Volume</th>
									<th>Renc.</th>
									<th>Real.</th>
									<th>Deviasi</th>
								</tr>
								<tbody>
									<?php $i = 1;?>
									@foreach($details as $detail)
										<tr>
											<td>{{$i++}}</td>
											<td>{{$detail->wasteLokasi->nama}}</td>
											<td>{{$detail->pelaksanaPegawai->nama}}</td>
											<td>{{$detail->progress_persen}}</td>
											<td>{{$detail->progress_vol}}</td>
											<td>{{$detail->vol_bahan}}</td>
											<td>{{$detail->real_pemakaian}}</td>
											<td>{{$detail->waste_vol}}</td>
											<td>{{$detail->waste_rencana}}</td>
											<td>{{$detail->waste_real}}</td>
											<td>{{$detail->waste_deviasi}}</td>
											<td>{{$detail->keterangan}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="ln_solid"></div>
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="note" class="form-control col-md-7 col-xs-12" cols="15" rows="8" ></textarea>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/logistik/manager/waste')}}">Cancel</a>
									<button type="submit" class="btn btn-success">Approve</button>
								</div>
							</div>
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
  	
  </script>
@endpush
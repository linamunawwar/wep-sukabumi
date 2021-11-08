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
						<h2>Rencana Kebutuhan Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<table class="table table-bordered rkp" id="table_rkp">
								<tr>
									<th rowspan="3">No.</th>
									<th rowspan="3">Posisi Jabatan</th>
									<th rowspan="3" style="width: 200px;">Uraian Tugas Pokok</th>
									<th colspan="5">Persyaratan Jabatan</th>
									<th rowspan="3" style="width: 20px;">Jumlah Yang Dibutuhkan</th>
									<th rowspan="3">Waktu Penempatan</th>
								</tr>
								<tr>
									<th rowspan="2">Peringkat Pendidikan</th>
									<th colspan="2">Pengalaman Kerja</th>
									<th colspan="2">Potensi</th>
								</tr>
								<tr>
									<th>Tahun</th>
									<th>Jenis Pekerjaan</th>
									<th>TPA</th>
									<th>EPT</th>
								</tr>
								<tbody class="data">
									<?php $i=1; ?>
									@foreach($dt_rkps as $dt_rkp)
										<tr>
											<td>{{$i++}}</td>
											<td>{{$dt_rkp->posisi->posisi}}</td>
											<td>{{$dt_rkp->tugas}}</td>
											<td>{{$dt_rkp->pendidikan}}</td>
											<td>{{$dt_rkp->tahun_kerja}}</td>
											<td>{{$dt_rkp->jenis_kerja}}</td>
											<td>{{$dt_rkp->TPA}}</td>
											<td>{{$dt_rkp->EPT}}</td>
											<td>{{$dt_rkp->jumlah_kurang}}</td>
											<td>{{$dt_rkp->waktu_penempatan}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="ln_solid"></div>
							<div class="form-group pull-right" style="margin-right: 40px;">
								<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('pm/rkp')}}">Cancel</a>
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
	$(document).ready(function(){

	});
</script>
@endpush
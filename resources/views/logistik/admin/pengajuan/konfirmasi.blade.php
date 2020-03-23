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
		font-size: 15px;
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
						<h2>Konfirmasi Penyerahan </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/admin/pengajuan/')}}"><button class="btn btn-success"> Kembali </button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col" rowspan="2"><b> No</b> </th>
									<th scope="col" rowspan="2"><b> Tanggal Permintaan</b> </th>
									<th scope="col" rowspan="2"><b> Material</b> </th>
									<th scope="col" colspan="2"><b> Pengajuan</b> </th>
									<th scope="col" colspan="2"><b> Penyerahan</b> </th>
								</tr>
								<tr>
									<th scope="col"><b> Satuan </b></th>
									<th scope="col"><b> Jumlah </b></th>
									<th scope="col"><b> Satuan </b></th>
									<th scope="col"><b> Jumlah </b></th>
								</tr>
							</thead>
							<tbody>	
								<?php $no = 1; ?>
								@foreach ($details as $detail)
									<tr>
										<td scope="col"> {{ $no++ }} </td>
										<?php 
											$tgl = explode(' ',$detail->created_at);
										?>
										<td scope="col"> {{ konversi_tanggal($tgl[0]) }} </td>
										<td scope="col"> {{ $detail->detailPengajuanMaterial->nama }} </td>
										<td scope="col"> {{ $detail->permintaan_satuan }} </td>
										<td scope="col"> {{ $detail->permintaan_jumlah }} </td>
										<td scope="col"> {{ $detail->penyerahan_satuan }} </td>
										<td scope="col"> {{ $detail->pemyerahan_jumlah }} </td>
									</tr>
								@endforeach  					
							</tbody>
						</table>
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="ln_solid"></div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6">Catatan :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									@if ($penyerahan->catatan_penyerahan != Null)
										<textarea name="catatan" class="form-control col-md-6 col-xs-6" cols="15" rows="8" placeholder="Tinggalkan Catatan"> {{ $penyerahan->catatan_penyerahan }} </textarea>
									@else
										<textarea name="catatan" class="form-control col-md-6 col-xs-6" cols="15" rows="8" placeholder="Tinggalkan Catatan"> Tidak Ada Catatan </textarea>
									@endif
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group" style="float:right; margin-right:4em;">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<a class="btn btn-primary" href="{{url('/Logistik/admin/pengajuan')}}">Cancel</a>									
									@if ($penyerahan->is_datang == 0)
										<button type="submit" name="belumSesuai" class="btn" style="background-color:#D63031; color:#FFFFFF;">Terima, Dengan Catatan</button>
										<button  type="submit" name="sesuai" class="btn btn-success">Lengkap, Sesuai </button>	
									@else
										<div class="btn" style="background-color:#D63031; color:#FFFFFF;" disabled="disabled">Terima, Dengan Catatan</div>
										<div  class="btn btn-success" disabled="disabled">Lengkap, Sesuai</div>
									@endif
									
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
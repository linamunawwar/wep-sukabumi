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
						<h2>permintaan Material </h2>
						<span style="float:right; color:#73879C;"> Tanggal Permintaan : {{ $penerimaans->tanggal }} </span>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="row"> 
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Kode Permintaan : {{ $penerimaans->kode_permintaan }}</label>
										<p style="display: inline-block;" id="nama_material"></p>
										<input type="hidden" name="kode_permintaan" id="kode_permintaan">
									</div>
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Kode Penerimaan : {{ $penerimaans->kode_penerimaan }}</label>
										<p style="display: inline-block;" id="nama_material"></p>
										<input type="hidden" name="kode_permintaan" id="kode_permintaan">
									</div>
								</div>
							</div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-y:auto; overflow-x:scroll;">
									<table class="table table-bordered waste" id="table_waste">
										<tr>
											<th rowspan="2">No.</th>
											<th rowspan="2" style="width: 200px;">Nama Material</th>
											<th colspan="5" align="center" style="text-align: center;">VOLUME</th>
											<th rowspan="2">Satuan</th>
											<th rowspan="2" style="width: 120px;">Harga Satuan</th>
											<th rowspan="2" style="width: 150px;">Keterangan/ Uraian</th>
										</tr>
										<tr>
											<th>Total Permintaan</th>
											<th>sd. yang Lalu</th>
											<th>Saat ini</th>
											<th>sd. Saat ini</th>
											<th>Sisa</th>
										</tr>
										<tbody class="data">
											<?php $no = 0;$i=0; ?>
											@foreach ($details as $detail)
												<?php $no++; ?>
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $detail->material->nama }}</td>
													<td>{{ $detail->penerimaan->permintaan->permintaanDetail[$i]->volume }}</td>
													<td>{{ $detail->vol_lalu }}</td>
													<td>{{ $detail->vol_saat_ini }}</td>
													<td>{{ $detail->vol_jumlah }}</td>
													<td>{{ $detail->vol_sisia }}</td>
													<td>{{ $detail->satuan }}</td>
													<td>{{ $detail->harga }}</td>
													<td>{{ $detail->keterangan }}</td>
												</tr>
												<?php $i++?>
											@endforeach		
										</tbody>
									</table>
								</div>
							</div>
							<div class="ln_solid"></div>
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="note" class="form-control col-md-6 col-xs-6" cols="15" rows="8" required></textarea>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group" style="float:right;">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<a class="btn btn-primary" href="{{url('/Logistik/manager/penerimaan')}}">Cancel</a>
									<button type="submit" name="reject" class="btn" style="background-color:#D63031; color:#FFFFFF;">Reject</button>
									<button type="submit" name="approve" class="btn btn-success">Approve</button>
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
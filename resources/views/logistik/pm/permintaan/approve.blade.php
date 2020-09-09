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
						<h2>Permintaan Material </h2>
						<span style="float:right; color:#73879C;"> Tanggal Permintaan : {{ $permintaans->tanggal }} </span>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="row"> 
								<div class="col-md-6">
									<div class="form-group">
										<label style="display: inline-block;" for="nama">Kode Permintaan : {{ $permintaans->kode_permintaan }}</label>
										<p style="display: inline-block;" id="nama_material"></p>
										<input type="hidden" name="kode_permintaan" id="kode_permintaan">
									</div>
								</div>
							</div>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered permintaan" id="table_permintaan">
								<tr>
									<th>No.</th>
									<th>Nama Material</th>
									<th>No Part / Type</th>
									<th>Volume</th>
									<th>Satuan</th>
									<th>Tanggal Pakai</th>
									<th>Keperluan</th>
									<th>Keterangan</th>
								</tr>
								<tbody>
									<?php $i = 1;?>
									@foreach($details as $detail)
										<tr>
											<td>{{$i++}}</td>
											<td>{{$detail->detailPermintaanMaterial->nama}}</td>
											<td>{{$detail->no_part}}</td>
											<td>{{$detail->volume}}</td>
											<td>{{$detail->satuan}}</td>
											<td>{{$detail->tgl_pakai}}</td>
											<td>{{$detail->keperluan}}</td>
											<td>{{$detail->keterangan}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="ln_solid"></div>
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="note" class="form-control col-md-6 col-xs-6" cols="15" rows="8" required></textarea>
								</div>
							</div>
							<div class="ln_solid"></div>
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6">Attachment :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									@if(file_exists('upload/permintaan/'.$permintaans->file) && $permintaans->file)
							          <img src="{{url('upload/permintaan').'/'.$permintaans->file}}" width="400" align="center">
							      @endif
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group" style="float:right; margin-right:4em;">
								<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/Logistik/pm/permintaan')}}">Cancel</a>
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
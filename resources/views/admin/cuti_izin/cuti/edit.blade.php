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
						<h2>Cuti Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">NIP <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<p style="padding: 6px 12px; font-size: 15px;">{{$cuti->nip}}</p>
									</div>
								</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p style="padding: 6px 12px;">{{$cuti->pegawai->nama}}</p>
									<input type="hidden" name="nip" value="{{$cuti->nip}}">
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Cuti Terkahir * :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='{{konversi_tanggal($cuti->tanggal_mulai_terakhir)}}' name='tanggal_mulai_terakhir' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						            </div>
						            *tanggal mulai cuti terakhir
								</div>
							</div>
							<br>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Cuti * :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker1' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='{{konversi_tanggal($cuti->tanggal_mulai)}}' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-3 col-sm-3 col-xs-12">Selesai Cuti * :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker2' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='{{konversi_tanggal($cuti->tanggal_selesai)}}' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Maksud Cuti izin:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alasan" class="form-control col-md-7 col-xs-12">{{$cuti->alasan}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tujuan / Alamat Selama Cuti:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="alamat_cuti" class="form-control col-md-7 col-xs-12">{{$cuti->alamat_cuti}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Alat Angkutan yang digunakan:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="angkutan" class="form-control col-md-7 col-xs-12" value="{{$cuti->angkutan}}">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Penyerahan Tugas Kepada <span class="required">*</span>:</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control pegawai pengganti" name="pengganti" required="required" id="pengganti">
										<option value="">Pilih Karyawan</option>
										@foreach($penggantis as $pengganti)
											<?php
												$selected = ($pengganti->nip == $cuti->pengganti)? 'selected' : '';
											?>
											<option value="{{$pengganti->nip}}" {{$selected}}>{{strtoupper($pengganti->nip)}} - {{$pengganti->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									@if($cuti->is_verif_admin != 1)
										<button type="submit" name="approve" class="btn btn-success">Approve</button>
									@else
										<button type="submit" name="edit" class="btn btn-success">Edit</button>
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
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.pegawai').select2();

		    $('#datepicker').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});

	    	$('#datepicker1').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});

	    	$('#datepicker2').datepicker({
		        format: 'dd-mm-yyyy',
		        autoclose: true
	    	});
		});
	</script>
@endpush
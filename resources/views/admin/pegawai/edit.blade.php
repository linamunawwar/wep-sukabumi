
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
						<h2>Edit Pegawai</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" class="form-horizontal form-label-left" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="nama" name="nama" required="required" class="nama form-control col-md-7 col-xs-12" value="{{$pegawai->nama}}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Kelamin :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div id="gender" class="btn-group" data-toggle="buttons">
											<?php $active = ($pegawai->gender=='P')?'active':''; ?>
											<label class="btn btn-default {{$active}}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
												<?php $status = ($pegawai->gender=='P')?'checked':''; ?>
												<input type="radio" name="gender" value="P" {{$status}}> &nbsp; Pria &nbsp;
											</label>
											<?php $active = ($pegawai->gender=='W')?'active':''; ?>
											<label class="btn btn-default {{$active}}" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
												<?php $status = ($pegawai->gender=='P')?'checked':''; ?>
												<input type="radio" name="gender" value="W" {{$status}}> Wanita
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Lahir * :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<!-- <fieldset>
											<div class="control-group">
												<div class="controls">
													<div class="col-md-11 xdisplay_inputx form-group has-feedback">
														<input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Lahir" name="tgl_lahir" aria-describedby="inputSuccess2Status">
														<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
											 			<span id="inputSuccess2Status" class="sr-only">(success)</span>
													</div>
												</div>
											</div>
										</fieldset> -->
										<div class='input-group date' id='datepicker' class="datepicker">
											<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
							                <input type='text' name='tgl_lahir' class='form-control' required="required" value="{{konversi_tanggal($pegawai->tanggal_lahir)}}" />
							            </div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Bagian <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12" required="required" name="kode_bagian">
											<option value="">Pilih Bagian</option>
											@foreach($kode as $kd)
												 <?php $selected = ($pegawai->kode_bagian==$kd->kode) ?'selected':'';?>
												<option value="{{$kd->kode}}" {{$selected}}>{{$kd->description}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Posisi <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12" required="required" name="posisi_id">
											<option value="">Pilih Posisi</option>
											@foreach($posisi as $kd)
												 <?php $selected = ($pegawai->posisi_id==$kd->id) ?'selected':'';?>
												<option value="{{$kd->id}}" {{$selected}}>{{$kd->posisi}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Masuk * :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class='input-group date' id='datepicker2' class="datepicker">
											<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
							                <input type='text' value="{{konversi_tanggal($pegawai->tanggal_masuk)}}" name='tgl_masuk' class='form-control' required="required" />
							            </div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Role <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12" required="required" name="role">
											<option value="">Pilih Role</option>
											@foreach($roles as $role)
												<?php $selected = ($pegawai->user->role_id==$role->id) ?'selected':'';?>
												<option value="{{$role->id}}" {{$selected}}>{{$role->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" type="button" href="{{url('admin/pegawai')}}">Cancel</a>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Submit</button>
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
	console.log('af');
	// $('.daterangepicker').daterangepicker({
	//     singleDatePicker: true,
	//     showDropdowns: true,
	//     minYear: 1950,
	//     maxYear: parseInt(moment().format('YYYY'),10)
	//    });

	$(document).ready(function(){
      $('#datepicker').datepicker({
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
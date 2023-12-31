
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
						<h2>Tambah Pegawai</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Nama Karyawan <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="nama" name="nama" required="required" class="nama form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Kelamin :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div id="gender" class="btn-group" data-toggle="buttons">
											<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
												<input type="radio" name="gender" value="P"> &nbsp; Pria &nbsp;
											</label>
											<label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
												<input type="radio" name="gender" value="W"> Wanita
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
							                <input type='text' value='' name='tgl_lahir' class='form-control' required="required" placeholder="dd-mm-yyyy" />
							            </div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Bagian <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12 bagian" required="required" name="kode_bagian" id="bagian">
											<option value="">Pilih Bagian</option>
											@foreach($kode as $kd)
												<option value="{{$kd->kode}}">{{$kd->description}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Posisi <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12 posisi" id="posisi" required="required" name="posisi_id">
											<option value="">Pilih Posisi</option>
											<!-- @foreach($posisi as $kd)
												<option value="{{$kd->id}}">{{$kd->posisi}}</option>
											@endforeach -->
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12"> Status Kepegawaian <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12" required="required" name="status_pegawai">
											<option value="">Pilih Status</option>
											<option value="PT">Pegawai Tetap</option>
											<option value="PTT">Pegawai Tidak Tetap</option>
											<option value="OS">Outsourcing</option>
											<option value="Harian">Harian</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="tgl_lahir" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Masuk * :</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class='input-group date' id='datepicker2' class="datepicker">
											<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
							                <input type='text' value='' name='tgl_masuk' class='form-control' required="required" />
							            </div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kode_bagian"> Role <span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md-7 col-xs-12" required="required" name="role">
											<option value="">Pilih Role</option>
											@foreach($roles as $role)
												<option value="{{$role->id}}">{{$role->name}}</option>
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

      	$(document).on("change", "#bagian", function(e){
	      	var kode = $(this).val();

	      	$.ajax({
	            url  : laravel_base+'/admin/pegawai/posisi/'+kode,
	            type : 'get',
	            success:function(response){
	            	var opt = '<select class="form-control col-md-7 col-xs-12 posisi" id="posisi" required="required" name="posisi_id"><option value="">Pilih Posisi</option>';
	                $.each(response, function(key,valueObj){
	                	opt += '<option value='+valueObj.id+'>'+valueObj.posisi+'</option>';
	                })
	                opt += '</select>';
	                $('#posisi').html(opt);
	            }
	        });
	    });
  	});

</script>
@endpush
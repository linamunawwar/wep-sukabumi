
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
						<h2>Edit Role</h2>
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
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">NIP<span class="required">*</span>:</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="nip" name="nip" required="required" class="nama form-control col-md-7 col-xs-12" value="{{$pegawai->nip}}" readonly="readonly">
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
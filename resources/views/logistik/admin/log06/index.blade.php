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
		font-size: 13px;
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
						<h2>Evaluasi Pemakaian Material (Log-06) </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Mulai :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker1' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label for="tgl_lahir" class="control-label col-md-2 col-sm-3 col-xs-12">Tanggal Selesai :</label>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class='input-group date' id='datepicker2' class="datepicker">
										<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
						                <input type='text' value='' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
						            </div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4">
									<button type="submit" class="btn btn-success">Proses</button>
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
  	$('#datepicker1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});

	$('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
	});
  </script>
 @endpush
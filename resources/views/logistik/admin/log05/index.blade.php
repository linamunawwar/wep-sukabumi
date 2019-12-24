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
                            <div id="SearchForm">
								<div class="row">
									<div class="col-md-12"  style="padding: 0; margin: 0;">
										<div class="form-group">
											<label style="line-height:20px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Tanggal Mulai</label>
											<div class="col-md-3 col-sm-3 col-xs-3">
                                                <div class='input-group date' id='datepicker1' class="datepicker">
                                                    <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                                                    <input type='text' value='' name='tanggal_mulai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
                                                </div>                                     
											</div>
										</div>
										<div class="form-group" style="margin-top:-6em;">
											<label style="line-height:20px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Tanggal Selesai</label>
											<div class="col-md-3 col-sm-3 col-xs-3">
                                                <div class='input-group date' id='datepicker2' class="datepicker">
                                                    <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                                                    <input type='text' value='' name='tanggal_selesai' class='form-control' required="required" placeholder="dd-mm-yyyy" />
                                                </div>                                      
                                            </div>	
                                            <div class="col-md-1">
                                                <button class="btn btn-primary pull-right" id="search">Search</button>
                                            </div>
                                        </div>                                        
									</div>
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
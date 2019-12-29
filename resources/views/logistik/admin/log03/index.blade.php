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
						<h2>Laporan Evaluasi Mingguan Pengadaan Bahan (Log-03) </h2>
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
												<label style="line-height:20px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Kode Permintaan ( BPM )</label>
												<div class="col-md-3 col-sm-3 col-xs-3">
													<div class='input-group'>
														<input type='text' value='' name='kodePermintaan' class='form-control' required="required" placeholder="Kode Permintaan" />
													</div>                                     
												</div>
											</div>   
										<div class="form-group" style="margin-top:-6em;">	
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
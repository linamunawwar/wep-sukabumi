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
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<div class="btn btn-default" title="Download" style="background-color:#0984E3; color:#FFFFFF;  padding:0.5em 0.7em 0.5em 0.7em; margin-top:0.3em; width:8em;"> <b>Download</b> <i class="fa fa-download" style="font-size:15px;"></i>  </div>
								
							</li>
						</ul><br><br>
						<p> Kode Material : </p>
						<p> Nama Material : </p>
						<p> Total Stok : </p>
						
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 2em; color:#000; font-weight: bold">
								<p>
									<h2>Laporan Barang Masuk</h2>
								</p>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<table id="materialMasuk" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th scope="col"> No </th>
											<th scope="col"> Tanggal Masuk </th>
											<th scope="col"> Tanggal Keluar </th>
											<th scope="col"> Jumlah </th>
											<th scope="col"> Keterangan </th>
										</tr>
									</thead>
									<tbody>	
																	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 2em; margin-bottom: 2em; color:#000; font-weight: bold">
								<p>
									<h2>Laporan Barang Keluar</h2>
								</p>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<table id="materialKeluar" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th scope="col"> No </th>
											<th scope="col"> Tanggal Masuk </th>
											<th scope="col"> Tanggal Keluar </th>
											<th scope="col"> Jumlah </th>
											<th scope="col"> Keterangan </th>
										</tr>
									</thead>
									<tbody>	
																	
									</tbody>
								</table>
							</div>
						</div>
												
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- /page content -->

@endsection

@push('scripts')
  	<script type="text/javascript">
		var materialMasuk = $('#materialMasuk').DataTable();		

		var materialKeluar = $('#materialKeluar').DataTable();		
	</script>
 @endpush
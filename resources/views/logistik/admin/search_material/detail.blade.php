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
						<h2>Detail Laporan Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<a href="{{ url('Logistik/admin/search_material/unduh/'.$material->material_id.'') }}" class="btn btn-default" title="Download" style="background-color:#0984E3; color:#FFFFFF;  padding:0.5em 0.7em 0.5em 0.7em; margin-top:0.3em; width:8em;"> <b>Download</b> <i class="fa fa-download" style="font-size:15px;"></i>  </a>
							</li>
						</ul><br><br>
						<p> Kode Material : {{ $material->material->kode_material }}</p>
						<p> Nama Material : {{ $material->material->nama }} &nbsp;&nbsp;&nbsp; <span style="font-weight: bold">({{ $material->material->satuan }})</span></p>
						<p> Total Stok : {{ $stok }} </p>
						
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 2em; color:#000; font-weight: bold">
								<p>
									<h2>Laporan Barang Masuk & Keluar</h2>
								</p>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<table id="materialMasuk" class="table table-striped table-bordered" style="text-align: center">
									<thead>
										<tr>
											<th scope="col" style="text-align: center"> No </th>
											<th scope="col" style="text-align: center"> Tanggal Masuk </th>
											<th scope="col" style="text-align: center"> Tanggal Keluar </th>
											<th scope="col" style="text-align: center"> Keterangan </th>
											<th scope="col" style="text-align: center"> Jumlah </th>
											<th scope="col" style="text-align: center"> Penerima </th>
										</tr>
									</thead>
									<tbody>	
											<?php $no = 0; ?>
											@for ($i = 0; $i < count($details); $i++)
											<?php $no++; ?>
												<tr>
													<td scope="col"> {{ $no }} </td>
													<td scope="col"> 
														@if (isset($details[$i]['penerimaan_id']))
															<span style="color: #27ae60">{{ date("d M Y", strtotime($details[$i]['tanggal_terima'])) }}</span>
														@else
															-
														@endif	
													</td>
													<td scope="col"> 
														@if (isset($details[$i]['pengajuan_id']))
															<span style="color: #e74c3c">{{ date("d M Y", strtotime($details[$i]['tanggal_keluar'])) }}</span>
														@else
															-
														@endif	
													</td>
													<td scope="col"> 
														@if (isset($details[$i]['penerimaan_id']))
															{{ $details[$i]['keterangan']!=''?$details[$i]['keterangan']:'-' }}
														@else
															-
														@endif
													</td>
													<td scope="col"> 
														@if (isset($details[$i]['penerimaan_id']))
															{{ $details[$i]['vol_saat_ini'] }}
														@elseif(isset($details[$i]['pengajuan_id']))
															{{ $details[$i]['pemyerahan_jumlah'] }}
														@endif	
													</td>
													<td scope="col"> 
														@if (isset($details[$i]['penerimaan_id']))
															{{ $details[$i]['penerimaMasuk'] }}
														@elseif(isset($details[$i]['pengajuan_id']))
															{{ $details[$i]['penerimaKeluar'] }}
														@endif	
													</td>
												</tr>
											@endfor						
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
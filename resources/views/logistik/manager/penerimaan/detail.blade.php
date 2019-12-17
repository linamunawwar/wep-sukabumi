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
						<h2>Penerimaan Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/manager/penerimaan/')}}"><button class="btn btn-success"> Kembali </button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table table-bordered waste" id="table_waste">
							<tr>
								<th rowspan="2">No.</th>
								<th rowspan="2" style="width: 200px;">Nama Material</th>
								<th colspan="5" align="center" style="text-align: center;">VOLUME</th>
								<th rowspan="2">Satuan</th>
								<th rowspan="2" style="width: 120px;">Harga Satuan</th>
								<th rowspan="2" style="width: 150px;">Keterangan/ Uraian</th>
							</tr>
							<tr>
								<th>Total Permintaan</th>
								<th>sd. yang Lalu</th>
								<th>Saat ini</th>
								<th>sd. Saat ini</th>
								<th>Sisa</th>
							</tr>
							<tbody class="data">
								<?php $no = 0;$i=0; ?>
                                @foreach ($details as $detail)
	                                <?php $no++; ?>
									<tr>
										<td>{{ $no }}</td>
										<td>{{ $detail->material->nama }}</td>
										<td>{{ $detail->penerimaan->permintaan->permintaanDetail[$i]->volume }}</td>
										<td>{{ $detail->vol_lalu }}</td>
										<td>{{ $detail->vol_saat_ini }}</td>
										<td>{{ $detail->vol_jumlah }}</td>
										<td>{{ $detail->vol_sisia }}</td>
										<td>{{ $detail->satuan }}</td>
										<td>{{ $detail->harga }}</td>
										<td>{{ $detail->keterangan }}</td>
									</tr>
									<?php $i++?>
								@endforeach		
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection
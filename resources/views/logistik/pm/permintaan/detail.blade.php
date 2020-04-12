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
							<li><a href="{{url('Logistik/pm/permintaan/')}}"><button class="btn btn-success"> Kembali </button></a></li>
						</ul><br><br>
						<p>Kode Permintaan : 
							@if($details[0]->detailPermintaan->kode_permintaan)
								{{  $details[0]->detailPermintaan->kode_permintaan}}
							@endif
						</p>
						<p>
							Nomor : {{$findPermintaan['nomor']}}/BPM/WK/DIII/BK/20
						</p>
						<div class="form-group">
							<label class="control-label col-md-1" style="padding: 0;">Lampiran :</label>
							<?php
								if($details[0]->detailPermintaan->file){
									$file = $details[0]->detailPermintaan->file;
								}else{
									$file = '-';
								}
							?>
							@if((file_exists("upload/permintaan/$file")) && $file)
								<b><a href='{{url("upload/permintaan/$file")}}' class="col-md-7 col-xs-12" target="_blank">
									<i class="fa fa-search-plus"></i>&nbsp&nbsp&nbspPreview
								</a></b>
							@endif
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> No </th>
									<th scope="col"> Nama Material </th>
									<th scope="col"> No Part </th>
									<th scope="col"> Volume </th>
									<th scope="col"> Satuan </th>
									<th scope="col"> Keperluan </th>
								</tr>
							</thead>
							<tbody>	
								<?php $no = 1; ?> 
								@foreach ($details as $detail)
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $detail->detailPermintaanMaterial->nama }}</td>
									<td>{{ $detail->no_part }}</td>
									<td>{{ $detail->volume }}</td>
									<td>{{ $detail->satuan }}</td>
									<td>{{ $detail->keperluan }}</td>
									</tr>
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
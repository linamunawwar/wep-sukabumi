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
								@if ($notifPermintaan->is_scarm == 1)
									<a class="btn btn-default" title="Download" style="background-color:#0984E3; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em; margin-top:0.3em; width:8em;" href="{{url('Logistik/admin/permintaan/unduh/'.$notifPermintaan->id.'')}}"> <b>Download</b> <i class="fa fa-download" style="font-size:15px;"> </i>  </a>
								@else
								<div class="btn btn-dark" title="Download" style="color:#FFFFFF;  padding:0.5em 0.7em 0.5em 0.7em; margin-top:0.3em; width:8em; opacity: 0.5;"> <b>Download</b> <i class="fa fa-download" style="font-size:15px;opacity: 0.5;"></i>  </div>
								@endif
							</li>
							<li><a href="{{url('Logistik/manager/permintaan/')}}"><button class="btn btn-success"> Kembali </button></a></li><br>
							<li><button data-toggle="modal" title="Status Approval" data-target="#StatusApproval" id="status-approval" onclick='ApproveStatus("{{$details[0]->permintaan_id}}"' class="btn btn-default" style="margin-left:0em; width:14.3em; background-color:#FF9800; color:#FFF;"> Status Approval </button></li>
							
						</ul><br><br>
						<p>Kode Permintaan : 
							@if($details[0]->detailPermintaan->kode_permintaan)
								{{  $details[0]->detailPermintaan->kode_permintaan}}
							@endif
						</p>
						<p>
							@php
								$year = substr($details[0]->created_at, 2,2);
							@endphp
							Nomor : {{$findPermintaan['nomor']}}/BPM/WK/INF2/BCKY-2AU/{{$year}}
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
									<th scope="col"> Tanggal Pakai </th>
									<th scope="col"> Keperluan </th>
									<th scope="col"> Keterangan </th>
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
									<td>{{ konversi_tanggal($detail->tgl_pakai) }}</td>
									<td>{{ $detail->keperluan }}</td>
									<td>{{ $detail->keterangan }}</td>
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
	
	<div id="StatusApproval" class="modal fade" style="color:#FFF;" role="dialog">
		<div class="modal-dialog ">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="background-color:#FF9800;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Status Approval</h4>
				</div>
				<div class="modal-body" style="color:#353b48;">
					<span>
						<h4> {{ $notifPermintaan->titleNameSom }} </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td width="70px">Tanggal </td>
									<td> : {{ $notifPermintaan->bodyDateSom }}</td>
								</tr>
								<tr>
									<td>Waktu </td>
									<td> : {{ $notifPermintaan->bodyTimeSom }}</td>
								</tr>
							</table>   
						</p>
					</span>
					<hr>
					<p></p>
					<span>
						<h4> {{ $notifPermintaan->titleNameSlem }} </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td width="70px">Tanggal </td>
									<td> : {{ $notifPermintaan->bodyDateSlem }}</td>
								</tr>
								<tr>
									<td>Waktu </td>
									<td> : {{ $notifPermintaan->bodyTimeSlem }}</td>
								</tr>
							</table>   
						</p>
					</span>
					<hr>
					<p></p>
					<span>
						<h4> {{ $notifPermintaan->titleNameScarm }} </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td width="70px">Tanggal </td>
									<td> : {{ $notifPermintaan->bodyDateScarm }}</td>
								</tr>
								<tr>
									<td>Waktu </td>
									<td> : {{ $notifPermintaan->bodyTimeScarm }}</td>
								</tr>
							</table>   
						</p>
					</span>
					<hr>
					<p></p>
					<span>
						<h4> {{ $notifPermintaan->titleNamePm }} </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td width="70px">Tanggal </td>
									<td> : {{ $notifPermintaan->bodyDatePm }}</td>
								</tr>
								<tr>
									<td>Waktu </td>
									<td> : {{ $notifPermintaan->bodyTimePm }}</td>
								</tr>
							</table>   
						</p>
					</span>
				</div>
			</div>
		</div>
	</div>
@endsection
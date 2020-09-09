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
							<li><a href="{{url('Logistik/admin/permintaan/')}}"><button class="btn btn-success"> Kembali </button></a></li><br>
							<li><button data-toggle="modal" title="Status Approval" data-target="#StatusApproval" id="status-approval" onclick='ApproveStatus("{{$details[0]->permintaan_id}}"' class="btn btn-default" style="margin-left:0em; width:14.3em; background-color:#FF9800; color:#FFF;"> Status Approval </button></li>
							
						</ul><br><br>
						<p>Kode Permintaan : 
							@if($details[0]->detailPermintaan->kode_permintaan)
								{{  $details[0]->detailPermintaan->kode_permintaan}}
							@endif
						</p>
						<p>
							Nomor : {{$findPermintaan['nomor']}}/BPM/WK/INF2/BCKY-2AU/20
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
						<h4> <span style="color:{{ $notifPermintaan->colorSom }};" > {{ $notifPermintaan->titleNameSom }} </span> </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td style="color:{{ $notifPermintaan->colorSom }};"  width="70px">Tanggal </td>
									<td style="color:{{ $notifPermintaan->colorSom }};" > : {{ $notifPermintaan->bodyDateSom }}</td>
								</tr>
								<tr>
									<td style="color:{{ $notifPermintaan->colorSom }};" >Waktu </td>
									<td style="color:{{ $notifPermintaan->colorSom }};" > : {{ $notifPermintaan->bodyTimeSom }}</td>
								</tr>
							</table>   
						</p>
					</span>
					<hr>
					<p></p>
					<span>
						<h4> <span style="color:{{ $notifPermintaan->colorSlem }};" > {{ $notifPermintaan->titleNameSlem }} </span> </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td style="color:{{ $notifPermintaan->colorSlem }};"  width="70px">Tanggal </td>
									<td style="color:{{ $notifPermintaan->colorSlem }};" > : {{ $notifPermintaan->bodyDateSlem }}</td>
								</tr>
								<tr>
									<td style="color:{{ $notifPermintaan->colorSlem }};" >Waktu </td>
									<td style="color:{{ $notifPermintaan->colorSlem }};" > : {{ $notifPermintaan->bodyTimeSlem }}</td>
								</tr>
							</table>   
						</p>
					</span>
					<hr>
					<p></p>
					<span>
						<h4> <span style="color:{{ $notifPermintaan->colorScarm }};" > {{ $notifPermintaan->titleNameScarm }} </span> </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td style="color:{{ $notifPermintaan->colorScarm }};"  width="70px">Tanggal </td>
									<td style="color:{{ $notifPermintaan->colorScarm }};" > : {{ $notifPermintaan->bodyDateScarm }}</td>
								</tr>
								<tr>
									<td style="color:{{ $notifPermintaan->colorScarm }};" >Waktu </td>
									<td style="color:{{ $notifPermintaan->colorScarm }};" > : {{ $notifPermintaan->bodyTimeScarm }}</td>
								</tr>
							</table>   
						</p>
					</span>
					<hr>
					<p></p>
					<span>
						<h4> <span style="color:{{ $notifPermintaan->colorPm }};" > {{ $notifPermintaan->titleNamePm }} </span> </h4>
						<p style="color:#576574;">
							<table>
								<tr>
									<td style="color:{{ $notifPermintaan->colorPm }};"  width="70px">Tanggal </td>
									<td style="color:{{ $notifPermintaan->colorPm }};" > : {{ $notifPermintaan->bodyDatePm }}</td>
								</tr>
								<tr>
									<td style="color:{{ $notifPermintaan->colorPm }};" >Waktu </td>
									<td style="color:{{ $notifPermintaan->colorPm }};" > : {{ $notifPermintaan->bodyTimePm }}</td>
								</tr>
							</table>   
						</p>
					</span>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
  <script type="text/javascript">
	$('#modal-note').on("click",function(){
		var id_penerimaan = $(this).attr('id_penerimaan');
	   $('#id_penerimaan').val(id_penerimaan);
	});

	function ApproveStatus(id)
	{
		var id = id;
		var url = '{{ url("Logistik/admin/permintaan/statusApprove") }}';
		console.log(id);
		$('#id_penerimaan').val(id);
		$.ajax({
			url  : '{{ url("Logistik/admin/permintaan/statusApprove") }}/'+id,
			type : 'get',
			success:function(response){
				console.log(response)
				$('#title').html(response);
			}
		});
	}
 @endpush
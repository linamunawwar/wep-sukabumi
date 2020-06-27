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
						<h2>Daftar Cuti Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Mulai Cuti</th>
									<th>Selesai Cuti</th>
									<th>Tanggal Pengajuan</th>
									<th>Status Cuti</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cutis as $cuti)
									<tr>
										<td>{{$cuti->nip}}</td>
										<td>{{$cuti->pegawai->nama}}</td>
										<td>{{$cuti->pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($cuti->tanggal_mulai)}}</td>
										<td>{{konversi_tanggal($cuti->tanggal_selesai)}}</td>
										<td data-sort="{{strtotime($cuti->created_at)}}">
											<?php
												$date = explode(' ', $cuti->created_at);
											?>
											{{konversi_tanggal($date[0])}}
										</td>
										<td>
											@if($cuti->is_verif_pengganti == 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($cuti->is_verif_pengganti == 1) && ($cuti->is_verif_admin == 0) && ($cuti->is_verif_mngr == 0) && ($cuti->is_verif_sdm == 0) && ($cuti->is_verif_pm == 0))
												<span class="label label-primary">Approved by Pengganti</span>
											@elseif(($cuti->is_verif_pengganti == 1) && ($cuti->is_verif_admin == 1) && ($cuti->is_verif_mngr == 0) && ($cuti->is_verif_sdm == 0) && ($cuti->is_verif_pm == 0))
												<span class="label label-primary">Approved by Pengganti</span>
												<span class="label label-warning">Approved by Admin</span>
											@elseif(($cuti->is_verif_pengganti == 1) && ($cuti->is_verif_admin == 1) && ($cuti->is_verif_mngr == 1) && ($cuti->is_verif_sdm == 0) && ($cuti->is_verif_pm == 0))
												<span class="label label-primary">Approved by Pengganti</span>
												<span class="label label-warning">Approved by Admin</span>
												<span class="label label-primary">Approved by Manager</span>
											@elseif(($cuti->is_verif_pengganti == 1) && ($cuti->is_verif_admin == 1) && ($cuti->is_verif_mngr == 1) && ($cuti->is_verif_sdm == 1) && ($cuti->is_verif_pm == 0))
												<span class="label label-primary">Approved by Pengganti</span>
												<span class="label label-warning">Approved by Admin</span>
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
											@elseif($cuti->is_verif_pm == 1)
												<span class="label label-primary">Approved by Pengganti</span>
												<span class="label label-warning">Approved by Admin</span>
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
												<span class="label label-success">Approved by PM</span>
											@endif
										</td>
										<td style="text-align: center;">
											@if(($cuti->is_verif_pengganti == 1) && ($cuti->is_verif_admin == 1) && ($cuti->is_verif_mngr == 1) && ($cuti->is_verif_sdm == 1) && ($cuti->is_verif_pm == 0))
												<a class="btn btn-success btn-xs" href="{{url('pm/cuti/approve/'.$cuti->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
											@else
												<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
											@endif

											<!-- @if($cuti->is_verif_pm == 1)
												<a class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Surat Cuti</a>
											@else
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Surat Cuti</a>
											@endif -->
										</td>
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
@push('scripts')
<script type="text/javascript">

	$(document).ready(function () {
        var table = $('#datatable').DataTable();
 
		// Sort by column 1 and then re-draw
		table
		    .order( [ 5, 'desc' ] )
		    .draw();
		    });

</script>
@endpush
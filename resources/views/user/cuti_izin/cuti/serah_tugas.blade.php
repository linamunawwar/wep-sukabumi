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
						<h2>Daftar Penyerahan Tugas </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tugas Dari</th>
									<th>Posisi</th>
									<th>Mulai tugas</th>
									<th>Selesai tugas</th>
									<th>Status tugas</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tugass as $tugas)
									<tr>
										<td>{{$tugas->nip}} - {{$tugas->pegawai->nama}}</td>
										<td>{{$tugas->pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($tugas->tanggal_mulai)}}</td>
										<td>{{konversi_tanggal($tugas->tanggal_selesai)}}</td>
										<td>
											@if($tugas->is_verif_pengganti== 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($tugas->is_verif_pengganti == 1) && ($tugas->is_verif_mngr == 0) && ($tugas->is_verif_sdm == 0) && ($tugas->is_verif_pm == 0))
												<span class="label label-primary">Approved by Pengganti</span>
											@elseif(($tugas->is_verif_pengganti == 1) && ($tugas->is_verif_mngr == 1) && ($tugas->is_verif_sdm == 0) && ($tugas->is_verif_pm == 0))
												<span class="label label-primary">Approved by Pengganti</span>
												<span class="label label-primary">Approved by Manager</span>
											@elseif(($tugas->is_verif_sdm == 1) && ($tugas->is_verif_pm == 0))
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
											@elseif($tugas->is_verif_pm == 1)
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
												<span class="label label-success">Approved by PM</span>
											@endif
										</td>
										<td style="text-align: center;">
											@if($tugas->is_verif_pengganti == 0)
												<a class="btn btn-success btn-xs" href="{{url("user/cuti/approve/$tugas->id")}}"> Approve</a>
											@else
												<a class="btn btn-dark btn-xs">Approve</a>
											@endif
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
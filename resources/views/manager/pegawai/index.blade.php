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
						<h2>Daftar Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th style="width: 15%;">Jabatan</th>
									<th style="width: 15%;">Mulai Tugas Di Proyek</th>
									@if(\Auth::user()->role_id == 4 )
										<th>Password</th>
									@endif
									<th>Action</th>
									<th>Status</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>

								@foreach($pegawais as $pegawai)
									<tr>
										<td>{{$pegawai->nip}}</td>
										<td>{{$pegawai->nama}}</td>
										<td>{{$pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($pegawai->tanggal_masuk)}}</td>
										@if(\Auth::user()->role_id == 4)
											<td>{{$pegawai->user->pass_asli}}</td>
										@endif
										<td>
											@if($pegawai->is_active == 1)
												<a class="btn btn-success btn-xs" href="{{url('manager/unduh_cv/'.$pegawai->nip.'')}}"><i class="fa fa-download"></i> CV </a>
												<a class="btn btn-success btn-xs" href="{{url('manager/unduh_mcu/'.$pegawai->nip.'')}}"><i class="fa fa-download"></i> MCU </a> 
												<a class="btn btn-success btn-xs" href="{{url('manager/unduh_pkwt/'.$pegawai->nip.'')}}"><i class="fa fa-download"></i> PKWT </a>
											@else
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> CV </a>
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> MCU </a> 
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i> PKWT </a>
											@endif
												
										</td>
										<td style="text-align: center;">
											@if($pegawai->is_verif_admin == 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($pegawai->is_verif_admin == 1) && ($pegawai->is_verif_pm == 0))
												<span class="label label-primary">Approved by Admin</span>
											@elseif($pegawai->is_verif_pm == 1)
												<span class="label label-primary">Approved by Admin</span>	
												<span class="label label-success">Approved by PM</span>
											@endif
										</td>
										<!-- <td style="text-align: center;">
											@if(($pegawai->is_verif_admin == 1) && ($pegawai->is_new == 0) && ($pegawai->is_verif_mngr == 0) && ($pegawai->user->role != 3))
												<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/approve/'.$pegawai->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
											@else
												<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
											@endif
										</td> -->
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
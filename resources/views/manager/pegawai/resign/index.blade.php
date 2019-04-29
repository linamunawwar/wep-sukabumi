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
						<h2>Daftar Pegawai Resign</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Tanggal Terakhir Kerja</th>
									<th>Status Resign</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($resigns as $resign)
									<tr>
										<td>{{$resign->nip}}</td>
										<td>{{$resign->pegawai->nama}}</td>
										<td>{{$resign->pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($resign->terakhir_kerja)}}</td>
										<td>
											@if($resign->is_verif_mngr== 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($resign->is_verif_mngr == 1) && ($resign->is_verif_sdm == 0) && ($resign->is_verif_pm == 0))
												<span class="label label-primary">Approved by Manager</span>
											@elseif(($resign->is_verif_sdm == 1) && ($resign->is_verif_pm == 0))
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
											@elseif($resign->is_verif_pm == 1)
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
												<span class="label label-success">Approved by PM</span>
											@endif
										</td>
										<td style="text-align: center;">
											@if(\Auth::user()->role_id == 4)
												@if($resign->pegawai->kode_bagian == 'SA')
													@if(($resign->is_verif_mngr == 0) && ($resign->is_verif_sdm == 0) )
														<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/resign/approve_sdm/'.$resign->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
													@else
														<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
													@endif
												@else
													@if(($resign->is_verif_mngr == 1) && ($resign->is_verif_sdm == 0) )
														<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/resign/approve_sdm/'.$resign->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
													@else
														<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
													@endif
												@endif
											@else
												@if($resign->is_verif_mngr == 0)
													<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/resign/approve/'.$resign->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
												@else
													<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
												@endif
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
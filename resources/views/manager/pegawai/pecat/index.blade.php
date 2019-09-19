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
						<h2>Daftar Pemberhentian Kerja Pegawai </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('manager/pegawai/pecat/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Tanggal Pemecatan</th>
									<th>Status Pemecatan</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>
								@foreach($pecats as $pecat)
									<tr>
										<td>{{$pecat->nip}}</td>
										<td>{{$pecat->pegawai->nama}}</td>
										<td>{{$pecat->pegawai->posisi->posisi}}</td>
										<td>{{konversi_tanggal($pecat->terakhir_kerja)}}</td>
										<td>
											@if($pecat->is_verif_mngr== 0)
												<span class="label label-default">Not Approved</span>
											@elseif(($pecat->is_verif_mngr == 1) && ($pecat->is_verif_sdm == 0) && ($pecat->is_verif_pm == 0))
												<span class="label label-primary">Approved by Manager</span>
											@elseif(($pecat->is_verif_sdm == 1) && ($pecat->is_verif_pm == 0))
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
											@elseif($pecat->is_verif_pm == 1)
												<span class="label label-primary">Approved by Manager</span>	
												<span class="label label-success">Approved by SDM</span>
												<span class="label label-success">Approved by PM</span>
											@endif
										</td>
										<!-- <td style="text-align: center;">
											@if(\Auth::user()->role_id == 4)
												@if($pecat->pegawai->kode_bagian == 'SA')
													@if(($pecat->is_verif_mngr == 0) && ($pecat->is_verif_sdm == 0) )
														<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/pecat/approve_sdm/'.$pecat->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
													@else
														<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
													@endif
												@else
													@if(($pecat->is_verif_mngr == 1) && ($pecat->is_verif_sdm == 0) )
														<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/pecat/approve_sdm/'.$pecat->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
													@else
														<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
													@endif
												@endif
											@else
												@if($pecat->is_verif_mngr == 0)
													<a class="btn btn-success btn-xs" href="{{url('manager/pegawai/pecat/approve/'.$pecat->id.'')}}"><i class="fa fa-check" ></i>  Approve</a>
												@else
													<button class="btn btn-dark btn-xs"><i class="fa fa-check"></i>  Approve</button>
												@endif
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
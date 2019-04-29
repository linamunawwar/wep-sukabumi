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
						<h2>Data Pengajuan Resign</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('user/pegawai/resign/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tanggal Terakhir Kerja</th>
									<th>Status Resign</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($resigns as $resign)
									<tr>
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
											@if($resign->is_verif_pm == 1)
												<a class="btn btn-success btn-xs"><i class="fa fa-download"></i>  SPK</a>
											@else
												<a class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  SPK</a>
												<!-- <a class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</a> -->
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
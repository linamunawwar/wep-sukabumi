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
						<h2>List Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Pengirim</th>
									<th>Kepada</th>
									<th>Tanggal Terima</th>
									<th>Sifat</th>
									<th>Perihal</th>
									<th>Tugas</th>
									<th >Action</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($disposisis as $disposisi)
									<tr>
										<td>{{$disposisi->no_surat}}</td>
										<td>{{$disposisi->pengirim}}</td>
										<td>{{$disposisi->kepada}}</td>
										<td>{{konversi_tanggal($disposisi->tanggal_terima)}}</td>
										<td>{{$disposisi->sifat}}</td>
										<td>{{$disposisi->perihal}}</td>
										<td>{{$disposisi->tugas}}</td>
										<td style="text-align: center;">
											@if($disposisi->status != 1)
												<a class="btn btn-warning btn-xs" href="{{url('manager/disposisi/proses/'.$disposisi->id.'')}}"><i class="fa fa-refresh"></i>  Proses</a>
												<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/monitor/'.$disposisi->id.'')}}"><i class="fa fa-eye"></i>  Monitor</a>
												<a class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											@else
												<a class="btn btn-dark btn-xs"><i class="fa fa-refresh"></i>  Proses</a>
												<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/monitoring/'.$disposisi->id.'')}}"><i class="fa fa-eye"></i>  Monitor</a>
												<a class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</a>
											@endif
											<?php $disposisi->no_surat = str_replace('/', '_', $disposisi->no_surat); ?>
											<a class="btn btn-success btn-xs" href="{{url('admin/surat_masuk/unduh/'.$disposisi->no_surat.'')}}"><i class="fa fa-download"></i>  Surat</a>
										</td>
										<td>
											@if($disposisi->status_akhir == 1)
												<span class="label label-success">DONE</span>
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
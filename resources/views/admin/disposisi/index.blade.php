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
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/disposisi/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Pengirim</th>
									<th>Kepada</th>
									<th>Kategori</th>
									<th>Tanggal Terima</th>
									<th>Sifat</th>
									<th>Perihal</th>
									<th style="width: 235px;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($disposisis as $disposisi)
									<tr>
										<td>{{$disposisi->no_surat}}</td>
										<td>{{$disposisi->pengirim}}</td>
										<td>{{$disposisi->kepada}}</td>
										<td>{{$disposisi->Kategori}}</td>
										<td>{{konversi_tanggal($disposisi->tanggal_terima)}}</td>
										<td>{{$disposisi->sifat}}</td>
										<td>{{$disposisi->perihal}}</td>
										<td style="text-align: center;">
											<a class="btn btn-default btn-xs" href="{{url('admin/disposisi/edit/'.$disposisi->id.'')}}"><i class="fa fa-edit"></i>  Edit</a>
											<a class="btn btn-danger btn-xs" href="{{url('admin/disposisi/delete/'.$disposisi->id.'')}}"><i class="fa fa-trash"></i>  Delete</a><br>
											@if($disposisi->status_akhir === false)
												<a class="btn btn-primary btn-xs" href="{{url('admin/disposisi/monitoring/'.$disposisi->id.'')}}"><i class="fa fa-eye"></i>  Monitor</a>
											@else
												<a class="btn btn-dark btn-xs" href="{{url('admin/disposisi/monitoring/'.$disposisi->id.'')}}"><i class="fa fa-eye"></i>  Monitor</a>
											@endif
											<a class="btn btn-success btn-xs" href="{{url('admin/disposisi/unduh/'.$disposisi->id.'')}}"><i class="fa fa-download"></i>  Unduh</a>
											<?php $disposisi->no_surat = str_replace('/', '_', $disposisi->no_surat); ?>
											<a class="btn btn-success btn-xs" href="{{url('admin/surat_masuk/unduh/'.$disposisi->no_surat.'')}}"><i class="fa fa-download"></i>  Surat</a>
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
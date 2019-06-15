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
						<h2>Monitoring Pelatihan </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/pegawai/pelatihan/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
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
									<th>Nama Pelatihan</th>
									<th>Tanggal Mulai Pelatihan</th>
									<th>Tanggal Berakhirnya Pelatihan</th>
									<th>Tempat Pelaksanaan</th>
									<th>Penyelenggara</th>
									<th>NO IM</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if(count($pelatihans) != 0)
									@foreach($pelatihans as $pelatihan)
										<tr>
											<td>{{$pelatihan->nip}}</td>
											<td>{{$pelatihan->pegawai->nama}}</td>
											<td>{{$pelatihan->pegawai->posisi->posisi}}</td>
											<td>{{$pelatihan->nama_pelatihan}}</td>
											<td>{{konversi_tanggal($pelatihan->tanggal_mulai)}}</td>
											<td>{{konversi_tanggal($pelatihan->tanggal_selesai)}}</td>
											<td>{{$pelatihan->tempat}}</td>
											<td>{{$pelatihan->penyelenggara}}</td>
											<td>{{$pelatihan->no_im}}</td>
											<td>
												<a href="{{'pelatihan/edit/'.$pelatihan->id.''}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>  Edit</a>
												<a href="{{'pelatihan/delete/'.$pelatihan->id.''}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>  Delete</a>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection
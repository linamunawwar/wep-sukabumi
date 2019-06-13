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
						<h2>Peminjaman Inventaris Proyek </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('admin/peralatan/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama Pegawai</th>
									<th>Nama Barang</th>
									<th>Tipe Barang</th>
									<th>Tanggal Pinjam</th>
									<th>Tanggal Kembali</th>
									<th>Status</th>
									<th style="width: 200px;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($alats as $alat)
									<tr>
										<td>{{$alat->nip}}</td>
										<td>{{$alat->pegawai->nama}}</td>
										<td>{{$alat->nama_barang}}</td>
										<td>{{$alat->tipe_barang}}</td>
										<td>{{konversi_tanggal($alat->tanggal_pinjam)}}</td>
										<td>{{konversi_tanggal($alat->tanggal_kembali)}}</td>
										<td style="text-align: center;">
											@if($alat->is_verif_sdm == 1)
												<span class="label label-primary">Approved</span>
											@else
												<span class="label label-default">Not Approved</span>
											@endif
											@if($alat->is_kembali == 1)
												<span class="label label-success">Dikembalikan</span>
											@endif
										</td>
										<td style="text-align: left;">
											<a href="{{'peralatan/edit/'.$alat->id.''}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  Edit</a>
											<a href="{{'peralatan/delete/'.$alat->id.''}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>  Delete</a>
											@if($alat->is_kembali != 1)
												<a href="{{'peralatan/kembali/'.$alat->id.''}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i>  Kembali</a >
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
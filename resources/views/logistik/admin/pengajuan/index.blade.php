@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 15px;
		font-weight: 400;
	}

	#datatable tbody tr td {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
</style>


@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Pengajuan Material </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"><b> No </b></th>
									<th scope="col"><b> Kode Penerimaan </b></th>
									<th scope="col"><b> Tanggal</b> </th>
									<th scope="col"><b> Jenis Pekerjaan </b></th>
									<th scope="col"><b> Lokasi Pekerjaan </b></th>
									<th scope="col"><b> Status </b></th>
									<th scope="col"><b> Action </b></th>
                                </tr>
							</thead>
							<tbody>	
								<?php $no = 0 ?>
								@foreach ($pengajuans as $pengajuan)
									<?php $no++ ?>
									<tr>
										<td>{{ $no }}</td>										
										<td>{{ $pengajuan->kode_penerimaan }}</td>										
										<td>{{ date('d F Y', strtotime($pengajuan->tanggal)) }}</td>										
										<td>{{ $pengajuan->pengajuanJenisPekerjaan->nama }}</td>										
										<td>{{ $pengajuan->pengajuanLokasiPekerjaan->nama }}</td>										
										<td style="color:{{ $pengajuan->color }};">{{ $pengajuan->text }}</td>										
										<td style="text-align:center;">
												<a class="btn btn-default btn-xs" style="background-color:#FF9800; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/pengajuan/detail/'.$pengajuan->id.'')}}"><i class="fa fa-th-list" style="font-size:15px;"></i>  </a>
												<a class="btn btn-default btn-xs" style="background-color:#1AAD19; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/pengajuan/edit/'.$pengajuan->id.'')}}"><i class="fa fa-pencil" style="font-size:15px;"></i>  </a>
                                                <a class="btn btn-default btn-xs" style="background-color:#0984E3; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/pengajuan/unduh/'.$pengajuan->id.'')}}"><i class="fa fa-download" style="font-size:15px;"></i>  </a>
                                                @if (
                                                        ((\Auth::user()->pegawai->posisi_id == 30) && ($pengajuan->is_admin != 1)) ||
                                                        ((\Auth::user()->pegawai->posisi_id == 8) && ($pengajuan->is_som != 1) && ($pengajuan->is_admin == 1)) || 
                                                        ((\Auth::user()->pegawai->posisi_id == 7) && ($pengajuan->is_admin == 1) && ($pengajuan->is_som == 1) && ($pengajuan->is_splem != 1)) || 
                                                        ((\Auth::user()->pegawai->posisi_id == 5) && ($pengajuan->is_som == 1) && ($pengajuan->is_splem == 1) && ($pengajuan->is_scarm != 1))
                                                    )
                                                    <br><a class="btn btn-default btn-xs" title="Approve" style="background-color:#049372; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/pengajuan/approve/'.$pengajuan->id.'')}}"><i class="fa fa-check" title="Approve" style="font-size:15px;"></i> Approve </a>
                                                @elseif(((\Auth::user()->pegawai->posisi_id == 8) && ($pengajuan->is_som == 1)) || ((\Auth::user()->pegawai->posisi_id == 7) && ($pengajuan->is_som == 1) && ($pengajuan->is_splem == 1)) || ((\Auth::user()->pegawai->posisi_id == 5) && ($pengajuan->is_som == 1) && ($pengajuan->is_splem == 1) && ($pengajuan->is_scarm == 1)))
                                                    <br><a class="btn btn-default btn-xs" style="background-color:#607D8B; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;"><i class="fa fa-close" style="font-size:15px;"></i> Approve </a>
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
	<div id="DeleteModal" class="modal fade text-danger" role="dialog">
			<div class="modal-dialog ">
				<!-- Modal content-->
				<form action="{{ url("Logistik/admin/pengajuan/delete") }}" id="deleteForm" method="post" >
					<div class="modal-content">
						<div class="modal-header bg-danger">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<p class="text-center">Anda yakin ingin menghapus data ini ?</p>
							<input type="hidden" name="id_pengajuan" id="id_pengajuan">
						</div>
						<div class="modal-footer">
							<center>
								<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
								<button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Ya, Hapus</button>
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
@endsection
@push('scripts')
  <script type="text/javascript">
  	$('#modal-delete').on("click",function(){
  		var id_pengajuan = $(this).attr('id_pengajuan');
         $('#id_pengajuan').val(id_pengajuan);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/pengajuan/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_pengajuan').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }

     var table = $('#datatable').DataTable();
		
	// Sort by column 1 and then re-draw
	table
	    .order( [ 5, 'desc' ] )
	    .draw();
  </script>
 @endpush
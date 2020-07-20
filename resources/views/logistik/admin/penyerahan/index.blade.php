@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
	<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#datatable tr th{
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 14px;
		font-weight: 600;
	}

	#datatable tr td{
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
						<h2>Permintaan Penyerahan </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
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
									<th scope="col"><b> Status Penyerahan </b></th>
									<th scope="col"><b> Action </b></th>
                                </tr>
							</thead>
							<tbody>	
								<?php $no = 0 ?>
								@foreach ($penyerahans as $penyerahan)
									<?php $no++ ?>
									<tr >
										<td>{{ $no }}</td>										
										<td>{{ $penyerahan->kode_penerimaan }}</td>	
										<td data-sort="{{strtotime($penyerahan->tanggal)}}">{{ date('d F Y', strtotime($penyerahan->tanggal)) }}</td>										
										<td>{{ $penyerahan->pengajuanJenisPekerjaan->nama }}</td>										
										<td>{{ $penyerahan->pengajuanLokasiPekerjaan->nama }}</td>
										@if ($penyerahan->status_penyerahan == 1)
											<td style="color:#0984E3;"> Diserahkan  </td>
										@elseif($penyerahan->status_penyerahan === '0')
											@if ($penyerahan->status_konfirmasi == 1)
												<td style="color:#0984E3;"> Lengkap, Sesuai </td>
											@elseif($penyerahan->status_konfirmasi == -1)
												<td style="color:#FF9800;"> Diterima Dengan Catatan </td>
											@endif										
										@else
											<td style="color:#1AAD19;"> Belum Diserahkan </td>
										@endif			
										<td style="text-align:center;">
											<span style="margin-right:10px;"><a href="{{url('Logistik/admin/penyerahan/detail/'.$penyerahan->id.'')}}" class="btn btn-default btn-xs" title="Penyerahan" style="background-color :{{$penyerahan->notifColor}}; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;"><i class="fa fa-th-list" style="font-size:15px;"></i></a> <sup style="{{$penyerahan->notifStyle}}"> <i class="{{$penyerahan->notifIcon}}" style='font-size:12px;'> </i> </sup>   </span>
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
		<div id="NoteModal" class="modal fade text-danger" role="dialog">
			<div class="modal-dialog ">
				<!-- Modal content-->
				<form method="post" >
					<div class="modal-content">
						<div class="modal-header bg-danger">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-center">Note</h4>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							Note : <p id="note"></p>
						</div>
						<div class="modal-footer">
							<center>
								<button type="button" class="btn btn-success" data-dismiss="modal">Tutup</button>
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
	  
	  function noteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/pengajuan/note") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_pengajuan').val(id);
         $.ajax({
	            url  : '{{ url("Logistik/admin/pengajuan/note") }}/'+id,
	            type : 'get',
	            success:function(response){
	            	console.log(response)
	                $('#note').html(response);
	            }
	        });
	 }

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
	    .order( [ 0, 'desc' ] )
	    .draw();

	var info, currrent_page;
	var url = '<?php echo url('/'); ?>';
	var session = '<?php echo \Session::get("page"); ?>';
	var proses = '<?php echo \Session::get("proses"); ?>';
	console.log(session);
	if(!session){
		session = 1;
	}
	if(proses == 1)
	{
		console.log(session);
		console.log(proses);
		table.page(session-1).draw( 'page' );
		$.get(url+"/Logistik/setSessionProses");
	}

	$('#datatable').on('draw.dt', function() {
	    info = table.page.info();
	    currrent_page = info.page+1;
	    $.get(url+"/Logistik/setPage/"+currrent_page);
	});
  </script>
 @endpush
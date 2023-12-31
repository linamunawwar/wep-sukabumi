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
		font-size: 13px;
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
						<h2>Order Diterima </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/admin/penerimaan/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> No </th>
									<th scope="col"> Kode Permintaan </th>
									<th scope="col"> Tanggal </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>	
                                    <?php $no = 0; ?>
                                    @foreach ($penerimaans as $penerimaan)
                                    <?php $no++; ?>
									<tr>
									<td>{{ $no }}</td>
									<td>{{ $penerimaan->kode_permintaan }}</td>
									<td>{{ date('d F Y', strtotime($penerimaan->tanggal)) }}</td>
									<td style="text-align:center;">
										@if (($penerimaan->status_penyerahan == 1) && (\Auth::user()->id == $penerimaan->user_id))
											<a class="btn btn-default btn-xs" title="Edit" style="background-color:#1AAD19; color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" href="{{url('Logistik/admin/pengajuan/konfirmasi/'.$penerimaan->id.'')}}">Konfirmasi Penyerahan </a>
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
				<form action="{{ url("Logistik/admin/penerimaan/delete") }}" id="deleteForm" method="post" >
					<div class="modal-content">
						<div class="modal-header bg-danger">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<p class="text-center">Anda yakin ingin menghapus data ini ?</p>
							<input type="hidden" name="id_penerimaan" id="id_penerimaan">
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
  	$('#modal-note').on("click",function(){
  		var id_penerimaan = $(this).attr('id_penerimaan');
         $('#id_penerimaan').val(id_penerimaan);
     
  	});
     function noteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/penerimaan/note") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_penerimaan').val(id);
         $.ajax({
	            url  : '{{ url("Logistik/admin/penerimaan/note") }}/'+id,
	            type : 'get',
	            success:function(response){
	            	console.log(response)
	                $('#note').html(response);
	            }
	        });
     }

  	$('#modal-delete').on("click",function(){
  		var id_penerimaan = $(this).attr('id_penerimaan');
         $('#id_penerimaan').val(id_penerimaan);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/penerimaan/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_penerimaan').val(id);
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
@extends('logistik.layouts.blank')

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
						<h2>Lokasi Pekerjaan </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/admin/lokasi/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> Nama Lokasi </th>
									<th scope="col"> Keterangan Lokasi </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>								
								@foreach ($locations as $location)
									<tr>
									<td>{{ $location->nama }}</td>
									<td>{{ $location->keterangan }}</td>
									<td style="text-align:center;">
										<a class="btn btn-default btn-xs" href="{{url('Logistik/admin/lokasi/edit/'.$location->id.'')}}"><i class="fa fa-edit"></i>  Edit</a>
										<button data-toggle="modal"  id_location='{{$location->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$location->id}}")'><i class="fa fa-trash"></i> Delete</button>
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
			<form action="{{ url("Logistik/admin/lokasi/delete") }}" id="deleteForm" method="post" >
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
					</div>
					<div class="modal-body">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<p class="text-center">Anda yakin ingin menghapus data ini ?</p>
						<input type="hidden" name="id_location" id="id_location">
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
  		var id_location = $(this).attr('id_location');
         $('#id_location').val(id_location);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/lokasi/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_location').val(id);
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
@extends('logistik.layouts.blank')

@push('stylesheets')
    <style>
		.alert-danger {
		  padding: 20px;
		  background-color: #f44336;
		  color: white;
		}

		.alert-success {
		  padding: 20px;
		  background-color: #4CAF50;
		  color: white;
		}

		.closebtn {
		  margin-left: 15px;
		  color: white;
		  font-weight: bold;
		  float: right;
		  font-size: 22px;
		  line-height: 20px;
		  cursor: pointer;
		  transition: 0.3s;
		}

		.closebtn:hover {
		  color: black;
		}
	</style>
@endpush

@section('main_container')
    <!-- page content -->
    <div class="right_col" role="main">
    	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Waste Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/admin/waste/create')}}"><button class="btn btn-success"> Tambah Data</button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="alert" style="display: none;">
					  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					  <div class="isi">
					  	<strong>Danger!</strong> Indicates a dangerous or potentially negative action.
					  </div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th scope="col"> Nama Material </th>
									<th scope="col"> Jenis Pekerjaan </th>
									<th scope="col"> Periode </th>
									<th scope="col"> Action </th>
								</tr>
							</thead>
							<tbody>								
								@foreach ($wastes as $waste)
									<tr>
									<td>{{ $waste->wasteMaterial->nama }}</td>
									<td>{{ $waste->wasteJenisKerja->nama }}</td>
									<td>{{ periode($waste->periode)}}</td>
									<td style="text-align:center;">
										<!-- <a class="btn btn-default btn-xs" href="{{url('logistik/admin/waste/edit/'.$waste->id.'')}}"><i class="fa fa-edit"></i>  Edit</a> -->
										<button class="btn btn-success btn-xs" id_waste='{{$waste->id}}' id="ajukan"><i class="fa fa-arrow-up"></i>  Ajukan</button>
										<button data-toggle="modal"  id_waste='{{$waste->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$waste->id}}")'><i class="fa fa-trash"></i> Delete</button><br>
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
     <form action="{{ url("Logistik/admin/waste/delete") }}" id="deleteForm" method="post" >
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Anda yakin ingin menghapus data ini ?</p>
                 <input type="hidden" name="id_waste" id="id_waste">
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
  		var id_waste = $(this).attr('id_waste');
         $('#id_waste').val(id_waste);
     
  	});
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("Logistik/admin/waste/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_waste').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }

     $(document).on("click", "button#ajukan", function(e){
     	var id_waste = $(this).attr('id_waste');
     	$.ajax({
            type: 'get',
            url : '{{ url('Logistik/admin/waste/ajukan') }}/'+id_waste,
            success: function(response){
            	console.log(response)
            	if(response == 1){
            		$('div.alert').addClass('alert-success');
            		$('div.alert').removeClass('alert-danger');
            		$('.alert').show();
            		$('.isi').html('<strong>Berhasil!</strong> Data Waste Material Berhasil Diajukan');
            	}else{
            		$('div.alert').addClass('alert-danger');
            		$('div.alert').removeClass('alert-success');
            		$('.alert').show();
            		$('.isi').html('<strong>Warning!</strong> Data Sudah Pernah Diajukan!');
            	}
            }
        });
     });

  </script>
 @endpush
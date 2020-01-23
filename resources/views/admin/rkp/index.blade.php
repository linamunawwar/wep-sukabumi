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
						<h2>Rencana Kebutuhan Pegawai </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Bagian</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($rkps as $rkp)
									<tr>
										<td>{{$rkp->kodeBagian->description}}</td>
										<?php
											$tanggal = explode(' ', $rkp->created_at);
										?>
										<td>{{konversi_tanggal($tanggal[0])}}</td>
										@if($rkp->is_verif_pm == 0)
											<td><span class="label label-default">Not Approved</span></td>
											<td style="text-align: left;">
												<!--<button data-toggle="modal"  data='{{$rkp->id}}' data-target="#DetailModal" class="btn btn-xs btn-primary" id="modal-detail"><i class="fa fa-search"></i> Detail</button>-->
												<button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
                        <button data-toggle="modal"  id_rkp='{{$rkp->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$rkp->id}}")'><i class="fa fa-trash"></i> Delete</button>
											</td>
										@elseif($rkp->is_verif_pm == 1)
											<td><span class="label label-primary">Approved by pm</span></td>
											<td style="text-align: left;">
                        <a href="{{url('admin/rkp/form1/'.$rkp->id.'')}}" class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form 1</a>
                        <a href="{{url('admin/rkp/form2/'.$rkp->id.'')}}" class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Form 2</a>
                        <button data-toggle="modal"  id_rkp='{{$rkp->id}}' data-target="#DeleteModal" class="btn btn-xs btn-danger" id="modal-delete" onclick='deleteData("{{$rkp->id}}")'><i class="fa fa-trash"></i> Delete</button>           
                      </td>
										@endif
										
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
     <form action="{{ url("admin/rkp/delete") }}" id="deleteForm" method="post" >
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Anda yakin ingin menghapus data ini ?</p>
                 <input type="hidden" name="id_rkp" id="id_rkp">
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
    <!-- Modal Tambah Rute berangkat-->
<button class="btn btn-sm btn-default detail_transaksi" data-toggle="modal" data-target="#modaldetail" style="display:none"></button>
<div class="modal fade" id="modaldetail" active='0' role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" class="form-brkt">
            <div class="modal-body">
                <table style="width: 100%;">
                    <tr>
                        <td><h4 id="site"></h4></td>
                    </tr>
                    <tr>
                        <td id="tanggal2"></td>
                    </tr>
                </table>
                <br>
                <div class="body-detail" style="overflow: scroll;">
                    <table class="table table-striped">
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btnt" data-dismiss="modal">Tutup</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('#modal-delete').on("click",function(){
      var id_rkp = $(this).attr('id_rkp');
         $('#id_rkp').val(id_rkp);
     
    });
     function deleteData(id)
     {
         var id = id;
         var url = '{{ url("admin/rkp/delete") }}';
         // url = url.replace(':id', id);
         console.log(id);
         $('#id_rkp').val(id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }

	$('#modal-detail').click(function(e){
        e.preventDefault();
        console.log('detail');
        var data_id= $(this).attr('data');
        var url = '<?php echo url('/');?>'
        $.get(url + '/admin/rkp/detail/' + data_id, function (data) {
            //success data
            console.log(data);
            var elemen = '';
            var no = 1;
            var tanggal,pj;
            var total = 0;
            var detail = data.detail;
            console.log(detail);
             elemen += '<tr>';
             elemen += '<th rowspan="3">NO</th>';
             elemen += '<th rowspan="3">Formasi Jabatan</th>';
             elemen += '<th colspan="5">Persayaratan</th>';
             elemen += '<th rowspan="3">Kekurangan</th>';
             elemen += '<th rowspan="">Waktu Penempatan</th>';
             elemen += '</tr>';
             elemen += '<tr>';
             elemen += '<th></th>';
             elemen += '<th></th>';
             elemen += '<th colspan="5">Persayaratan</th>';
             elemen += '<th rowspan="3">Kekurangan</th>';
             elemen += '<th rowspan="">Waktu Penempatan</th>';
             elemen += '</tr>';
            for (var i = 0; i < detail.length; i++) {
              elemen += '<tr>';
              elemen += '<td>'+no+'</td>';
              elemen += '<td>'+detail[i].jabatan+'</td>';
              elemen += '<td>'+detail[i].tugas+'</td>';
              elemen += '<td>'+detail[i].pendidikan+'</td>';
              elemen += '<td>'+detail[i].tahun_kerja+'</td>';
              elemen += '</tr>';
              no++;
            }
            console.log(elemen);
            $('#modaldetail').modal('show');
            $('.body-detail tbody').html(elemen);
            $('#site').html(data.site);	
            $('#tanggal2').html(data.tanggal);
        })
        
        
    });
</script>
@endpush
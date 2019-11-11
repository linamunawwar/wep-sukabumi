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
												<button data-toggle="modal"  data='{{$rkp->id}}' data-target="#DetailModal" class="btn btn-xs btn-primary" id="modal-detail"><i class="fa fa-search"></i> Detail</button>
												<button class="btn btn-dark btn-xs"><i class="fa fa-download"></i>  Unduh</button>
											</td>
										@elseif($rkp->is_verif_pm == 1)
											<td><span class="label label-primary">Approved by Admin</span></td>
											<td style="text-align: left;"><button class="btn btn-success btn-xs"><i class="fa fa-download"></i>  Unduh</button></td>
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
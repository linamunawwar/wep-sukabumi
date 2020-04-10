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
						<h2>Detail Pengajuan Material </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="{{url('Logistik/admin/penyerahan/')}}"><button class="btn btn-primary"> Kembali </button></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form action="{{ url('Logistik/admin/penyerahan/approve') }}" id="ApproveForm" method="post" >
							{{ csrf_field() }}
							<input type="hidden" name="id_penyerahan" id="id_penyerahan" value="{{$penyerahan->id}}">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th scope="col" rowspan="2"><b> No</b> </th>
										<th scope="col" rowspan="2" width="10"><b> Tanggal Pengajuan</b> </th>
										<th scope="col" rowspan="2" rowspan="13"><b> Element Activity</b> </th>
										<th scope="col" rowspan="2"><b> Material</b> </th>
										<th scope="col" colspan="2"><b> Permintaan</b> </th>
										<th scope="col" colspan="2"><b> Penyerahan</b> </th>
									</tr>
									<tr>
										<th scope="col"><b> Satuan </b></th>
										<th scope="col"><b> Jumlah </b></th>
										<th scope="col"><b> Satuan </b></th>
										<th scope="col"><b> Jumlah </b></th>
									</tr>
								</thead>
								<tbody>	
									<?php $no = 1; ?>
									@foreach ($details as $detail)
										<tr>
											<td scope="col"> {{ $no++ }} </td>
											<td scope="col"> {{ $detail->tanggal_pengajuan }} </td>
											<td scope="col"> {{ $detail->element_activity }} </td>
											<td scope="col"> {{ $detail->detailPengajuanMaterial->nama }} </td>
											<td scope="col"> {{ $detail->permintaan_satuan }} </td>
											<td scope="col"> {{ $detail->permintaan_jumlah }} </td>
											<td scope="col"> 
	                                                <input type='text' size="1" class='form-control penyerahanSatuan' id_data="{{$no}}" name="penyerahanSatuan[{{$detail->material_id}}]" value="{{ $detail->permintaan_satuan }}" id="penyerahanSatuan_{{$no}}">                                             
	                                            </td>
	                                            <td scope="col"> 
	                                                <input type='text' size="1" class='form-control pemyerahanJumlah' id_data="{{$no}}" name="pemyerahanJumlah[{{$detail->material_id}}]" value="{{ $detail->pemyerahan_jumlah }}" id="pemyerahanJumlah_{{$no}}">                                             
	                                            </td>
										</tr>
									@endforeach  					
								</tbody>
							</table>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6">Catatan :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									@if ($penyerahan->catatan_penyerahan != Null)
										<textarea name="catatan" class="form-control col-md-6 col-xs-6" cols="15" rows="8" placeholder="Tinggalkan Catatan"> {{ $penyerahan->catatan_penyerahan }} </textarea>
									@else
										<textarea name="catatan" class="form-control col-md-6 col-xs-6" cols="15" rows="8" placeholder="Tinggalkan Catatan"> Tidak Ada Catatan </textarea>
									@endif
								</div>
							
							<div class="ln_solid"></div>
							<div class="form-group" style="float:right; margin-right:4em;">
								<div class="col-md-12 col-sm-12 col-xs-12">
									@if ($penyerahan->status_penyerahan != 1)
										<button type="submit" title="Serahkan" id_penyerahan='{{$penyerahan->id}}'  class="btn btn-success" style="color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" id="modal-approve">Serahkan</button>
									@else
										<button type="submit" class="btn btn-success" style="color:#FFFFFF; padding:0.5em 0.7em 0.5em 0.7em;" disabled="disabled">Serahkan</button>
									@endif	
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- /page content -->
	<div id="ApproveModal" class="modal fade text-danger" role="dialog">
		<div class="modal-dialog ">
			<!-- Modal content-->
			<form action="{{ url("Logistik/admin/penyerahan/approve") }}" id="ApproveForm" method="post" >
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center">APPROVE CONFIRMATION</h4>
					</div>
					<div class="modal-body">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<p class="text-center">Anda Yakin Ingin Mengkonfirmasi Penyerahan Material?</p>
						<input type="hidden" name="id_penyerahan" id="id_penyerahan" value="{{$penyerahan->id}}">
					</div>
					<div class="modal-footer">
						<center>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" name="" class="btn btn-success"  >Ya, Konfirmasi</button>
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection


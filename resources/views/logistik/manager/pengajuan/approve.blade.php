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
						<h2>Approve Pengajuan Material </h2>
						<div class="clearfix"></div>
                    </div>
                    
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"method="POST">
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
							<div class="form-group">
                                <label style="display: inline-block;" for="nama">Kode Penerimaan : {{ $pengajuan->kode_penerimaan }}</label>
                                <input type="hidden" name="kodePermintaan" value="{{ $pengajuan->kode_penerimaan }}">
                            </div>							
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <label style="display: inline-block;" for="nama">Jenis Pekerjaan : {{ $pengajuan->pengajuanJenisPekerjaan->nama }} </label>
                                        <input type="hidden" name="jenisPekerjaan" value{{ $pengajuan->jenis_pekerjaan_id }}>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <div class="form-group">
                                        <label style="display: inline-block;" for="nama">Lokasi Pekerjaan : {{ $pengajuan->pengajuanLokasiPekerjaan->nama }} </label>
                                        <input type="hidden" name="lokasiPekerjaan" value{{ $pengajuan->lokasi_kerja_id }}>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <div class="form-group">
                                        <label style="display: inline-block;" for="nama">Volume : {{ $pengajuan->volume }} </label>
                                        <input type="hidden" name="volume" value{{ $pengajuan->volume }}>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <div class="form-group">
                                        <label style="display: inline-block;" for="nama">No. WBS : {{ $pengajuan->no_wbs }} </label>
                                        <input type="hidden" name="noWbs" value{{ $pengajuan->no_wbs }}>
                                    </div>
                                </div>
                            </div>
                            <br>
							<input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="0">
							<table class="table table-bordered permintaan" id="table_permintaan">
								<tr >
									<th rowspan="2">No.</th>
									<th rowspan="2">Element Activity</th>
                                    <th rowspan="2" style="text-align: center;">Nama Material</th>
									<th colspan="2" style="text-align: center;">Penerimaan Material</th>
									<th colspan="2" style="text-align: center;">Permintaan</th>
                                    <!-- <th>Penyerahan Satuan</th>
									<th>Penyerahan Jumlah</th> -->
								</tr>
                                <tr>
                                    <td style="text-align: center;">Satuan</td>
                                    <td style="text-align: center;">Jumlah</td>
                                    <td style="text-align: center;">Satuan</td>
                                    <td style="text-align: center;">Jumlah</td>
                                </tr>
								<tbody class="data">
                                    <?php $no = 1; $i = 0;?>
                                    @foreach ($details as $key=>$detail)
                                        <input type="hidden" name="detailId[]" value="{{ $detail->id }}">
										<tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $detail->element_activity }}</td>
                                            <td>{{ $detail->detailPengajuanMaterial->nama }}</td>
                                            <td>{{ $detail->detailPengajuan->pengajuanPenerimaanMaterial->detailPenerimaan[$key]->satuan}}  </td>
                                            <td>{{ $detail->detailPengajuan->pengajuanPenerimaanMaterial->detailPenerimaan[$key]->vol_jumlah}} </td>
                                            <td><input type="text" name="permintaanSatuan[]" class="form-control" placeholder="Permintaan Satuan" value="{{ $detail->permintaan_satuan }}" required></td>
                                            <td><input type="text" name="permintaanJumlah[]" class="form-control" placeholder="Permintaan Jumlah" value="{{ $detail->permintaan_jumlah }}" required></td>
                                           <!--  <td><input type="text" name="penyerahanSatuan[]" class="form-control" placeholder="Penyerahan Satuan" value="{{ $detail->penyerahan_satuan }}" required></td>
                                            <td><input type="text" name="penyerahanJumlah[]" class="form-control" placeholder="Penyerahan Jumlah" value="{{ $detail->pemyerahan_jumlah }}" required></td> -->
                                        </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                    <input type="hidden" name="jumlahData" value="{{ $i }}">
								</tbody>
							</table>
							<div class="ln_solid"></div>
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-6">Note :</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="note" class="form-control col-md-6 col-xs-6" cols="15" rows="8" required></textarea>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group" style="float:right; margin-right:4em;">
								<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/Logistik/manager/pengajuan')}}">Cancel</a>
									<button type="submit" name="reject" class="btn" style="background-color:#D63031; color:#FFFFFF;">Reject</button>
									<button type="submit" name="approve" class="btn btn-success">Approve</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection
@push('scripts')
  <script type="text/javascript">
  	
  </script>
@endpush
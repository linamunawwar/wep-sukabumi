@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush
<style>
	#table_waste thead tr th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 15px;
		font-weight: 400;
	}

	#table_waste tbody tr td {
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
							<li><a href="{{url('Logistik/user/pengajuan/')}}"><button class="btn btn-success"> Kembali </button></a></li>
						</ul>
						<div class="clearfix"></div>
                    </div>
                    <br>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label style="display: inline-block;" for="nama">Kode Penerimaan :</label>
                            <p style="display: inline-block;">{{ $pengajuan->kode_penerimaan }}</p>
                            <input type="hidden" name="kodePenerimaan" value="{{ $pengajuan->kode_penerimaan }}">
                        </div>							
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label style="display: inline-block;" for="nama">Jenis Pekerjaan </label>
                                    <p style="display: inline-block;" id="jenisPekerjaan">
                                        <select class="form-control jenisPekerjaan" name="jenisPekerjaan" id="jenisPekerjaan" style="width: 100%; !important" required='required'>
                                            <option value="{{$pengajuan->jenis_pekerjaan_id}}">{{$pengajuan->pengajuanJenisPekerjaan->nama}}</option>
                                            <option value="">-----------------------------</option>
                                            <option value="">Pilih jenisPekerjaan</option>
                                            @foreach($jenisPekerjaans as $jenisPekerjaan)
                                                <option value="{{$jenisPekerjaan->id}}">{{$jenisPekerjaan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label style="display: inline-block;" for="nama">Lokasi Pekerjaan </label>
                                    <p style="display: inline-block;" id="lokasiPekerjaan">
                                        <select class="form-control lokasiPekerjaan" name="lokasiPekerjaan" id="lokasiPekerjaan" style="width: 100%; !important" required='required'>
                                            <option value="{{$pengajuan->lokasi_kerja_id}}">{{$pengajuan->pengajuanLokasiPekerjaan->nama}}</option>
                                            <option value="">------------------------------------------------</option>
                                            <option value="">Pilih lokasiPekerjaan</option>
                                            @foreach($lokasiPekerjaans as $lokasiPekerjaan)
                                                <option value="{{$lokasiPekerjaan->id}}">{{$lokasiPekerjaan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label style="display: inline-block;" for="nama"> Volume. </label>
                                    <p style="display: inline-block;">
                                        <input type="text" name="volume" class='form-control volume' value="{{ $pengajuan->volume }}" required='required'>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label style="display: inline-block;" for="nama">No. WBS </label>
                                    <p style="display: inline-block;">
                                        <input type="text" name="no_wbs" class='form-control no_wbs' value="{{ $pengajuan->no_wbs }}" >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="x_content">
                            <input type="hidden" name="jumlah_data" class="jumlah_data" id="jumlah_data" value="{{count($details)}}" required='required'>
                            <table id="table_waste" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" rowspan="2"><b> No</b> </th>
                                        <th scope="col" rowspan="2"><b> Tanggal Pengajuan</b> </th>
                                        <th scope="col" rowspan="2"><b> Element Activity</b> </th>
                                        <th scope="col" rowspan="2"><b> Material</b> </th>
                                        <th scope="col" colspan="2"><b> Permintaan</b> </th>
                                    </tr>
                                    <tr>
                                        <th scope="col"><b> Satuan </b></th>
                                        <th scope="col"><b> Jumlah </b></th>
                                    </tr>
                                </thead>
                                <tbody>	
                                    <?php $no = 1; $i = 0;?>
                                    @foreach ($details as $detail)
                                        <input type="hidden" name="detailPengajuanId[]" value="{{ $detail->id }}">
                                        <tr>
                                            <td scope="col"> {{ $no++ }} </td>
                                            <td scope="col"> 
                                                <div class='input-group date' class='datepicker'>
                                                    <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                                                    <input type='date' id_data="{{$no}}" name='tanggalPengajuan[]' class='form-control tanggalPengajuan' required='required' value="{{$detail->tanggal_pengajuan}}" placeholder='dd-mm-yyyy' id="tanggalPengajuan_{{$no}}"/>
                                                </div>
                                            </td>
                                            <td scope="col"> 
                                                <input type='text' size="1" class='form-control elementActivity' id_data="{{$no}}" name='elementActivity[]' required='required' value="{{$detail->element_activity}}" id="elementActivity_{{$no}}">
                                            </td>
                                            <td scope="col"> 
                                                {{ $detail->detailPengajuanMaterial->nama }}
                                                <input type='hidden' size="1" class='form-control material' id_data="{{$no}}" name='material[]' required='required' value="{{ $detail->material_id }}" id="material_{{$no}}">                             
                                            </td>
                                            <td scope="col"> 
                                                <input type='text' size="1" class='form-control permintaanSatuan' id_data="{{$no}}" name='permintaanSatuan[]' required='required' value="{{ $detail->permintaan_satuan }}" id="permintaanSatuan_{{$no}}">                                             
                                            </td>
                                            <td scope="col"> 
                                                <input type='text' size="1" class='form-control permintaan_jumlah' id_data="{{$no}}" name='permintaan_jumlah[]' required='required' value="{{ $detail->permintaan_jumlah }}" id="permintaan_jumlah_{{$no}}">                                             
                                            </td>
                                        </tr>
                                    <?php $i++; ?>
                                    @endforeach  					
                                </tbody>
                            </table>
                            <div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<a class="btn btn-primary" href="{{url('/Logistik/user/pengajuan')}}">Cancel</a>
									@if(
										(($pengajuan->is_admin == 0) || ($pengajuan->is_admin == 1)) ||
										(($pengajuan->is_som == 0) || ($pengajuan->is_som == 1)) ||
										(($pengajuan->is_splem == 0) || ($pengajuan->is_splem == 1))
										)
										<button type="submit" name="koreksi" class="btn btn-success">Koreksi</button>
									@else
										<button type="submit" class="btn btn-success">Submit</button>
									@endif
								</div>
							</div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection
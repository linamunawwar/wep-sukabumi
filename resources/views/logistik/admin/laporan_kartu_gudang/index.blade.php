@extends('logistik.layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

<style>
	#kartuGudang th {
		text-align: center;
		vertical-align: middle;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 14px;
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
						<h2>Laporan Kartu Gudang </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div id="SearchForm">
							<div class="row">
								<div class="col-md-12"  style="padding: 0; margin: 0;">
                                    <div class="form-group">
										<label style="line-height:40px;" class="control-label col-md-1 col-sm-1 col-xs-1" for="nama">Material <span class="required">*</span>:</label>
										<div class="col-md-3 col-sm-3 col-xs-3">
		                                    <select class="form-control bulan" name="bulan" required="required" id="bulan">
                                                <option value="">Pilih Material </option>
                                                @foreach ($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->nama }}</option>
                                                @endforeach                                                
                                            </select>                                            
                                        </div>
									</div>
									<div class="form-group" style="margin-top:-3em;">
										<label style="line-height:35px;" class="control-label col-md-2 col-sm-2 col-xs-2" for="nama">Bulan / Tahun <span class="required">*</span>:</label>
										<div class="col-md-2 col-sm-2 col-xs-2">
		                                    <select class="form-control bulan" name="bulan" required="required" id="bulan">
                                                <option value="">Pilih Bulan </option>
                                                @for ($bulan = 1; $bulan <= 12; $bulan++)
                                                    <option value="{{ $bulan }}">{{ $bln[$bulan] }}</option>
                                                @endfor                                                
                                            </select>                                            
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
		                                    <select class="form-control tahun" name="tahun" required="required" id="tahun">
                                                <option value="">Pilih Tahun</option>
                                                @for ($tahun = 2017; $tahun <= Date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endfor                                                
                                            </select>                                            
                                        </div>                                        
										<div class="col-md-1">
											<button class="btn btn-primary pull-right" id="search">Search</button>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        
                        <div id="FirstDataForm" class="" style="padding: 0; margin-top: 5em;">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered" id="kartuGudang">
                                        <thead>
                                            <tr>
                                                <th colspan="3"> <b> Penerimaan </b> </th>
                                                <th colspan="2"> <b> Pengeluaran </b> </th>
                                                <th rowspan="2"> <b> Sisa </b> </th>
                                                <th rowspan="2"> <b> Keterangan </b> </th>
                                            </tr>
                                            <tr>
                                                <th> <b> Tanggal </b> </th>
                                                <th> <b> Jumlah </b> </th>
                                                <th> <b> Jumlah Terusan </b> </th>
                                                <th> <b> Jumlah </b> </th>
                                                <th> <b> Jumlah Terusan </b> </th>
                                            </tr>    
                                        </thead>                                   
                                        <tbody class="data">
                                            @foreach ($kartuGudangs as $kartuGudang)
                                                <tr>
                                                    <td>{{ $kartuGudang->tanggal }}</td>
                                                    <td>{{ $kartuGudang->volume }}</td>
                                                    <td></td>
                                                    <td>{{ $kartuGudang->pemyerahan_jumlah }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
								</div>
							</div>
                        </div>						
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /page content -->
@endsection

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
						<h2>List Disposisi </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Pengirim</th>
									<th>Kepada</th>
									<th>Kategori</th>
									<th>Tanggal Terima</th>
									<th>Sifat</th>
									<th>Perihal</th>
									<th>Tugas</th>
									<th >Action</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($disposisis as $disposisi)
									<tr>
										<td>{{$disposisi->no_surat}}</td>
										<td>{{$disposisi->pengirim}}</td>
										<td>{{$disposisi->kepada}}</td>
										<td>{{$disposisi->kategori}}</td>
										<td>{{konversi_tanggal($disposisi->tanggal_terima)}}</td>
										<td>{{$disposisi->sifat}}</td>
										<td>{{$disposisi->perihal}}</td>
										<td>{{$disposisi->tugas}}</td>
										<td style="text-align: center;">
											@if($disposisi->status != 1)
												<a class="btn btn-warning btn-xs" href="{{url('manager/disposisi/proses/'.$disposisi->id.'')}}"><i class="fa fa-refresh"></i>  Proses</a>
												<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/monitor/'.$disposisi->id.'')}}"><i class="fa fa-eye"></i>  Monitor</a>
												<a class="btn btn-success btn-xs" href="{{url('manager/disposisi/unduh/'.$disposisi->id.'')}}"><i class="fa fa-download"></i>  Unduh</a>
											@else
												<a class="btn btn-dark btn-xs"><i class="fa fa-refresh"></i>  Proses</a>
												<a class="btn btn-primary btn-xs" href="{{url('manager/disposisi/monitoring/'.$disposisi->id.'')}}"><i class="fa fa-eye"></i>  Monitor</a>
												<a class="btn btn-success btn-xs" href="{{url('manager/disposisi/unduh/'.$disposisi->id.'')}}"><i class="fa fa-download"></i>  Unduh</a>
											@endif
											<?php $disposisi->no_surat = str_replace('/', '_', $disposisi->no_surat); ?>
											<a class="btn btn-success btn-xs" href="{{url('admin/surat_masuk/unduh/'.$disposisi->no_surat.'')}}"><i class="fa fa-download"></i>  Surat</a>
										</td>
										<td>
											@if($disposisi->status_akhir == 1)
												<span class="label label-success">DONE</span>
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
@endsection 
@push('scripts')
<script type="text/javascript">
	$.fn.dataTable.Api.register('row().show()', function () {
            var page_info = this.table().page.info();
            // Get row index
            var new_row_index = this.index();
            // Row position
            var row_position = this.table().rows()[0].indexOf(new_row_index);
            // Already on right page ?
            if (row_position >= page_info.start && row_position < page_info.end) {
                // Return row object
                return this;
            }
            // Find page number
            var page_to_display = Math.floor(row_position / this.table().page.len());
            // Go to that page
            this.table().page(page_to_display);
            // Return row object
            return this;
        });
	$(document).ready(function () {
            var urlParams = getUrlVars();
 
            //mapping  creates a row id to be used in the datatable
            $.map(sampleData.data, function (item) { item.DT_RowId = "row_"+item.id; return item});
         
            $('#datatable').DataTable({
                "data": sampleData.data,
                "columns": [
                { "data": "name", "title": "Name" },
                { "data": "position", "title": "Position" },
                { "data": "office", "title": "Office" },
                { "data": "extn", "title": "Phone" },
                { "data": "start_date", "title": "Start Date" },
                { "data": "salary", "title": "Salary" },
                {
                    "data": null, "title": "url", render: function (data) {
                        return "<a href='datatablelink.html?rowid=" + data.id + "'>" + data.id + "</a>";
                    }
                }
                ],
                initComplete: function (settings) {
                    if (urlParams.rowid) {
                        var api = new $.fn.dataTable.Api(settings);
                        var row = api.row("#row_" + urlParams.rowid).show().draw(false);
                    }
                }
            });
        });
 
        //  turns url parameters into an object
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
                vars[key] = value;
            });
            return vars;
        }
</script>
@endpush	
<table id="datatable" class="table table-striped table-bordered">
	<tr>
		<td></td>
		<td></td>
		<td colspan="3"><h3>Persero</h3></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td colspan="3"><h3>PT. Waskita Karya</h3></td>
	</tr>
	<tr></tr>
	<tr>
		<td colspan="11" align="center"><h3>MONITORING PELATIHAN YANG SUDAH DILAKUKAN</h3></td>
	</tr>
	<tr>
		<td colspan="11" align="center"><h3>TAHUN {{$nama_sheet}}</h3></td>
	</tr>
	<tr>
		<td></td>
		<td width="5" align="center">√</td>
		<td>UNIT BISNIS</td>
		<td>:</td>
		<td>Divisi III</td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td align="center">√</td>
		<td>PROYEK</td>
		<td>:</td>
		<td colspan="3">Proyek Pembangunan Jalan Tol Becakayu Seksi 2A Ujung</td>
	</tr>
	<tr></tr>
	<tdead>
		<tr>
			<td rowspan="2" width="6" align="center"><b>No.</b></td>
			<td rowspan="2" colspan="2" align="center"><b>Nama Pegawai</td>
			<td rowspan="2" colspan="2" align="center"><b>Jabatan</td>
			<td rowspan="2" width="40" align="center"><b>Nama Pelatihan</td>
			<td colspan="2" align="center"><b>Waktu Pelaksanaan</td>
			<td rowspan="2" width="30" align="center"><b>Tempat Pelaksanaan</td>
			<td rowspan="2" width="30" align="center"><b>Penyelenggara</td>
			<td rowspan="2" width="30" align="center"><b>NO IM</td>
		</tr>
		<tr>
			<td></td>			
			<td colspan="2"></td>
			<td colspan="2"></td>
			<td></td>
			<td align="center">Tanggal Mulai Pelatihan</td>
			<td align="center">Tanggal Berakhirnya Pelatihan</td>
		</tr>
	</thead>
	<tbody>
		@if(count($data) != 0)
			<?php $i=1; ?>
			@foreach($data as $pelatihan)
				<tr>
					<td align="center" style="border: 1px solid #000000">{{$i}}</td>
					<td colspan="2" style="border: 1px solid #000000">{{$pelatihan->pegawai->nama}}</td>
					<td colspan="2" align="center" style="border: 1px solid #000000">{{$pelatihan->pegawai->posisi->posisi}}</td>
					<td align="center" style="border: 1px solid #000000">{{$pelatihan->nama_pelatihan}}</td>
					<td align="center" style="border: 1px solid #000000">{{formatTanggalPanjang($pelatihan->tanggal_mulai)}}</td>
					<td align="center" style="border: 1px solid #000000">{{formatTanggalPanjang($pelatihan->tanggal_selesai)}}</td>
					<td style="border: 1px solid #000000">{{$pelatihan->tempat}}</td>
					<td style="border: 1px solid #000000">{{$pelatihan->penyelenggara}}</td>
					<td align="center" style="border: 1px solid #000000">{{$pelatihan->no_im}}</td>
				</tr>
				<?php $i++; ?>
			@endforeach
		@endif
	</tbody>
</table>
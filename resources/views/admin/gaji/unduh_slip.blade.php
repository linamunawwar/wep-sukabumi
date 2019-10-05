<table>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td rowspan="3"></td>
		<td></td>
		<td><b>PT. Waskita Karya (Persero) Tbk</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td width="30"><b>DIVISI III</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="5"><b>Proyek Jalan Tol Becakayu Seksi 2A Ujung</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="8" align="center" style="border: 1px solid #000000;"> <b>SLIP GAJI</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Nama</td>
		<td colspan="2">: {{$slip->pegawai->nama}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Jabatan</td>
		<td colspan="2">: {{$slip->pegawai->posisi->posisi}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Bulan</td>
		<td colspan="2">: {{$periode}}</td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Pendapatan</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Gaji Pokok</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->gaji_pokok)}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Tunjangan Komunikasi</td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->tunj_komunikasi)}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Tunjangan Transportasi</td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->tunj_transportasi)}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Uang Makan</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->uang_makan)}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Lain - Lain</b></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Tunjangan Pajak</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">-</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Overtime</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">-</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Kesehatan</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">-</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Total Pendapatan</b></td>
		<td></td>
		<td></td>
		<td width="1"><b>:</b></td>
		<td width="4"><b>Rp.</b></td>
		<?php $pendapatan = $slip->pegawai->gaji->gaji_pokok + $slip->pegawai->gaji->tunj_komunikasi + $slip->pegawai->gaji->tunj_transportasi; ?>
		<td colspan="2" align="right"><b>{{number_format($pendapatan)}}</b></td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Potongan<b></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>PPh 21</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">-</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Astek</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">-</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Pinjaman Kantor</td>
		<td></td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		<td colspan="2" align="right">-</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Total Potongan</b></td>
		<td></td>
		<td></td>
		<td width="1"><b>:</b></td>
		<td width="4"><b>Rp.</b></td>
		<td colspan="2" align="right"><b>-</b></td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Pendapatan Bersih</b></td>
		<td></td>
		<td></td>
		<td width="1"><b>:</b></td>
		<td width="4"><b>Rp.</b></td>
		<td  colspan="2" align="right"><b>{{number_format($pendapatan)}}</b></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<?php 
			$time = explode(' ', $slip->verify_sdm_time);

		?>
		@if($slip->is_verif_sdm ==1)
			<td>Bekasi, {{formatTanggalPanjang($time[0])}}</td>
		@else
			<td>Bekasi, </td>
		@endif
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center">Menyetujui,</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>yang membuat,</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center">Sudiarso</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Deo Panggabean</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center">Site Administation Manager</td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center" colspan="3">Site Adminitration Officer</td>
	</tr>
</table>

<?php if($slip){
		if(($slip->pegawai->gaji->gaji_pokok == null) || ($slip->pegawai->gaji->gaji_pokok == '')){
			$slip->pegawai->gaji->gaji_pokok = 0;
		}
		if(($slip->pegawai->gaji->tunj_komunikasi == null) || ($slip->pegawai->gaji->tunj_komunikasi == '')){
			$slip->pegawai->gaji->tunj_komunikasi = 0;
		}
		if(($slip->pegawai->gaji->tunj_transportasi == null) || ($slip->pegawai->gaji->tunj_transportasi == '')){
			$slip->pegawai->gaji->tunj_transportasi = 0;
		}
		if(($slip->pegawai->gaji->uang_makan == null) || ($slip->pegawai->gaji->uang_makan == '')){
			$slip->pegawai->gaji->uang_makan = 0;
		}
		if(($slip->pegawai->gaji->uang_lembur == null) || ($slip->pegawai->gaji->uang_lembur == '')){
			$slip->pegawai->gaji->uang_lembur = 0;
		}
		if(($slip->pegawai->gaji->tunj_pph21 == null) || ($slip->pegawai->gaji->tunj_pph21 == '')){
			$slip->pegawai->gaji->tunj_pph21 = 0;
		}
	}
?>
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
		<td width="30"><b>DIVISI Infrastruktur 2</b></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="5"><b>Proyek Jalan Tol CIAWI SUKABUMI SEKSI 3</b></td>
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
		@if($slip->pegawai->gaji->gaji_pokok)
			<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->gaji_pokok)}}</td>
		@else
			<td colspan="2"></td>
		@endif
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
		@if($slip->pegawai->gaji->tunj_komunikasi)
			<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->tunj_komunikasi)}}</td>
		@else
			<td colspan="2"></td>
		@endif
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
		@if($slip->pegawai->gaji->tunj_transportasi)
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->tunj_transportasi)}}</td>
		@else
			<td colspan="2"></td>
		@endif
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Tunjangan PPh21</td>
		<td></td>
		<td width="1">:</td>
		<td width="4">Rp.</td>
		@if($slip->pegawai->gaji->tunj_pph21)
			<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->tunj_pph21)}}</td>
		@else
			<td colspan="2"></td>
		@endif
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
		@if($slip->pegawai->gaji->uang_makan)
			<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->uang_makan)}}</td>
		@else
			<td colspan="2"></td>
		@endif
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
		@if($slip->pegawai->gaji->uang_lembur)
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->uang_lembur)}}</td>
		@else
			<td colspan="2"></td>
		@endif
	</tr></td>
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
		<?php $pendapatan = $slip->pegawai->gaji->gaji_pokok + $slip->pegawai->gaji->tunj_komunikasi + $slip->pegawai->gaji->tunj_transportasi + $slip->pegawai->gaji->tunj_pph21 + $slip->pegawai->gaji->uang_makan  + $slip->pegawai->gaji->uang_lembur; ?>
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
		@if($slip->pegawai->gaji->pph21)
		<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->pph21)}}</td>
		@else
			<td colspan="2"></td>
		@endif
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
		@if($slip->pegawai->gaji->pph21)
			<td colspan="2" align="right">{{number_format($slip->pegawai->gaji->pph21)}}</td>
		@else
			<td colspan="2"></td>
		@endif
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
		<?php $tot_pendapatan = $pendapatan - $slip->pegawai->gaji->pph21;?>
		<td  colspan="2" align="right"><b>{{number_format($tot_pendapatan)}}</b></td>
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
		<td align="center" colspan="3">Site Adminitration Staff</td>
	</tr>
</table>

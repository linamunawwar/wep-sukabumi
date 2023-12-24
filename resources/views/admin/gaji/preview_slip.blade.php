<?php
if($slip){
		if(($slip->gaji_pokok == null) || ($slip->gaji_pokok == '')){
			$slip->gaji_pokok = 0;
		}
		if(($slip->tunj_komunikasi == null) || ($slip->tunj_komunikasi == '')){
			$slip->tunj_komunikasi = 0;
		}
		if(($slip->tunj_transportasi == null) || ($slip->tunj_transportasi == '')){
			$slip->tunj_transportasi = 0;
		}
		if(($slip->uang_makan == null) || ($slip->uang_makan == '')){
			$slip->uang_makan = 0;
		}
		if(($slip->uang_lembur == null) || ($slip->uang_lembur == '')){
			$slip->uang_lembur = 0;
		}
		if(($slip->tunj_pph21 == null) || ($slip->tunj_pph21 == '')){
			$slip->tunj_pph21 = 0;
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
		<td colspan="2">: </td>
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
		<td colspan="2" align="right">{{number_format($slip->gaji_pokok)}}</td>
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
		<td colspan="2" align="right">{{number_format($slip->tunj_komunikasi)}}</td>
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
		<td colspan="2" align="right">{{number_format($slip->tunj_transportasi)}}</td>
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
		<td colspan="2" align="right">{{number_format($slip->tunj_pph21)}}</td>
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
		<td colspan="2" align="right">{{number_format($slip->uang_makan)}}</td>
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
		<td colspan="2" align="right">{{number_format($slip->uang_lembur)}}</td>
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
		<?php $pendapatan = $slip->gaji_pokok + $slip->tunj_komunikasi + $slip->tunj_transportasi + $slip->tunj_pph21 + $slip->uang_makan + $slip->uang_lembur; ?>
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
		<td colspan="2" align="right">{{number_format($slip->pph21)}}</td>
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
		<td colspan="2" align="right"><b>{{number_format($slip->pph21)}}</b></td>
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
		<?php $tot_pendapatan = $pendapatan - $slip->pph21;?>
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
		<td>Bekasi, {{date('d-m-Y')}}</td>
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

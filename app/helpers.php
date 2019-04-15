<?php

function formatTanggalPanjang($tanggal) {
    $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    list($thn,$bln,$tgl)=explode("-",$tanggal);
    $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
    return $tgl." ".$aBulan[$bln]." ".$thn;
}

function konversi_tanggal($date){
    list($y, $m, $d) = explode('-', $date);
    return $d.'-'.$m.'-'.$y;
}

?>
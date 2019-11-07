<?php
use App\Pegawai;

function formatTanggalPanjang($tanggal) {
    $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    list($thn,$bln,$tgl)=explode("-",$tanggal);
    $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
    return $tgl." ".$aBulan[$bln]." ".$thn;
}

function konversi_tanggal($date){
    if(($date != '') && ($date != null)){
        list($y, $m, $d) = explode('-', $date);
        return $d.'-'.$m.'-'.$y;
    }
}

function bulan($month){
	Switch ($month){
         case '01' : $tanggal="Januari";
         Break;
         case '02' : $tanggal="Februari";
         Break;
         case '03' : $tanggal="Maret";
         Break;
         case '04' : $tanggal="April";
         Break;
         case '05' : $tanggal="Mei";
         Break;
         case '06' : $tanggal="Juni";
         Break;
         case '07' : $tanggal="Juli";
         Break;
         case '08' : $tanggal="Agustus";
         Break;
         case '09' : $tanggal="September";
         Break;
         case '10' : $tanggal="Oktober";
         Break;
         case '11' : $tanggal="November";
         Break;
         case '12' : $tanggal="Desember";
         Break;
    }  

    return $tanggal;   
}

function bulanRomawi($month){
    Switch ($month){
         case '01' : $tanggal="I";
         Break;
         case '02' : $tanggal="II";
         Break;
         case '03' : $tanggal="III";
         Break;
         case '04' : $tanggal="IV";
         Break;
         case '05' : $tanggal="V";
         Break;
         case '06' : $tanggal="VI";
         Break;
         case '07' : $tanggal="VII";
         Break;
         case '08' : $tanggal="VIII";
         Break;
         case '09' : $tanggal="IX";
         Break;
         case '10' : $tanggal="X";
         Break;
         case '11' : $tanggal="XI";
         Break;
         case '12' : $tanggal="XII";
         Break;
    }  

    return $tanggal;   
}

function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}

function getPM()
{
    $pm = Pegawai::where('posisi_id',1)->first();

    return $pm;
}

function getManager($kode)
{
    if($kode == 4){
        $manager = Pegawai::where('kode_bagian',$kode)->whereHas('user',function ($q){
                $q->where('role_id', 4);
            })->first();
    }else{
        $manager = Pegawai::where('kode_bagian',$kode)->whereHas('user',function ($q){
                    $q->where('role_id', 3);
                })->first();
    }

    return $manager;
}

function getManagerSDM($kode)
{
    $manager = Pegawai::where('kode_bagian',$kode)->whereHas('user',function ($q){
                $q->where('role_id', 4);
            })->first();

    return $manager;
}

function getPublicRelation()
{
    $hr = \Pegawai::where('posisi_id',24)->first();

    return $hr;
}

function setEnvironmentValue($envKey, $envValue)
{
    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);

    $oldValue = env("{$envKey}");

    $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
    $fp = fopen($envFile, 'w');
    fwrite($fp, $str);
    fclose($fp);
}

function tigadigit($value){
    $length = strlen($value);
    if($length == 1){
        return '00'.$value;
    }elseif($length == 2){
        return '0'.$value;
    }
}
?>
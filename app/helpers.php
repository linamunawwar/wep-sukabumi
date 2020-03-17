<?php
use App\Pegawai;
use App\Models\LogPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;

function notif_permintaan_penyerahan()
{
    $permintaan_diserahkan = LogPengajuanMaterial::where('soft_delete',0)
            ->where('is_splem',1)
            ->where('is_notif',1)
            ->where('soft_delete',0)
            ->get();
    return $permintaan_diserahkan;
}

function notif_order_diterima()
{
    $penerimaan = LogPermintaanMaterial::where('soft_delete',0)
            ->where('status_penyerahan',1)
            ->where('soft_delete',0)
            ->where('user_id',\Auth::user()->id)
            ->get();
    return $penerimaan;
}

function notif_permintaan_diproses()
{
    $permintaan_disetujui = LogPermintaanMaterial::where('soft_delete',0)
            ->where('is_notif',1)
            ->where('soft_delete',0)
            ->where('user_id',\Auth::user()->id)
            ->get();
    return $permintaan_disetujui;
}

function notif_permintaan_ditolak()
{
    $permintaan_ditolak = LogPermintaanMaterial::where('soft_delete',0)
            ->where('is_scarm',0)
            ->where('is_notif',1)
            ->where('soft_delete',0)
            ->where('user_id',\Auth::user()->id)
            ->get();
    return $permintaan_ditolak;
}

function notif_penerimaan_baru()
{
    $user_id = \Auth::user()->id;
    $baru = LogPenerimaanMaterial::where('soft_delete',0)
            ->where('is_new',1)
            ->whereHas('permintaan',function ($q) use($user_id){
              $q->where('user_id', $user_id);
            })
            ->get();
    return $baru;
}

function notifApprovePermintaanManager()
{
    $user = \Auth::user()->pegawai->posisi_id;
    if ($user == 7) {//splem
        $approveNotif = LogPermintaanMaterial::where('soft_delete', 0)
                    ->where('is_som', 1)
                    ->where('is_slem', NULL)
                    ->get();
    }elseif ($user == 8) {//som
        $approveNotif = LogPermintaanMaterial::where('soft_delete', 0)
                    ->where('is_som', NULL)
                    ->get();
    }elseif($user == 5) {//scarm
        $approveNotif = LogPermintaanMaterial::where('soft_delete', 0)
                    ->where('is_som', 1)
                    ->where('is_slem', 1)
                    ->where('is_scarm', NULL)
                    ->get();
    }elseif($user == 1){//pM
        $approveNotif = LogPermintaanMaterial::where('soft_delete', 0)
                    ->where('is_som', 1)
                    ->where('is_slem', 1)
                    ->where('is_scarm', 1)
                    ->where('is_pm', NULL)
                    ->get();
    }    

    return $approveNotif;
}

function notifApprovePenerimaanManager()
{
    $user = \Auth::user()->pegawai->posisi_id;
        $approveNotif = LogPenerimaanMaterial::where('soft_delete', 0)
                    ->where('is_splem', 0)
                    ->get();

    return $approveNotif;
}

function notifApprovePengajuanManager()
{
    $user = \Auth::user()->pegawai->posisi_id;
    $approveNotif = array();
    if ($user == 7) {
        $approveNotif = LogPengajuanMaterial::where('soft_delete', 0)
                    ->where('is_som', 1)
                    ->where('is_splem', 0)
                    ->get();
    }elseif ($user == 8) {
        $approveNotif = LogPengajuanMaterial::where('soft_delete', 0)
                    ->where('is_som', 0)
                    ->get();
    }
dd(count($approveNotif));
    return $approveNotif;
}

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

function periode($periode)
{
    $bulan = substr($periode, 4,6);
    $tahun = substr($periode, 0,4);
    switch ($bulan) {
        case '01':
            $periode = 'Januari '.$tahun;
            break;
        case '02':
            $periode = 'Februari '.$tahun;
            break;
        case '03':
            $periode = 'Maret '.$tahun;
            break;
        case '04':
            $periode = 'April '.$tahun;
            break;
        case '05':
            $periode = 'Mei '.$tahun;
            break;
        case '06':
            $periode = 'Juni '.$tahun;
            break;
        case '07':
            $periode = 'Juli '.$tahun;
            break;
        case '08':
            $periode = 'Agustus '.$tahun;
            break;
        case '09':
            $periode = 'September '.$tahun;
            break;
        case '10':
            $periode = 'Oktober '.$tahun;
            break;
        case '11':
            $periode = 'November '.$tahun;
            break;
        case '12':
            $periode = 'Desember '.$tahun;
            break;
        
        default:
            # code...
            break;
    }

    return $periode;
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
    if($kode == 'SA'){
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
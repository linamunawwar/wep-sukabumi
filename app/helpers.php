<?php
use App\Pegawai;
use App\Cuti;
use App\Models\LogPermintaanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;

function notif_permintaan_penyerahan()//notifikasi admin untuk menyerahkan barang
{
    $permintaan_diserahkan = LogPengajuanMaterial::where('soft_delete',0)
            ->where('is_splem',1)
            ->where('is_notif',1)
            ->where('soft_delete',0)
            ->get();
    return $permintaan_diserahkan;
}

//notif untuk yg mengajukan pemakaian untuk melakukan konfirmasi barang yg diserahkan sudah lengkap/belum
function notif_konfirmasi_penerimaan()
{
    $penerimaan = LogPengajuanMaterial::where('soft_delete',0)
            ->where('status_penyerahan', 1)
            ->where('user_id',\Auth::user()->id)
            ->get();
    return $penerimaan;
}

//notifikasi permintaan diproses = notifikasi jika ada permintaan yg disetujui/ direject 
function notif_permintaan_diproses()
{
    $permintaan_disetujui = LogPermintaanMaterial::where('soft_delete',0)
            ->where('is_notif',1)
            ->where('soft_delete',0)
            ->where('user_id',\Auth::user()->id)
            ->get();
    return $permintaan_disetujui;
}

//notifkasi kalau dari permintaan yg disubmit, ada penerimaan baru 
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
    $approveNotif = array();
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
    $approveNotif = array();
    if ($user == 7) {//splem
        $approveNotif = LogPenerimaanMaterial::where('soft_delete', 0)
                        ->where('is_splem', null)
                        ->get();
    }

    return $approveNotif;
}

function notifApprovePengajuanManager()
{
    $user = \Auth::user()->pegawai->posisi_id;
    $approveNotif = array();
    if ($user == 7) {
        $approveNotif = LogPengajuanMaterial::where('soft_delete', 0)
                    ->where('is_som', 1)
                    ->where('is_splem', null)
                    ->get();
    }elseif ($user == 8) {
        $approveNotif = LogPengajuanMaterial::where('soft_delete', 0)
                    ->where('is_som', null)
                    ->get();
    }

    return $approveNotif;
}

function pengganti_cuti()
{
    $cuti = Cuti::where('pengganti',Auth::user()->pegawai_id)->where('is_verif_pengganti','!=',1)->get();
          
    return count($cuti);
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

function periodeTanggal($tanggal)
{
    $tgl = explode('-', $tanggal);
    $bulan = $tgl[1];
    $tahun = $tgl[0];
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

function periode($periode)
{
    $bulan = substr($periode, 4,6);
    dd($bulan);
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

function getPM($model,$data_id)
{
    $model = 'App\\'.$model;
    $data = $model::where('id',$data_id)->first();
    $created_at = explode(' ', $data->created_at);

    $pms = Pegawai::where('posisi_id',1)
                    ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($pms as $key => $value) {
            if($value->tanggal_keluar > $created_at[0]){
                $nip_pm = $value->nip;
                break;
            }else{
                $nip_pm = $value->nip;
            }
        }
       
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_pm)){
            $pm = Pegawai::where('nip',$nip_pm)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $pm = Pegawai::where('posisi_id',1)
                            ->where('tanggal_keluar',null)
                            ->first();
        }
    return $pm;
}

function getManager($kode,$model,$data_id)
{
    $model = 'App\\'.$model;
    $data = $model::where('id',$data_id)->first();
    $created_at = explode(' ', $data->created_at);

    if($kode == 'SA'){
        $managers = Pegawai::where('kode_bagian',$kode)
                            ->where('posisi_id',6)
                            ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($managers as $key => $value) {
            if($value->tanggal_keluar > $created_at[0]){
                $nip_manager = $value->nip;
                break;
            }else{
                $nip_manager = $value->nip;
            }
        }
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_manager)){
            $manager = Pegawai::where('nip',$nip_manager)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $manager = Pegawai::where('kode_bagian',$kode)
                            ->where('posisi_id',6)
                            ->where('tanggal_keluar',null)
                            ->first();
        }
    }else{

        $managers = Pegawai::where('kode_bagian',$kode)
                            ->where('role_id', 3)
                            ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($managers as $key => $value) {
            if($value->tanggal_keluar > $created_at[0]){
                $nip_manager = $value->nip;
                break;
            }else{
                $nip_manager = $value->nip;
            }
        }
        
        
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_manager)){
            $manager = Pegawai::where('nip',$nip_manager)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $manager = Pegawai::where('kode_bagian',$kode)
                            ->where('posisi_id',3)
                            ->where('tanggal_keluar',null)
                            ->first();
        }
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

function getPublicRelation($model,$data_id)
{
    $model = 'App\\'.$model;
    $data = $model::where('id',$data_id)->first();
    $created_at = explode(' ', $data->created_at);

    $hrs = Pegawai::where('posisi_id',24)
                    ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($hrs as $key => $value) {
            if($value->tanggal_keluar > $created_at[0]){
                $nip_hr = $value->nip;
                break;
            }else{
                $nip_hr = $value->nip;
            }
        }
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_hr)){
            $hr = Pegawai::where('nip',$nip_hr)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $hr = Pegawai::where('posisi_id',24)
                            ->where('tanggal_keluar',null)
                            ->first();
        }

    return $hr;
}

function getPMLaporan($tanggal)
{
    $pms = Pegawai::where('posisi_id',1)
                    ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($pms as $key => $value) {
            if($value->tanggal_keluar > $tanggal){
                $nip_pm = $value->nip;
                break;
            }else{
                $nip_pm = $value->nip;
            }
        }
       
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_pm)){
            $pm = Pegawai::where('nip',$nip_pm)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $pm = Pegawai::where('posisi_id',1)
                            ->where('tanggal_keluar',null)
                            ->first();
        }
    return $pm;
}

function getManagerLaporan($kode,$tanggal)
{
    

    if($kode == 'SA'){
        $managers = Pegawai::where('kode_bagian',$kode)
                            ->where('posisi_id',6)
                            ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($managers as $key => $value) {
            if($value->tanggal_keluar > $tanggal){
                $nip_manager = $value->nip;
                break;
            }else{
                $nip_manager = $value->nip;
            }
        }
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_manager)){
            $manager = Pegawai::where('nip',$nip_manager)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $manager = Pegawai::where('kode_bagian',$kode)
                            ->where('posisi_id',6)
                            ->where('tanggal_keluar',null)
                            ->first();
        }
    }else{

        $managers = Pegawai::where('kode_bagian',$kode)
                            ->where('role_id', 3)
                            ->get();

        //cek apakah data dibuat ketika manager bukan yg sekarang
        foreach ($managers as $key => $value) {
            if($value->tanggal_keluar > $tanggal){
                $nip_manager = $value->nip;
                break;
            }else{
                $nip_manager = $value->nip;
            }
        }
        
        
        //iya, manager yg approve bukan manager yg skrg
        if(isset($nip_manager)){
            $manager = Pegawai::where('nip',$nip_manager)->first();
        }else{
            //tidak, manager yg approve adalah manager yg skrg
            $manager = Pegawai::where('kode_bagian',$kode)
                            ->where('posisi_id',3)
                            ->where('tanggal_keluar',null)
                            ->first();
        }
    }

    return $manager;
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
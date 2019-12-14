<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogJenis extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_mst_jenis_pekerjaan";
    public $timestamps = true;

    public function jenisWaste()
    {
        return $this->hasOne('App\Models\LogWaste','id','jenis_pekerjaan_id');
    }
    public function jenisPengajuan()
    {
        return $this->hasOne('App\Models\LogPengajuanMaterial','id','jenis_pekerjaan_id');
    }
}

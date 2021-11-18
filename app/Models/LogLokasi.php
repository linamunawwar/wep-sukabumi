<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogLokasi extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_mst_lokasi";
    public $timestamps = true;

    public function lokasiWaste()
    {
        return $this->hasMany('App\Models\LogWaste','id','lokasi_id');
    }

    public function lokasiPengajuan()
    {
        return $this->hasMany('App\Models\Log PengajuanMaterial','id','lokasi_kerja_id');
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetailPengajuanPakai extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_pengajuan_detail';
    public $timestamps = true;

    public function pengajuan()
    {
        return $this->hasOne('App\Models\LogPengajuanPakai', 'id', 'pengajuan_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Models\LogMaterial', 'material_id', 'id');
    }
}

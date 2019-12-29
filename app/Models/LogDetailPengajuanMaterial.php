<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetailPengajuanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_pengajuan_detail';
    public $timestamps = true;

    public function detailPengajuan()
    {
        return $this->hasOne('App\Models\LogPengajuanMaterial', 'id', 'pengajuan_id');
    }

    public function detailPengajuanMaterial()
    {
        return $this->belongsTo('App\Models\LogMaterial', 'material_id', 'id');
    }
}

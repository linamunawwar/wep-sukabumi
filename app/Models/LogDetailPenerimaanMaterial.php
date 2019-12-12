<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetailPenerimaanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_penerimaan_detail';
    public $timestamps = true;

    public function penerimaan()
    {
        return $this->hasOne('App\Models\LogPenerimaanMaterial', 'id', 'penerimaan_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Models\LogMaterial', 'material_id', 'id');
    }
}

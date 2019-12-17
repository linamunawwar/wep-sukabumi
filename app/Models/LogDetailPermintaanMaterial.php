<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetailPermintaanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_permintaan_detail';
    public $timestamps = true;

    public function detailPermintaan()
    {
        return $this->belongsTo('App\Models\LogPermintaanMaterial', 'permintaan_id', 'id');
    }

    public function detailPermintaanMaterial()
    {
        return $this->belongsTo('App\Models\LogMaterial', 'material_id', 'id');
    }

   
}

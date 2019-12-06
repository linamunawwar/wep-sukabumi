<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetailPermintaanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_permintaan_detail';
    public $timestamps = true;

    public function permintaan()
    {
        return $this->hasOne('App\Models\LogPermintaanMaterial', 'id', 'permintaan_id');
    }
}

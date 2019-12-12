<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPermintaanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_permintaan';
    public $timestamps = true;

    public function permintaanDetail()
    {
        return $this->belongsTo('App\Models\LogDetailPermintaanMaterial', 'id', 'permintaan_id');
    }

    public function penerimaan()
    {
        return $this->hasMany('App\Models\LogPenerimaanMaterial', 'kode_permintaan', 'kode_permintaan');
    }
}

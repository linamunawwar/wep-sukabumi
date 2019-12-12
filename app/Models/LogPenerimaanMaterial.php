<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPenerimaanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_penerimaan';
    public $timestamps = true;

    public function detailPenerimaan()
    {
        return $this->hasMany('App\Models\LogDetailPenerimaanMaterial', 'penerimaan_id', 'id');
    }

    public function permintaan()
    {
        return $this->belongsTo('App\Models\LogPermintaanMaterial', 'kode_permintaan', 'kode_permintaan');
    }
}

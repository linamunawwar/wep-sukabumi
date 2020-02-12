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
        return $this->hasMany('App\Models\LogDetailPermintaanMaterial', 'permintaan_id', 'id');
    }

    public function penerimaan()
    {
        return $this->hasMany('App\Models\LogPenerimaanMaterial', 'kode_permintaan', 'kode_permintaan');
    }

    public function penerimaanPengajuan()
    {
        return $this->hasMany('App\Models\LogPengajuanMaterial', 'kode_penerimaan', 'kode_penerimaan');
    }

    public function permintaanUser()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPengajuanPakai extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_pengajuan';
    public $timestamps = true;

    public function detailPengajuan()
    {
        return $this->hasMany('App\Models\LogDetailPengajuanPakai', 'pengajuan_id', 'id');
    }
}

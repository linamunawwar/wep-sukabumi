<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemoPegawai extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_memo_pegawai";

    public function memo()
    {
        return $this->hasOne('App\Memo','id','memo_id');
    }

    public function pegawai()
    {
        return $this->belongsToMany('App\Pegawai');
    }
}

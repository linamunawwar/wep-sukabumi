<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_memo";

    public function memoPegawai()
    {
        return $this->belongsTo('App\MemoPegawai','id','memo_id');
    }
}

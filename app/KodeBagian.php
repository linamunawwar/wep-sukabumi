<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeBagian extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_kode_bagian";
    public $timestamps = true;

    public function rkp()
    {
        return $this->belongsTo('App\Rkp','kode_bagian','kode');
    }
}

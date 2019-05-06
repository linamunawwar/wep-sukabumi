<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_gaji";

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

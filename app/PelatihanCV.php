<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelatihanCV extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_pelatihan_cv";

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

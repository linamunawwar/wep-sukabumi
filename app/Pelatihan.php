<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_pelatihan";

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

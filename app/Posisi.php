<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_posisi";


    public function pegawai()
    {
        return $this->hasMany('App\Pegawai','id','posisi_id');
    }
}

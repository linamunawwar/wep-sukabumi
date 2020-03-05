<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pkwt extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_pkwt";
    public $timestamps = true;


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }

}
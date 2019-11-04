<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_izin";
    public $timestamps = true;

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }

}

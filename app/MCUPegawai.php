<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCUPegawai extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_mcu";


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }

    public function mcu()
    {
        return $this->hasOne('App\MCU','id','pernyataan_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_slip_gaji";


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

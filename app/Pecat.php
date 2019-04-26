<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pecat extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_pecat";


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

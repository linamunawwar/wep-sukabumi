<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_spj";


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

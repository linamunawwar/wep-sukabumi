<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resign extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_resign";
    public $timestamps = true;


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

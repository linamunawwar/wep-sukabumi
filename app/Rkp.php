<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rkp extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_rkp";

    public function kodeBagian()
    {
        return $this->belongsTo('App\KodeBagian','kode_bagian','kode');
    }

    public function detailRkp()
    {
        return $this->belongsTo('App\DetailRkp','id','id_rkp');
    }
}

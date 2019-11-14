<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRkp extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_detail_rkp";
    protected $fillable = ['id_rkp'];
    public $timestamps = true;

    public function rkp()
    {
        return $this->hasOne('App\Rkp','id','id_rkp');
    }

    public function posisi()
    {
        return $this->belongsTo('App\Posisi','unit_kerja','id');
    }
}

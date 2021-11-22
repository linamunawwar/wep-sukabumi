<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogWasteDetail extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_tr_waste_detail";
    public $timestamps = true;

    public function wasteMaterial()
    {
        return $this->belongsTo('App\Models\LogMaterial','material_id','id');
    }

    public function pelaksanaPegawai()
    {
        return $this->belongsTo('App\Pegawai','pelaksana','nip');
    }

    public function waste()
    {
        return $this->hasOne('App\Models\LogWaste','id','waste_id');
    }
}

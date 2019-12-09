<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogWastePengajuan extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_tr_waste_pengajuan";
    public $timestamps = true;

    public function waste()
    {
        return $this->hasOne('App\Models\LogWaste','id','waste_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCU extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_mcu";
    public $timestamps = true;
    
    public function mcuPegawai()
    {
        return $this->belongsTo('App\MCUPegawai','id','pernyataan_id');
    }
}

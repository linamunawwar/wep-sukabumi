<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_mst_material";
    public $timestamps = true;

    public function materialPermintaan()
    {
        return $this->hasMany('App\Models\LogPermintaanMaterial','id','material_id');
    }

    public function materialWaste()
    {
        return $this->hasOne('App\Models\LogWaste','id','material_id');
    }
    
    public function materialDetailPermintaan()
    {
        return $this->hasOne('App\Models\LogDetailPermintaanMaterial','id','material_id');
    }
    
}


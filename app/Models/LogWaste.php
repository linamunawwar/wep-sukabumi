<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogWaste extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_tr_waste";
    public $timestamps = true;

    public function wasteMaterial()
    {
        return $this->belongsTo('App\Models\LogMaterial','material_id','id');
    }

    public function wasteJenisKerja()
    {
        return $this->belongsTo('App\Models\LogJenis','jenis_pekerjaan_id','id');
    }

    public function detailWaste()
    {
        return $this->belongsTo('App\Models\LogWasteDetail','id','waste_id');
    }

    public function pengajuanWaste()
    {
        return $this->belongsTo('App\Models\LogWastePengajuan','id','waste_id');
    }
}

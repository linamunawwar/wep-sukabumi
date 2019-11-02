<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
     protected $connection = 'mysql';
    protected $table = "mst_disposisi";

    public function disposisiTugas()
    {
        return $this->belongsTo('App\DisposisiTugas','id','disposisi_id');
    }
    public function surat()
    {
        return $this->hasOne('App\SuratMasuk','no_surat','no_surat');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_surat_masuk";

    public function disposisi()
    {
        return $this->hasOne('App\Disposisi','no_surat','no_surat');
    }
}

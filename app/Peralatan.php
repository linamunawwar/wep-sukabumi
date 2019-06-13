<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_peralatan";


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }

    public function inventori()
    {
        return $this->belongsTo('App\Inventori','kode_barang','kode_barang');
    }
}

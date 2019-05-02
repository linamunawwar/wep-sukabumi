<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_cuti";


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }

    public function pegawaiPengganti()
    {
        return $this->belongsTo('App\Pegawai','pengganti','nip');
    }
}

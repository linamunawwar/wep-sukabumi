<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_spj";
    public $timestamps = true;


    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }

    public function pegawaiTugas()
    {
        return $this->belongsTo('App\Pegawai','pemberi_tugas','nip');
    }
}

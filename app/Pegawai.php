<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_pegawai";

    protected $fillable = ['nama','email','role_id'];

    public function user()
    {
        return $this->hasOne('App\Models\User','pegawai_id','nip');
    }

    public function posisi()
    {
        return $this->belongsTo('App\Posisi','posisi_id','id');
    }

    public function pecat()
    {
        return $this->hasOne('App\Pecat','nip','nip');
    }

    public function resign()
    {
        return $this->hasOne('App\Resign','nip','nip');
    }

    public function mcuPegawai()
    {
        return $this->hasMany('App\MCUPegawai','nip','nip');
    }
}

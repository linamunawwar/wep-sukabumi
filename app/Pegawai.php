<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_pegawai";
    public $timestamps = true;
    
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

    public function cuti()
    {
        return $this->hasOne('App\Cuti','nip','nip');
    }

    public function cutiPengganti()
    {
        return $this->hasOne('App\Cuti','nip','pengganti');
    }

    public function izin()
    {
        return $this->hasOne('App\Izin','nip','nip');
    }

    public function gaji()
    {
        return $this->hasOne('App\Gaji','nip','nip');
    }

    public function bank()
    {
        return $this->hasOne('App\BankAsuransi','nip','nip');
    }

    public function slipGaji()
    {
        return $this->hasMany('App\SlipGaji','nip','nip');
    }

    public function memoPegawai()
    {
        return $this->belongsToMany('App\MemoPegawai');
    }
    
    public function spj()
    {
        return $this->hasMany('App\Spj','nip','nip');
    }

    public function spjTugas()
    {
        return $this->hasMany('App\Spj','nip','pemberi_tugas');
    }

    public function peralatan()
    {
        return $this->hasMany('App\Spj','nip','nip');
    }

    public function pelatihan()
    {
        return $this->hasOne('App\Pelatihan','nip','nip');
    }
}

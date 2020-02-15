<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPengajuanMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log_tr_pengajuan';
    public $timestamps = true;

    public function pengajuanDetail()
    {
        return $this->hasMany('App\Models\LogDetailPengajuanMaterial', 'pengajuan_id', 'id');
    }

    public function pengajuanPenerimaanMaterial()
    {
        return $this->belongsTo('App\Models\LogPenerimaanMaterial', 'kode_penerimaan', 'kode_penerimaan');
    }

    public function pengajuanJenisPekerjaan()
    {
        return $this->belongsTo('App\Models\LogJenis', 'jenis_pekerjaan_id', 'id');
    }

    public function pengajuanLokasiPekerjaan()
    {
        return $this->belongsTo('App\Models\LogLokasi', 'lokasi_kerja_id', 'id');
    }

    public function pengajuanUser()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}

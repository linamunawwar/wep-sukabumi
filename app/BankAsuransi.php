<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAsuransi extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_bank_asuransi";

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai','nip','nip');
    }
}

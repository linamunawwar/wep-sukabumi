<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventori extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_peralatan";
    public $timestamps = true;


    public function peralatan()
    {
        return $this->hasMany('App\Peralatan','kode_barang','kode_barang');
    }
}

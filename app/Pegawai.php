<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_pegawai";

    protected $fillable = ['nama','email','role_id'];
}

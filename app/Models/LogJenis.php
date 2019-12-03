<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogJenis extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_mst_jenis_pekerjaan";
    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogLokasi extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_mst_lokasi";
    public $timestamps = true;
}

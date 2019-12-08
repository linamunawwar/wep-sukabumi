<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogMaterial extends Model
{
    protected $connection = 'mysql';
    protected $table = "log_mst_material";
    public $timestamps = true;
}


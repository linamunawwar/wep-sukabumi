<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenagaPengajar extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_tenaga_pengajar";
    public $timestamps = true;
}

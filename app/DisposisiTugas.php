<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisposisiTugas extends Model
{
    protected $connection = 'mysql';
    protected $table = "tr_disposisi";

     public function disposisi()
    {
        return $this->hasOne('App\Disposisi','id','disposisi_id');
    }
}

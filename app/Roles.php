<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $connection = 'mysql';
    protected $table = "roles";

    public function menu()
    {
        return $this->hasMany('App\Menu','id','default_role');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $connection = 'mysql';
    protected $table = "permissions";
    public $timestamps = true;

    public function menu()
    {
        return $this->belongsTo('App\Menu','id_menu','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
}

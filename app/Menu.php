<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'mysql';
    protected $table = "mst_menu";
    public $timestamps = true;
    protected $fillable = [
        'urutan','nama','alias','directori','icon','default_role'
    ];

    public function role()
    {
        return $this->belongsTo('App\Roles','default_role','id');
    }
}

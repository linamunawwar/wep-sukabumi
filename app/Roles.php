<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $connection = 'mysql';
    protected $table = "roles";
}

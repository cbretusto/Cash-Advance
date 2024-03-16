<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RapidXUserAccess extends Model
{
    protected $table = "user_accesses";
    protected $connection = "mysql_rapidx";
}

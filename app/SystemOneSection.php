<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemOneSection extends Model
{
    protected $table = 'tbl_Section';
    protected $connection = 'mysql_systemone';
}

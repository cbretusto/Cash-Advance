<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemOneSupervisor extends Model
{
    protected $table = 'vw_supervisors';
    protected $connection = 'mysql_systemone';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// MODEL
use App\OnlineCashAdvance;

class SystemOneACL extends Model
{
    protected $table = 'tbl_useraccnt';
    protected $connection = 'mysql_systemone_acl';
}

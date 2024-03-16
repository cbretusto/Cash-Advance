<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RapidXUserAccess;

class RapidXUser extends Model
{
    protected $table = "users";
    protected $connection = "mysql_rapidx";

    public function rapidx_user_access_details(){
        return $this->hasMany(RapidXUserAccess::class, 'user_id', 'id')->where('module_id', '12'); //12 = Cash Advance Module
    }

}

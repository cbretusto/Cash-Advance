<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// MODEL
use App\OnlineCashAdvance;
use App\ApproverEmailRecipient;
use App\RapidXUser;

class UserApprover extends Model
{
    protected $table = 'user_approvers';
    protected $connection = 'mysql';

    public function rapidx_user_details()
    {
    	return $this->hasOne(RapidXUser::class, 'id', 'rapidx_id');
    }    
}

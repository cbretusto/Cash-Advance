<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// MODEL
use App\RapidXUser;
use App\UserApprover;
use App\ApproverEmailRecipient;
use App\PayrollAccountNo;

class OnlineCashAdvance extends Model
{
    protected $table = 'online_cash_advances';
    protected $connection = 'mysql';

    public function approver_email_recipients(){
        return $this->hasMany(ApproverEmailRecipient::class, 'ca_id', 'id');
    }

    public function payroll_account(){
        return $this->hasOne(PayrollAccountNo::class, 'EmpNo', 'id');
    }

    public function cash_advance_rapidx_account_info(){
        return $this->hasOne(RapidXUser::class, 'employee_number', 'employee_no');
    }

}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RapidXUser;

class PayrollAccountNo extends Model
{ 
    // protected $table = 'tbl_payroll_info';
    // protected $connection = 'mysql';
    protected $table = 'tbl_account_no';
    protected $connection = 'mysql_rapid_payroll';


    public function rapidx_account_info(){
        return $this->hasOne(RapidXUser::class, 'employee_number', 'emp_no');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// MODEL
use App\OnlineCashAdvance;
use App\SystemOnePosition;
use App\SystemOneDepartment;
use App\SystemOneSection;

class SystemOneHRIS extends Model
{
    protected $table = 'tbl_EmployeeInfo';
    protected $connection = 'mysql_systemone';

    public function position_info(){
        return $this->hasOne(SystemOnePosition::class, 'pkid', 'fkPosition');
    }
    public function department_info(){
        return $this->hasOne(SystemOneDepartment::class, 'pkid', 'fkDepartment');
    } 
    public function section_info(){
        return $this->hasOne(SystemOneSection::class, 'pkid', 'fkSection');
    } 
}  
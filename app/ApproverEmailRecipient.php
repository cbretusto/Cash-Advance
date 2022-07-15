<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//MODEL
use App\OnlineCashAdvance;
use App\UserApprover;
use App\RapidXUser;
use App\SystemOneSupervisor;

class ApproverEmailRecipient extends Model
{
    protected $table = 'approver_email_recipients';
    protected $connection = 'mysql';

    public function supervisor_approver(){
        return $this->hasOne(SystemOneSupervisor::class, 'username', 'supervisor');
    }
    public function supervisor_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'supervisor_remark');
    }

    public function sect_head_approver(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'section_head');
    }
    public function sect_head_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'section_head_remark');
    }

    public function dept_head_approver(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'department_head');
    }
    public function dept_head_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'department_head_remark');
    }

    public function cashier_approver(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'cashier');
    }
    public function cashier_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'cashier_remark');
    }

    public function treasury_head_approver(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'treasury_head');
    }
    public function treasury_head_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'treasury_head_remark');
    }

    public function finance_general_manager_approver(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'finance_general_manager');
    }
    public function finance_general_manager_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'finance_general_manager_remark');
    }

    public function president_approver(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'president');
    }
    public function president_remark(){
        return $this->hasOne(UserApprover::class, 'rapidx_id', 'president_remark');
    }

    public function cash_advance_details(){
        return $this->hasOne(OnlineCashAdvance::class, 'id', 'ca_id');
    }

    public function requestor_esignature(){
        return $this->hasOne(RapidXUser::class, 'id', 'user_id');
    }
}

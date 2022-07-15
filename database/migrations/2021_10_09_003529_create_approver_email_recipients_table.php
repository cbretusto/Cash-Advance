<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproverEmailRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approver_email_recipients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ca_id');
            $table->string('user_id');
            $table->string('supervisor');
            $table->string('supervisor_remark');
            $table->string('supervisor_date_time')->comment = 'Approved / Disapproved';
            $table->string('section_head');
            $table->string('section_head_remark');
            $table->string('section_head_date_time')->comment = 'Approved / Disapproved';
            $table->string('department_head');
            $table->string('department_head_remark');
            $table->string('department_head_date_time')->comment = 'Approved / Disapproved';
            $table->string('president');
            $table->string('president_remark');
            $table->string('president_date_time')->comment = 'Approved / Disapproved';
            $table->string('cashier');
            $table->string('cashier_remark');
            $table->string('cashier_date_time')->comment = 'Approved / Disapproved';
            $table->string('treasury_head');
            $table->string('treasury_head_remark');
            $table->string('treasury_head_date_time')->comment = 'Approved / Disapproved';
            $table->string('finance_general_manager');
            $table->string('finance_general_manager_remark');
            $table->string('finance_general_manager_date_time')->comment = 'Approved / Disapproved';
            $table->string('email');
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approver_email_recipients');
    }
}

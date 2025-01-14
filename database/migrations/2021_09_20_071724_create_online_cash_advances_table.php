<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineCashAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_cash_advances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ca_no');
            $table->string('date_applied');
            $table->string('employee_no');
            $table->string('applicant_name');
            $table->string('position');
            $table->string('official_station');
            $table->string('date_of_liquidation');
            $table->bigInteger('amount_of_ca');
            $table->bigInteger('amount_of_ca_currency');
            $table->string('ca_convert_to_word');
            $table->string('mode_of_payment');
            $table->string('payroll_account_no');
            $table->string('gcash_account_no');
            $table->string('local_no');
            $table->string('purpose');
            $table->string('requested_by');
            $table->string('previous_advance');
            $table->string('date');
            $table->string('date_liquidated');
            $table->string('uploaded_file');
            $table->unsignedTinyInteger('uploaded_file_status')->default(1)->comment = '1-with file,2-without file';
            $table->unsignedTinyInteger('status')->default(0)
            ->comment ='0-Approval of Supervisor
                        1-Approval of Sect Head, 
                        2-Approval of Dept Head, 
                        3-Approval of Cashier, 
                        4-Approval of Treasury Head, 
                        5-Approval of Fin. Gen. Manager, 
                        6-Approval of President, 
                        7-Approved, 
                        8-Supervisor Disapproved,
                        9-Sect Head Disapproved,
                        10-Dept Head Disapproved,
                        11-Cashier Disapproved,
                        12-Treasury Head Disapproved,
                        13-Fin. Gen. Manager Disapproved,
                        14-President Disapproved';
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
        Schema::dropIfExists('online_cash_advances');
    }
}

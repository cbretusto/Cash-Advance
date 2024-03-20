<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use DataTables;
use Auth;
use Mail;

// MODEL
use App\SystemOnePhoneDirectory;
use App\ApproverEmailRecipient;
use App\SystemOneSupervisor;
use App\OnlineCashAdvance;
use App\PayrollAccountNo;
use App\SystemOneHRIS;
use App\UserApprover;
use App\RapidXUser;

class CashAdvanceController extends Controller
{
    //============================== VIEW CASH ADVANCE ==============================
    public function view_cash_advance(Request $request){
        /* 
            TODO: Add this another (where clause) if I had Session
            *ex. ->where('employee_no', 'Q113')
        */
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];
        $supervisor_id = SystemOneSupervisor::where('username', $rapidx_username)->get();
        // $request = ApproverEmailRecipient::where('user_id', $rapidx_user_id)->get('user_id');
        // return $supervisor_id;   

        $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])
        ->where('user_id', $rapidx_user_id)
        ->orWhere('supervisor', $rapidx_username)
        ->orWhere('section_head', $rapidx_user_id )
        ->orWhere('section_head_remark', $rapidx_user_id )
        ->orWhere('department_head', $rapidx_user_id )
        ->orWhere('department_head_remark', $rapidx_user_id )
        ->orWhere('cashier', $rapidx_user_id )
        ->orWhere('cashier_remark', $rapidx_user_id )
        ->orWhere('treasury_head', $rapidx_user_id )
        ->orWhere('treasury_head_remark', $rapidx_user_id )
        ->orWhere('finance_general_manager', $rapidx_user_id )
        ->orWhere('finance_general_manager_remark', $rapidx_user_id )
        ->orWhere('president', $rapidx_user_id )
        ->orWhere('president_remark', $rapidx_user_id )
        ->get();

        if($rapidx_username == 'eanejal'  || $rapidx_username == 'gbcuevas' ||  $rapidx_username == 'gbcuevas' || $rapidx_username == 'cbretusto'){
            $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])->get();
        }

        $employee_infos = collect($employee_infos)->where('logdel', 0);
        $employee_infos = collect($employee_infos)->whereIn('cash_advance_details.status', [0,1,2,3,4,5,6]);
        // $employee_infos = collect($employee_infos)->orderBy('cash_advance_details.status', 'asc');

        $approver = UserApprover::where('rapidx_id', $rapidx_user_id)->where('status', 1)->get();
        $get_supervisor_approver = ApproverEmailRecipient::where('supervisor', $rapidx_username)->get();
        $edit_button = ApproverEmailRecipient::where('user_id', $rapidx_user_id)->get('user_id');

        // return $get_supervisor_approver;
		return DataTables::of($employee_infos)

		->addColumn('status', function($employee_info) {
			$result = "";
			$result = '<center>';
            if ($employee_info->supervisor != null){
                if($employee_info->cash_advance_details->status == 0){
                    $result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                    $result .= '<span class="badge badge-pill badge-warning">Supervisor</span>';
                }
            }else { 
                // if($employee_info->supervisor == null){
                //     if($employee_info->cash_advance_details->status == 1){
                //         $result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                //         $result .= '<span class="badge badge-pill badge-warning">Section Head</span>';
                //     }
                // }
            }
            if($employee_info->cash_advance_details->status == 1){
                $result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                $result .= '<span class="badge badge-pill badge-warning">Section Head</span>';
            }
            else if($employee_info->cash_advance_details->status == 2){
				$result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                $result .= '<span class="badge badge-pill badge-warning">Department Head</span>';
			}
            else if($employee_info->cash_advance_details->status == 3){
				$result .= '<span class="badge badge-pill badge-warning">Approval of</span><br>';
                $result .= '<span class="badge badge-pill badge-warning">Cashier</span>';
			}
            else if($employee_info->cash_advance_details->status == 4){
				$result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                $result .= '<span class="badge badge-pill badge-warning">Treasury Head</span>';
			}
            else if($employee_info->cash_advance_details->status == 5){
				$result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                $result .= '<span class="badge badge-pill badge-warning">Fin. Gen. Manager</span>';
			}
            else if($employee_info->cash_advance_details->status == 6){
				$result .= '<span class="badge badge-pill badge-warning" >Approval of President</span>';
			}
			else if($employee_info->cash_advance_details->status == 7){
				$result .= '<span class="badge badge-pill badge-success">APPROVED</span>';
                $result .= '<br>';
                if($employee_info->cash_advance_details->status == 7 && $employee_info->cash_advance_details->date_liquidated != null){
                    $result .= '<span class="badge badge-pill badge-success">LIQUIDATED</span>';
                    $result .= '<br>';    
                }
			}
			else if($employee_info->cash_advance_details->status == 8){
				$result .= '<span class="badge badge-pill badge-danger" status"7">DISAPPROVED</span>';
                $result .= '<br>';
			}
            else if($employee_info->cash_advance_details->status == 9){
				$result .= '<span class="badge badge-pill badge-danger" status"8">DISAPPROVED</span>';
                $result .= '<br>';
			}
            else if($employee_info->cash_advance_details->status == 10){
				$result .= '<span class="badge badge-pill badge-danger" status"9">DISAPPROVED</span>';
                $result .= '<br>';
			}
            else if($employee_info->cash_advance_details->status == 11){
				$result .= '<span class="badge badge-pill badge-danger" status"10">DISAPPROVED</span>';
                $result .= '<br>';
			}
            else if($employee_info->cash_advance_details->status == 12){
				$result .= '<span class="badge badge-pill badge-danger" status"11">DISAPPROVED</span>';
                $result .= '<br>';
			}
            else if($employee_info->cash_advance_details->status == 13){
				$result .= '<span class="badge badge-pill badge-danger" status"12">DISAPPROVED</span>';
                $result .= '<br>';
			}
            else if($employee_info->cash_advance_details->status == 14){
				$result .= '<span class="badge badge-pill badge-danger" status"13">DISAPPROVED</span>';
                $result .= '<br>';
			}
			$result .= '</center>';
			return $result;
		})

        ->addColumn('uploaded_file', function($employee_infos) {
			$result = "";
            $result = '<center>';
            if ($employee_infos->cash_advance_details->uploaded_file_status == 1){
                // $result .= "<a href='download_file/".$employee_infos->cash_advance_details->id."'> See Attachment</a>";
                $result .= "<a href='download_file/".$employee_infos->cash_advance_details->id."'> See Attachment</a>";
            }else{
                $result .= '<span class="badge badge-pill badge-dark">No File Uploaded</span>';
            }
            $result .= '</center>';
			return $result;
		})

        ->addColumn('approvers', function($employee_infos) use ($approver, $supervisor_id){
            $result = '';

            switch ($employee_infos->cash_advance_details->status)
            {
                case 0:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-warning"> '.$employee_infos->supervisor_approver->emp_name.'</span>';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 1:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success">'.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-warning"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 2:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.'';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-warning"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 3:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.'';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-warning"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 4:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.'';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-warning"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else if ($employee_infos->president_approver != null){
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 5:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.'';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->treasury_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-warning"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 6:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.'';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->treasury_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->finance_general_manager_date_time.'';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 7:
                    {
                        if ($employee_infos->supervisor_approver == null){

                        }else{
                            $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                            $result .= ' '.$employee_infos->supervisor_date_time.'';
                            $result .= '<br>';
                        }
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->section_head_date_time.'';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->department_head_date_time.'';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->cashier_date_time.'';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->treasury_head_date_time.'';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->finance_general_manager_date_time.'';
                        $result .= '<br>';
    
                        if ($employee_infos->president_approver == null){
    
                        }else {
                            $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                            $result .= ' '.$employee_infos->president_date_time.'';
                            $result .= '<br>';
                        }
                        break;
                    }

                case 8:
                    {
                        if ($employee_infos->supervisor_approver == null){

                        }else{
                            $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->supervisor_approver->emp_name.'</span>';
                            $result .= '<br>';
                            $result .= '<strong>Remark:</strong> <br>'.$employee_infos->supervisor_remark.'';
                            $result .= '<br>';
                                $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->supervisor_date_time.'';
                            $result .= '<br>';
                        }
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';

                        if ($employee_infos->president_approver == null){

                        }else {
                            $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                            $result .= '<br>';
                        }
                        break;
                    }

                case 9:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->section_head_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->section_head_date_time.'';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 10:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';

                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->department_head_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->department_head_date_time.'';
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 11:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->cashier_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->cashier_date_time.'';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 12;
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->treasury_head_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->treasury_head_date_time.'';

                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 13:
                    {
                        if ($employee_infos->supervisor_approver == null){
    
                        }else{
                            $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                            $result .= ' '.$employee_infos->supervisor_date_time.' ';
                            $result .= '<br>';
                        }
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->section_head_date_time.' ';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->department_head_date_time.' ';
                        $result .= '<br>';
    
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->cashier_date_time.' ';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->treasury_head_date_time.' ';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        $result .= '<strong>Remark:</strong> <br>'.$employee_infos->finance_general_manager_remark.'';
                        $result .= '<br>';
                        $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->finance_general_manager_date_time.'';
    
                        if ($employee_infos->president_approver == null){
    
                        }else {
                            $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                            $result .= '<br>';
                        }
                        break;
                    }

                case 14:
                {
                    if ($employee_infos->supervisor_approver == null){

                    
                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.' ';
                    $result .= '<br>';

                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->treasury_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->finance_general_manager_date_time.' ';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        $result .= '<strong>Remark:</strong> <br>'.$employee_infos->president_remark.'';
                        $result .= '<br>';
                        $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->president_date_time.'';
                    }
                    break;
                }

            }
	        return $result;
        })

		->addColumn('action', function($employee_infos) use ($rapidx_user_id, $approver, $edit_button, $rapidx_username, $get_supervisor_approver) {
            $result = "";
            $result = '<center>';

            $result .= "<a href='view_pdf/". $employee_infos->id . "' target='_blank'>
                            <button type='button' class='btn btn-outline-primary btn-sm fa fa-eye text-center actionViewCashAdvance' style='width:105px;margin:2%' cash_advance-id='" . $employee_infos->id . "' data-toggle='modal' data-target='#pdfViewCashAdvance' data-keyboard='false'> View</button>
                        </a>";
            if($rapidx_username == 'loatienza'){      
                $result .= '<button type="button" class="btn btn-outline-danger btn-sm text-center actionCancelCA" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" data-toggle="modal" data-target="#modalCancel" data-keyboard="false"><i class="fas fa-times"></i> Cancel</button>';
            }
            $result .= '<br>';

            // return $employee_infos->cash_advance_details->status;

            if(count($edit_button) != 0){
                $result .= '<button type="button" class="btn btn-outline-dark btn-sm fa fa-edit text-center actionEditCashAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" data-toggle="modal" data-target="#modalEditCashAdvance" data-keyboard="false"> Edit</button>';
                $result .= '<br>'; 
            }

            if(count($approver) == 0){
                switch ($employee_infos->cash_advance_details->status) 
                {
                    case 0:
                    {
                        for ($i=0; $i < count($get_supervisor_approver); $i++) { 
                            if($get_supervisor_approver[$i]->supervisor == $rapidx_username && $employee_infos->supervisor == $rapidx_username){
                                $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="1" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                $result .= '<br>';   
                                $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="8" remarks="supervisor_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                $result .= '<br>';  
                            }
                        }
                        break;
                    }    
                }
            }
            else{
                if( $employee_infos->cash_advance_details->status == 7){
                    for ($i=0; $i < count($approver); $i++) { 
                        if($approver[$i]->classification == 'Cashier'){
                            if ($employee_infos->cash_advance_details->date == null){
                                $result .= '<button type="button" class="btn btn-outline-dark btn-sm text-center actionDateCashReceived" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateCashReceived" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Date Cash Received </button>';
                                $result .= '<br>';      
                            }

                            if ($employee_infos->cash_advance_details->date_liquidated == null){
                                $result .= '<button type="button" class="btn btn-outline-info btn-sm text-center actionDateLiquidated" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateLiquidated" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Liquidate </button>';
                                $result .= '<br>';
                            }
                            
                        }
                    }
                }

                switch ($employee_infos->cash_advance_details->status) 
                { 
                    case 0:
                        {
                            for ($i=0; $i < count($get_supervisor_approver); $i++) { 
                                if($get_supervisor_approver[$i]->supervisor == $rapidx_username && $employee_infos->supervisor == $rapidx_username){
                                    $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="1" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                    $result .= '<br>';   
                                    $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="8" remarks="supervisor_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                    $result .= '<br>';  
                                }
                            }
                            break;
                        }    

                    case 1:
                    {
                        for ($i=0; $i < count($approver); $i++) { 
                            if($approver[$i]->classification == 'Section Head' && $employee_infos->section_head == $rapidx_user_id){
                                $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="2" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                $result .= '<br>';   
                                $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="9" remarks="section_head_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                $result .= '<br>';  
                            }
                        }
                        break;
                    }    

                    case 2:
                    {
                        for ($i=0; $i < count($approver); $i++) { 
                            if($approver[$i]->classification == 'Department Head' && $employee_infos->department_head == $rapidx_user_id){
                                $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="3" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                $result .= '<br>';   
                                $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="10" remarks="department_head_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                $result .= '<br>';  
                            }
                        }                        
                        break;
                    }     

                    case 3:
                    {
                        for ($i=0; $i < count($approver); $i++) {
                            if($approver[$i]->classification == 'Cashier' && $employee_infos->cashier == $rapidx_user_id){
                                if ($employee_infos->cash_advance_details->previous_advance == null){
                                    $result .= '<button type="button" class="btn btn-outline-info btn-sm fa fa-edit text-center actionPreviousAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" remarks="previous_advance" data-target="#modalPreviousAdvance" data-keyboard="false">  Previous Advance</button>';
                                    $result .= '<br>';

                                    // $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="4" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                    // $result .= '<br>';
                                    // $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="11" remarks="cashier_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                    // $result .= '<br>';
                                }else{
                                    $result .= '<button type="button" class="btn btn-outline-info btn-sm fa fa-edit text-center actionPreviousAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" remarks="previous_advance" data-target="#modalPreviousAdvance" data-keyboard="false">  Previous Advance</button>';
                                    $result .= '<br>';

                                    $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="4" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                    $result .= '<br>';
                                    $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="11" remarks="cashier_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                    $result .= '<br>';
                                }
                            }
                        }
                        break;
                    }     

                    case 4:
                    {
                        for ($i=0; $i < count($approver); $i++) { 
                            if($approver[$i]->classification == 'Treasury Head' && $employee_infos->treasury_head == $rapidx_user_id){
                                $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="5" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                $result .= '<br>';   
                                $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="12" remarks="treasury_head_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                $result .= '<br>';  

                                if ($employee_infos->president == null){
                                    $result .= '<button type="button" class="btn btn-outline-info btn-sm fas fa-id-badge text-center actionAddPresident" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="" data-toggle="modal" data-target="#modalAddPresident" data-keyboard="false">  Add President</button>';
                                    $result .= '<br>';   
                                }else{
                                }
                            }
                        }
                        break;
                    }     

                    case 5:
                    {
                        for ($i=0; $i < count($approver); $i++) { 
                            if($approver[$i]->classification == 'Finance General Manager' && $employee_infos->finance_general_manager == $rapidx_user_id){
                                if ($employee_infos->president == null ){
                                    $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="7" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                    $result .= '<br>';   
                                    $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="13" remarks="finance_general_manager_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                    $result .= '<br>';
                                    $result .= '<button type="button" class="btn btn-outline-info btn-sm fas fa-id-badge text-center actionAddPresident" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="" data-toggle="modal" data-target="#modalAddPresident" data-keyboard="false">  Add President</button>';
                                    $result .= '<br>';   
                                }
                                else{  
                                    $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="6" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                    $result .= '<br>';   
                                    $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="13" remarks="finance_general_manager_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                    $result .= '<br>';
                                }
                            }
                        }
                        break;   
                    }

                    case 6:
                    {
                        for ($i=0; $i < count($approver); $i++) { 
                            if($approver[$i]->classification == 'President' && $employee_infos->president == $rapidx_user_id){
                                $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="7" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                                $result .= '<br>';   
                                $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="14" remarks="president_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                                $result .= '<br>';  
                            }
                        }
                        break;
                    }  
                }  
            }

            $result .= '</center>';
            return $result;                  
        })
        
		->rawColumns(['status', 'action', 'uploaded_file', 'approvers'])
		->make(true);
	}	

    //============================== VIEW CASH ADVANCE APPROVED ==============================
    public function view_cash_advance_approved(Request $request){
        /*
            TODO: Add this another (where clause) if I had Session
            *ex. ->where('employee_no', 'Q113')
        */
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];
        $supervisor_id = SystemOneSupervisor::where('username', $rapidx_username)->get();

        $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])
        ->where('user_id', $rapidx_user_id)
        ->orWhere('supervisor', $rapidx_username)
        ->orWhere('section_head', $rapidx_user_id )
        ->orWhere('section_head_remark', $rapidx_user_id )
        ->orWhere('department_head', $rapidx_user_id )
        ->orWhere('department_head_remark', $rapidx_user_id )
        ->orWhere('cashier', $rapidx_user_id )
        ->orWhere('cashier_remark', $rapidx_user_id )
        ->orWhere('treasury_head', $rapidx_user_id )
        ->orWhere('treasury_head_remark', $rapidx_user_id )
        ->orWhere('finance_general_manager', $rapidx_user_id )
        ->orWhere('finance_general_manager_remark', $rapidx_user_id )
        ->orWhere('president', $rapidx_user_id )
        ->orWhere('president_remark', $rapidx_user_id )
        ->get();

        if($rapidx_username == 'gbcuevas' || $rapidx_username == 'sdcastillo'  || $rapidx_username == 'cbretusto'){
            $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])->get();
        }

        $employee_infos = collect($employee_infos)->where('logdel', 0);
        $employee_infos = collect($employee_infos)->where('cash_advance_details.status', 7)->where('cash_advance_details.date_liquidated', '==', null);
        
        $approver = UserApprover::where('rapidx_id', $rapidx_user_id)->where('status', 1)->get();
        $get_supervisor_approver = ApproverEmailRecipient::where('supervisor', $rapidx_username)->get();
        $edit_button = ApproverEmailRecipient::where('user_id', $rapidx_user_id)->get('user_id');

		return DataTables::of($employee_infos)

		->addColumn('status', function($employee_info) {
			$result = "";
			$result = '<center>';
			if($employee_info->cash_advance_details->status == 7){
				$result .= '<span class="badge badge-pill badge-success">APPROVED</span>';
                $result .= '<br>';
			}
			$result .= '</center>';
			return $result;
		})

        ->addColumn('uploaded_file', function($employee_infos) {
			$result = "";
            $result = '<center>';
            if ($employee_infos->cash_advance_details->uploaded_file_status == 1){
                $result .= "<a href='download_file/".$employee_infos->cash_advance_details->id."'> See Attachment</a>";
            }else{
                $result .= '<span class="badge badge-pill badge-dark">No File Uploaded</span>';
            }
            $result .= '</center>';
			return $result;
		})

        ->addColumn('approvers', function($employee_infos) use ($approver, $supervisor_id){
            $result = '';
            if ($employee_infos->cash_advance_details->status == 7){
                if ($employee_infos->supervisor_approver == null){

                }else{
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->supervisor_date_time.'';
                    $result .= '<br>';
                }
                $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                $result .= ' '.$employee_infos->section_head_date_time.'';
                $result .= '<br>';
                
                $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                $result .= ' '.$employee_infos->department_head_date_time.'';
                $result .= '<br>';
                
                $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                $result .= ' '.$employee_infos->cashier_date_time.'';
                $result .= '<br>';
                
                $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                $result .= ' '.$employee_infos->treasury_head_date_time.'';
                $result .= '<br>';
                
                $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                $result .= ' '.$employee_infos->finance_general_manager_date_time.'';
                $result .= '<br>';

                if ($employee_infos->president_approver == null){

                }else {
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->president_date_time.'';
                    $result .= '<br>';
                }
            }
	        return $result;
        })

		->addColumn('action', function($employee_infos) use ($rapidx_user_id, $approver, $edit_button, $rapidx_username, $get_supervisor_approver) {
            $result = "";
            $result = '<center>';

            $result .= "<a href='view_pdf/". $employee_infos->id . "' target='_blank'>
                        <button type='button' class='btn btn-outline-primary btn-sm fa fa-eye text-center actionViewCashAdvance' style='width:105px;margin:2%' cash_advance-id='" . $employee_infos->id . "' data-toggle='modal' data-target='#pdfViewCashAdvance' data-keyboard='false'> View</button>
                        </a>";
            $result .= '<br>';

            // if(count($edit_button) != 0){
            //     $result .= '<button type="button" class="btn btn-outline-dark btn-sm fa fa-edit text-center actionEditCashAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" data-toggle="modal" data-target="#modalEditCashAdvance" data-keyboard="false"> Edit</button>';
            //     $result .= '<br>';
            // }else{

            // }

            if(count($approver) == 0){

            }
            else{
                if( $employee_infos->cash_advance_details->status == 7){
                    for ($i=0; $i < count($approver); $i++) {
                        if($approver[$i]->classification == 'Cashier'){
                            if ($employee_infos->cash_advance_details->date == null){
                                $result .= '<button type="button" class="btn btn-outline-dark btn-sm text-center actionDateCashReceived" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateCashReceived" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Date Cash Received </button>';
                                $result .= '<br>';
                            }else{
                                if ($employee_infos->cash_advance_details->date_liquidated == null){
                                    $result .= '<button type="button" class="btn btn-outline-info btn-sm text-center actionDateLiquidated" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateLiquidated" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Liquidate </button>';
                                    $result .= '<br>';
                                    
                                }else{
                                }
                            }
                            $result .= '<button type="button" class="btn btn-outline-danger btn-sm text-center actionCancelCA" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" data-toggle="modal" data-target="#modalCancel" data-keyboard="false"><i class="fas fa-times"></i> Cancel</button>';
                            $result .= '<br>';
                        }
                    }
                }
            }

            $result .= '</center>';
            return $result;
        })
		->rawColumns(['status', 'action', 'uploaded_file', 'approvers'])
		->make(true);
	}

    //============================== VIEW CASH ADVANCE DISAPPROVED ==============================
    public function view_cash_advance_disapproved(Request $request){
        /*
            TODO: Add this another (where clause) if I had Session
            *ex. ->where('employee_no', 'Q113')
        */
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];
        $supervisor_id = SystemOneSupervisor::where('username', $rapidx_username)->get();

        $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])
        ->where('user_id', $rapidx_user_id)
        ->orWhere('supervisor', $rapidx_username)
        ->orWhere('section_head', $rapidx_user_id )
        ->orWhere('section_head_remark', $rapidx_user_id )
        ->orWhere('department_head', $rapidx_user_id )
        ->orWhere('department_head_remark', $rapidx_user_id )
        ->orWhere('cashier', $rapidx_user_id )
        ->orWhere('cashier_remark', $rapidx_user_id )
        ->orWhere('treasury_head', $rapidx_user_id )
        ->orWhere('treasury_head_remark', $rapidx_user_id )
        ->orWhere('finance_general_manager', $rapidx_user_id )
        ->orWhere('finance_general_manager_remark', $rapidx_user_id )
        ->orWhere('president', $rapidx_user_id )
        ->orWhere('president_remark', $rapidx_user_id )
        ->get();

        if($rapidx_username == 'gbcuevas' || $rapidx_username == 'sdcastillo'  || $rapidx_username == 'cbretusto'){
            $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])->get();
        }

        $employee_infos = collect($employee_infos)->where('logdel', 0);
        $employee_infos = collect($employee_infos)->whereIn('cash_advance_details.status', [8,9,10,11,12,13,14]);
        
        $approver = UserApprover::where('rapidx_id', $rapidx_user_id)->where('status', 1)->get();
        $get_supervisor_approver = ApproverEmailRecipient::where('supervisor', $rapidx_username)->get();
        $edit_button = ApproverEmailRecipient::where('user_id', $rapidx_user_id)->get('user_id');
        return DataTables::of($employee_infos)

        ->addColumn('status', function($employee_info) {
            $result = "";
            $result = '<center>';
            if ($employee_info->supervisor != null){
                if($employee_info->cash_advance_details->status == 0){
                    $result .= '<span class="badge badge-pill badge-warning">Approval of</span>';
                    $result .= '<span class="badge badge-pill badge-warning">Supervisor</span>';
                }
            }else {

            }
            if($employee_info->cash_advance_details->status == 8){
                $result .= '<span class="badge badge-pill badge-danger" status"7">DISAPPROVED</span>';
                $result .= '<br>';
            }
            else if($employee_info->cash_advance_details->status == 9){
                $result .= '<span class="badge badge-pill badge-danger" status"8">DISAPPROVED</span>';
                $result .= '<br>';
            }
            else if($employee_info->cash_advance_details->status == 10){
                $result .= '<span class="badge badge-pill badge-danger" status"9">DISAPPROVED</span>';
                $result .= '<br>';
            }
            else if($employee_info->cash_advance_details->status == 11){
                $result .= '<span class="badge badge-pill badge-danger" status"10">DISAPPROVED</span>';
                $result .= '<br>';
            }
            else if($employee_info->cash_advance_details->status == 12){
                $result .= '<span class="badge badge-pill badge-danger" status"11">DISAPPROVED</span>';
                $result .= '<br>';
            }
            else if($employee_info->cash_advance_details->status == 13){
                $result .= '<span class="badge badge-pill badge-danger" status"12">DISAPPROVED</span>';
                $result .= '<br>';
            }
            else if($employee_info->cash_advance_details->status == 14){
                $result .= '<span class="badge badge-pill badge-danger" status"13">DISAPPROVED</span>';
                $result .= '<br>';
            }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('uploaded_file', function($employee_infos) {
            $result = "";
            $result = '<center>';
            if ($employee_infos->cash_advance_details->uploaded_file_status == 1){
                $result .= "<a href='download_file/".$employee_infos->cash_advance_details->id."'> See Attachment</a>";
            }else{
                $result .= '<span class="badge badge-pill badge-dark">No File Uploaded</span>';
            }
            $result .= '</center>';
            return $result;
        })

        ->addColumn('approvers', function($employee_infos) use ($approver, $supervisor_id){
            $result = '';
            switch ($employee_infos->cash_advance_details->status)
            {
                case 8:
                    {
                        if ($employee_infos->supervisor_approver == null){

                        }else{
                            $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->supervisor_approver->emp_name.'</span>';
                            $result .= '<br>';
                            $result .= '<strong>Remark:</strong> <br>'.$employee_infos->supervisor_remark.'';
                            $result .= '<br>';
                            $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->supervisor_date_time.'';
                            $result .= '<br>';
                        }
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';

                        if ($employee_infos->president_approver == null){

                        }else {
                            $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                            $result .= '<br>';
                        }
                        break;
                    }

                case 9:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->section_head_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->section_head_date_time.'';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 10:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';

                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->department_head_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->department_head_date_time.'';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 11:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->cashier_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->cashier_date_time.'';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 12;
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->treasury_head_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->treasury_head_date_time.'';
                    
                    $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 13:
                {
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';

                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->treasury_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span>';
                    $result .= '<br>';
                    $result .= '<strong>Remark:</strong> <br>'.$employee_infos->finance_general_manager_remark.'';
                    $result .= '<br>';
                    $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->finance_general_manager_date_time.'';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-light"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                    }
                    break;
                }

                case 14:
                {
                    if ($employee_infos->supervisor_approver == null){

                    
                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span> <br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.' ';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.' ';
                    $result .= '<br>';

                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->treasury_head_date_time.' ';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span> <br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->finance_general_manager_date_time.' ';
                    $result .= '<br>';

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-danger"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= '<br>';
                        $result .= '<strong>Remark:</strong> <br>'.$employee_infos->president_remark.'';
                        $result .= '<br>';
                        $result .= '<strong>Disapproved:</strong> <br>'.$employee_infos->president_date_time.'';
                    }
                    break;
                }

            }
            return $result;
        })

        ->addColumn('action', function($employee_infos) use ($rapidx_user_id, $approver, $edit_button, $rapidx_username, $get_supervisor_approver) {
            $result = "";
            $result = '<center>';

            $result .= "<a href='view_pdf/". $employee_infos->id . "' target='_blank'>
                        <button type='button' class='btn btn-outline-primary btn-sm fa fa-eye text-center actionViewCashAdvance' style='width:105px;margin:2%' cash_advance-id='" . $employee_infos->id . "' data-toggle='modal' data-target='#pdfViewCashAdvance' data-keyboard='false'> View</button>
                        </a>";
            $result .= '<br>';

            if(count($edit_button) != 0){
                $result .= '<button type="button" class="btn btn-outline-dark btn-sm fa fa-edit text-center actionEditCashAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" data-toggle="modal" data-target="#modalEditCashAdvance" data-keyboard="false"> Edit</button>';
                $result .= '<br>';
            }else{

            }

            if(count($approver) == 0){

                // switch ($employee_infos->cash_advance_details->status)
                // {
                //     case 0:
                //     {
                //         for ($i=0; $i < count($get_supervisor_approver); $i++) {
                //             if($get_supervisor_approver[$i]->supervisor == $rapidx_username && $employee_infos->supervisor == $rapidx_username){
                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="1" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="8" remarks="supervisor_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';
                //             }
                //         }
                //         break;
                //     }
                // }
            }
            else{
                // if( $employee_infos->cash_advance_details->status == 7){
                //     for ($i=0; $i < count($approver); $i++) {
                //         if($approver[$i]->classification == 'Cashier'){
                //             if ($employee_infos->cash_advance_details->date == null){
                //                 $result .= '<button type="button" class="btn btn-outline-dark btn-sm text-center actionDateCashReceived" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateCashReceived" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Date Cash Received </button>';
                //                 $result .= '<br>';
                //             }else{
                //             }

                //             if ($employee_infos->cash_advance_details->date_liquidated == null){
                //                 $result .= '<button type="button" class="btn btn-outline-info btn-sm text-center actionDateLiquidated" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateLiquidated" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Liquidate </button>';
                //                 $result .= '<br>';
                //             }else{
                //             }
                //         }
                //     }
                // }

                
                // switch ($employee_infos->cash_advance_details->status)
                // {
                //     case 0:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($get_supervisor_approver[$i]->supervisor == $rapidx_username && $employee_infos->supervisor == $rapidx_username){
                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="1" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="8" remarks="supervisor_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';
                //             }
                //         }
                //         break;
                //     }

                //     case 1:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($approver[$i]->classification == 'Section Head' && $employee_infos->section_head == $rapidx_user_id){
                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="2" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="9" remarks="section_head_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';
                //             }
                //         }
                //         break;
                //     }

                //     case 2:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($approver[$i]->classification == 'Department Head' && $employee_infos->department_head == $rapidx_user_id){
                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="3" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="10" remarks="department_head_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';
                //             }
                //         }
                //         break;
                //     }

                //     case 3:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($approver[$i]->classification == 'Cashier' && $employee_infos->cashier == $rapidx_user_id){
                //                 $result .= '<button type="button" class="btn btn-outline-info btn-sm fa fa-edit text-center actionPreviousAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" remarks="previous_advance" data-target="#modalPreviousAdvance" data-keyboard="false">  Previous Advance</button>';
                //                 $result .= '<br>';

                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="4" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="11" remarks="cashier_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';
                //             }
                //         }
                //         break;
                //     }

                //     case 4:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($approver[$i]->classification == 'Treasury Head' && $employee_infos->treasury_head == $rapidx_user_id){
                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="5" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="12" remarks="treasury_head_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';

                //                 if ($employee_infos->president == null){
                //                     $result .= '<button type="button" class="btn btn-outline-info btn-sm fas fa-id-badge text-center actionAddPresident" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="" data-toggle="modal" data-target="#modalAddPresident" data-keyboard="false">  Add President</button>';
                //                     $result .= '<br>';
                //                 }else{
                //                 }
                //             }
                //         }
                //         break;
                //     }

                //     case 5:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($approver[$i]->classification == 'Finance General Manager' && $employee_infos->finance_general_manager == $rapidx_user_id){
                //                 if ($employee_infos->president == null ){
                //                     $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="7" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                     $result .= '<br>';
                //                     $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="13" remarks="finance_general_manager_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                     $result .= '<br>';
                //                     $result .= '<button type="button" class="btn btn-outline-info btn-sm fas fa-id-badge text-center actionAddPresident" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="" data-toggle="modal" data-target="#modalAddPresident" data-keyboard="false">  Add President</button>';
                //                     $result .= '<br>';
                //                 }
                //                 else{
                //                     $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="6" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                     $result .= '<br>';
                //                     $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="13" remarks="finance_general_manager_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                     $result .= '<br>';
                //                 }
                //             }
                //         }
                //         break;
                //     }

                //     case 6:
                //     {
                //         for ($i=0; $i < count($approver); $i++) {
                //             if($approver[$i]->classification == 'President' && $employee_infos->president == $rapidx_user_id){
                //                 $result .= '<button type="button" class="btn btn-outline-success btn-sm fa fa-thumbs-up text-center actionApproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="7" data-toggle="modal" data-target="#modalApproveRemark" data-keyboard="false">  Approve</button>';
                //                 $result .= '<br>';
                //                 $result .= '<button type="button" class="btn btn-outline-danger btn-sm fa fa-thumbs-down text-center actionDisapproveRemark" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" status="14" remarks="president_remark" data-toggle="modal" data-target="#modalDisapproveRemark" data-keyboard="false">  Disapprove</button>';
                //                 $result .= '<br>';
                //             }
                //         }
                //         break;
                //     }
                // }
            }

            $result .= '</center>';
            return $result;
        })

        ->rawColumns(['status', 'action', 'uploaded_file', 'approvers'])
        ->make(true);
    }

    //============================== VIEW CASH ADVANCE LIQUIDATED ==============================
    public function view_cash_advance_liquidated(Request $request){
        /*
            TODO: Add this another (where clause) if I had Session
            *ex. ->where('employee_no', 'Q113')
        */
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];
        $supervisor_id = SystemOneSupervisor::where('username', $rapidx_username)->get();

        $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])
        ->where('user_id', $rapidx_user_id)
        ->orWhere('supervisor', $rapidx_username)
        ->orWhere('section_head', $rapidx_user_id )
        ->orWhere('section_head_remark', $rapidx_user_id )
        ->orWhere('department_head', $rapidx_user_id )
        ->orWhere('department_head_remark', $rapidx_user_id )
        ->orWhere('cashier', $rapidx_user_id )
        ->orWhere('cashier_remark', $rapidx_user_id )
        ->orWhere('treasury_head', $rapidx_user_id )
        ->orWhere('treasury_head_remark', $rapidx_user_id )
        ->orWhere('finance_general_manager', $rapidx_user_id )
        ->orWhere('finance_general_manager_remark', $rapidx_user_id )
        ->orWhere('president', $rapidx_user_id )
        ->orWhere('president_remark', $rapidx_user_id )
        ->get();

        if($rapidx_username == 'gbcuevas' || $rapidx_username == 'sdcastillo'  || $rapidx_username == 'cbretusto'){
            $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])->get();
        }

        $employee_infos = collect($employee_infos)->where('logdel', 0);
        $employee_infos = collect($employee_infos)->where('cash_advance_details.status', 7)->where('cash_advance_details.date_liquidated', '!=', null);
        
        $approver = UserApprover::where('rapidx_id', $rapidx_user_id)->where('status', 1)->get();
        $get_supervisor_approver = ApproverEmailRecipient::where('supervisor', $rapidx_username)->get();
        $edit_button = ApproverEmailRecipient::where('user_id', $rapidx_user_id)->get('user_id');
		return DataTables::of($employee_infos)

		->addColumn('status', function($employee_info) {
			$result = "";
			$result = '<center>';
			if($employee_info->cash_advance_details->status == 7){
				$result .= '<span class="badge badge-pill badge-success">APPROVED</span>';
                $result .= '<br>';
                if($employee_info->cash_advance_details->status == 7 && $employee_info->cash_advance_details->date_liquidated != null){
                    $result .= '<span class="badge badge-pill badge-success">LIQUIDATED</span>';
                    $result .= '<br>';    
                }
			}
			$result .= '</center>';
			return $result;
		})

        ->addColumn('uploaded_file', function($employee_infos) {
			$result = "";
            $result = '<center>';
            if ($employee_infos->cash_advance_details->uploaded_file_status == 1){
                $result .= "<a href='download_file/".$employee_infos->cash_advance_details->id."'> See Attachment</a>";
            }else{
                $result .= '<span class="badge badge-pill badge-dark">No File Uploaded</span>';
            }
            $result .= '</center>';
			return $result;
		})

        ->addColumn('approvers', function($employee_infos) use ($approver, $supervisor_id){
            $result = '';
            if ($employee_infos->cash_advance_details->status == 7){
                    if ($employee_infos->supervisor_approver == null){

                    }else{
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->supervisor_approver->emp_name.'</span><br><strong>Approved:</strong> <br>';
                        $result .= ' '.$employee_infos->supervisor_date_time.'';
                        $result .= '<br>';
                    }
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->sect_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->section_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->dept_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->department_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->cashier_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->cashier_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->treasury_head_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->treasury_head_date_time.'';
                    $result .= '<br>';
                    
                    $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->finance_general_manager_approver->rapidx_user_details->name.'</span><br><strong>Approved:</strong> <br>';
                    $result .= ' '.$employee_infos->finance_general_manager_date_time.'';
                    $result .= '<br>';
    

                    if ($employee_infos->president_approver == null){

                    }else {
                        $result .= '<span class="badge badge-pill badge-success"> '.$employee_infos->president_approver->rapidx_user_details->name.'</span>';
                        $result .= ' '.$employee_infos->president_date_time.'';
                        $result .= '<br>';
                    }
                }
	        return $result;
        })

		->addColumn('action', function($employee_infos) use ($rapidx_user_id, $approver, $edit_button, $rapidx_username, $get_supervisor_approver) {
            $result = "";
            $result = '<center>';

            $result .= "<a href='view_pdf/". $employee_infos->id . "' target='_blank'>
                        <button type='button' class='btn btn-outline-primary btn-sm fa fa-eye text-center actionViewCashAdvance' style='width:105px;margin:2%' cash_advance-id='" . $employee_infos->id . "' data-toggle='modal' data-target='#pdfViewCashAdvance' data-keyboard='false'> View</button>
                        </a>";
            $result .= '<br>';

            // if(count($edit_button) != 0){
            //     $result .= '<button type="button" class="btn btn-outline-dark btn-sm fa fa-edit text-center actionEditCashAdvance" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '" data-toggle="modal" data-target="#modalEditCashAdvance" data-keyboard="false"> Edit</button>';
            //     $result .= '<br>';
            // }else{

            // }

            if(count($approver) == 0){


            }
            else{
                // if( $employee_infos->cash_advance_details->status == 7){
                //     for ($i=0; $i < count($approver); $i++) {
                //         if($approver[$i]->classification == 'Cashier'){
                //             if ($employee_infos->cash_advance_details->date == null){
                //                 $result .= '<button type="button" class="btn btn-outline-dark btn-sm text-center actionDateCashReceived" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateCashReceived" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Date Cash Received </button>';
                //                 $result .= '<br>';
                //             }else{
                //             }

                //             if ($employee_infos->cash_advance_details->date_liquidated == null){
                //                 $result .= '<button type="button" class="btn btn-outline-info btn-sm text-center actionDateLiquidated" style="width:105px;margin:2%;" cash_advance-id="' . $employee_infos->id . '"data-toggle="modal" data-target=" #modalDateLiquidated" data-keyboard="false"> <i class="fas fa-calendar-check"></i>  Liquidate </button>';
                //                 $result .= '<br>';
                //             }else{
                //             }
                //         }
                //     }
                // }
            }

            $result .= '</center>';
            return $result;
        })

		->rawColumns(['status', 'action', 'uploaded_file', 'approvers'])
		->make(true);
	}

    //============================== ADD CASH ADVANCE ==============================
    public function add_cash_advance(Request $request){
        date_default_timezone_set('Asia/Manila');

        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];

        $check_status = $request->supervisor;
        if ($check_status != null){
            $supervisor_status = '0';
        }else{
            $supervisor_status = '1';
        }

        $get_email = ApproverEmailRecipient::with('supervisor_approver')->where('supervisor',$rapidx_username)->get();
        // return $get_email[0]->supervisor ;
        // return $get_email[0]->supervisor_approver->email_add;
        // exit(0);

        // $data = array();
        $data = $request->all();
        // return $data;
        $rules = [
            'ca_no'                 => 'required|string|max:255',
            'date_applied'          => 'required|string|max:255',
            'employee_no'           => 'required|string|max:255',
            'mode_of_payment'       => 'required|string|max:255',
            'local_no'              => 'required|string|max:255',
            'amount_of_ca'          => 'required|string|max:255',
            'sect_head'             => 'required|string|max:255',
            'dept_head'             => 'required|string|max:255',
            'payment_released_by'   => 'required|string|max:255',
            'purpose'               => 'required|string|max:255',
            'requested_by'          => 'required|string|max:255',
            'treasury_head'         => 'required|string|max:255',
            'fin_gen_manager'       => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                if(isset($request->uploaded_file)){
                    // get original file name
                    $original_filename = $request->file('uploaded_file')->getClientOriginalName();
                    Storage::putFileAs('public/CashAdvanceUploadedFile', $request->uploaded_file,  $original_filename);
                    $upaloaded_status = 1;
                }else{
                    $original_filename = 'N/A';
                    $upaloaded_status = 2;
                }

                $ca_info = OnlineCashAdvance::where('ca_no', $request->ca_no)->where('logdel', 0)->get();
                if(count($ca_info) != 1){
                    $ca_id = OnlineCashAdvance::insertGetId([
                        'status'              => $supervisor_status,
                        'ca_no'               => $request->ca_no,
                        'date_applied'        => $request->date_applied,
                        'date_of_liquidation' => $request->date_of_liquidation,
                        'employee_no'         => $request->employee_no,
                        'mode_of_payment'     => $request->mode_of_payment,
                        'applicant_name'      => $request->applicant_name,
                        'payroll_account_no'  => $request->payroll_account_no,
                        'position'            => $request->position,
                        'gcash_account_no'    => $request->gcash_account_no,
                        'official_station'    => $request->official_station,
                        'local_no'            => $request->local_no,
                        'amount_of_ca'        => $request->amount_of_ca,
                        'amount_of_ca_currency' =>$request->amount_of_ca_currency,
                        'ca_convert_to_word'  => $request->ca_convert_to_word,
                        'purpose'             => $request->purpose,
                        'requested_by'        => $request->requested_by,
                        'uploaded_file'       => $original_filename,
                        'uploaded_file_status' => $upaloaded_status,
                        'previous_advance'    => $request->previous_advance,
                        'date'                => $request->date,
                        'created_at'          => date('Y-m-d H:i:s')
                    ]);
    
                    ApproverEmailRecipient::insert([
                        'ca_id'                   => $ca_id,
                        'user_id'                 => $rapidx_user_id,
                        'supervisor'              => $request->supervisor,
                        'section_head'            => $request->sect_head,
                        'department_head'         => $request->dept_head,
                        'cashier'                 => $request->payment_released_by,
                        'treasury_head'           => $request->treasury_head,
                        'finance_general_manager' => $request->fin_gen_manager,
                        'president'               => $request->president,
                        'created_at'              => date('Y-m-d H:i:s')
                    ]);

                    if ($request->supervisor != ""){
                        $send_email = $request->supervisor;
                        $send_email_to_ca_owner = $rapidx_user_id;
                        $get_email = ApproverEmailRecipient::with('supervisor_approver')->where('supervisor',$send_email)->first();
                        $for_approval = OnlineCashAdvance::with(['approver_email_recipients',])->get();
                        $get_data = ['data' => $data];
                        $recipients = SystemOneSupervisor::where('email_add', $get_email->supervisor_approver->email_add)->get();
                        $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();
    
                        Mail::send('mail.cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                            $message->to($recipients[0]->email_add)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                        });
                    }
                    else{
                        $send_email = $request->sect_head;
                        $send_email_to_ca_owner = $rapidx_user_id;
                        $for_approval = OnlineCashAdvance::with(['approver_email_recipients',])->get();
                        $get_data = ['data' => $data];
                        $recipients = RapidXUser::where('id', $send_email)->get();
                        $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();
    
                        Mail::send('mail.cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                            $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                        });
                    }
                }else{
                    return response()->json(['result' => "0"]);
                }
                
                DB::commit();
                return response()->json(['result' => "1"]);
            }
            catch(\Exception $e) {
                DB::rollback();
                return response()->json(['result' => $e]);
            } 
            
        }
    }
    //=====
    // public function get_user(){ 
    //     $rapidx_user_id = ApproverEmailRecipient::all();
    //     return $rapidx_user_id;

    //     // return response()->json(['get_noted_by_treasury_head' => $get_noted_by_treasury_head]);
    // }

    //=====================================
    public function get_noted_by(Request $request){ 
        $get_noted_by_treasury_head = UserApprover::where('classification', 'Treasury Head')->where(function($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'desc' )->get();

        $get_noted_by_finance_general_manager = UserApprover::where('classification', 'Finance General Manager')->where(function($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'desc' )->get();

        $get_payment_released_by_cashier = UserApprover::where('classification', 'Cashier')->where(function($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'desc' )->get();

        // return $get_noted_by_cashier;
        return response()->json(['get_noted_by_treasury_head' => $get_noted_by_treasury_head, 'get_noted_by_finance_general_manager' => $get_noted_by_finance_general_manager, 'get_payment_released_by_cashier' => $get_payment_released_by_cashier]);
    }

    //=====================================
    public function get_president(Request $request){ 
        $get_president = UserApprover::with(['rapidx_user_details'])->where('classification', 'President')->where(function($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'desc' )->get();

        // return $get_president;
        return response()->json(['get_president' => $get_president]);
    }

    // ============================== CASH ADVANCE GET LOCAL NO. ==============================
    public function get_local_no(){
        $phone_dir = SystemOnePhoneDirectory::where('category', 1)
        ->where('logdel',0)
        ->get();
        // return $phone_dir;
        return response()->json(['phone_dir' => $phone_dir]);
    }

    // ============================== CASH ADVANCE FETCH DATA ==============================
    public function get_employee_info(Request $request){
        $data = SystemOneHRIS::with(['department_info', 'section_info', 'position_info'])->where('EmpNo', $request->emp_no)->first();
        // json_encode($data);
        // dd($data->Lastname);
        return response()->json(['data' => $data]);
    }

    // ========================================= EDIT CASH ADVANCE ===================================================
    public function edit_cash_advance(Request $request){
        date_default_timezone_set('Asia/Manila');

        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];

        $check_status = $request->supervisor;
        if ($check_status != null){
            $supervisor_status = '0';
        }else{
            $supervisor_status = '1';
        }

        $data = $request->all();
        $rules = [
            'ca_no'                 => 'required|string|max:255',
            'date_applied'          => 'required|string|max:255',
            'employee_no'           => 'required|string|max:255',
            'mode_of_payment'       => 'required|string|max:255',
            'local_no'              => 'required|string|max:255',
            'amount_of_ca'          => 'required|string|max:255',
            'sect_head'             => 'required|string|max:255',
            'dept_head'             => 'required|string|max:255',
            'payment_released_by'   => 'required|string|max:255',
            'purpose'               => 'required|string|max:255',
            'requested_by'          => 'required|string|max:255',
            'treasury_head'         => 'required|string|max:255',
            'fin_gen_manager'       => 'required|string|max:255',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['validation' => 'hasError', 'error' => $validator->messages()]);
        }
        else{
            DB::beginTransaction();
            try{
                if(isset($request->uploaded_file)){
                    // get original file name
                    $original_filename = $request->file('uploaded_file')->getClientOriginalName();
                    Storage::putFileAs('public/CashAdvanceUploadedFile', $request->uploaded_file,  $original_filename);
                    $upaloaded_status = 1;
                }else{
                    $original_filename = 'N/A';
                    $upaloaded_status = 2;
                }

                $ca_id = OnlineCashAdvance::where('id', $request->cash_advance_id)->update([
                    'status'                => $supervisor_status,
                    'ca_no'                 => $request->ca_no,
                    'date_applied'          => $request->date_applied,
                    'date_of_liquidation'   => $request->date_of_liquidation,
                    'employee_no'           => $request->employee_no,
                    'mode_of_payment'       => $request->mode_of_payment,
                    'applicant_name'        => $request->applicant_name,
                    'payroll_account_no'    => $request->payroll_account_no,
                    'position'              => $request->position,
                    'gcash_account_no'      => $request->gcash_account_no,
                    'official_station'      => $request->official_station,
                    'local_no'              => $request->local_no,
                    'amount_of_ca'          => $request->amount_of_ca,
                    'amount_of_ca_currency' => $request->amount_of_ca_currency,
                    'ca_convert_to_word'    => $request->ca_convert_to_word,
                    'purpose'               => $request->purpose,
                    'requested_by'          => $request->requested_by,
                    'uploaded_file'         => $original_filename,
                    'uploaded_file_status'  => $upaloaded_status,
                    'previous_advance'      => $request->previous_advance,
                    'date'                  => $request->date,
                    'updated_at'            => date('Y-m-d H:i:s'),
                ]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)->update([
                    'user_id'                 => $rapidx_user_id,
                    'supervisor'              => $request->supervisor,
                    'section_head'            => $request->sect_head,
                    'department_head'         => $request->dept_head,
                    'cashier'                 => $request->payment_released_by,
                    'treasury_head'           => $request->treasury_head,
                    'finance_general_manager' => $request->fin_gen_manager,
                    'president'               => $request->president,
                    'updated_at'              => date('Y-m-d H:i:s'),
                ]);
                DB::commit();
                
                if ($request->supervisor != ""){
                    // CHAN APRIL 12, 2022
                    $send_email = $request->supervisor;
                    $send_email_to_ca_owner = $rapidx_user_id;
                    $get_email = ApproverEmailRecipient::with('supervisor_approver')->where('supervisor',$send_email)->first();

                    $for_approval = OnlineCashAdvance::with(['approver_email_recipients',])->get();
                    $get_data = ['data' => $data];
                    $recipients = SystemOneSupervisor::where('email_add', $get_email->supervisor_approver->email_add)->get();
                    $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                    Mail::send('mail.cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                        $message->to($recipients[0]->email_add)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                    });
                }
                else{
                    $send_email = $request->sect_head;
                    $send_email_to_ca_owner = $rapidx_user_id;
                    $for_approval = OnlineCashAdvance::with(['approver_email_recipients',])->get();
                    $get_data = ['data' => $data];
                    $recipients = RapidXUser::where('id', $send_email)->get();
                    $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                    Mail::send('mail.cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                    });
                }
                return response()->json(['result' => "1"]);
                // }else{
                //     $ca_id = OnlineCashAdvance::where('id', $request->cash_advance_id)->update([
                //         'status'              => $supervisor_status,
                //         'ca_no'               => $request->ca_no,
                //         'date_applied'        => $request->date_applied,
                //         'date_of_liquidation' => $request->date_of_liquidation,
                //         'employee_no'         => $request->employee_no,
                //         'mode_of_payment'     => $request->mode_of_payment,
                //         'applicant_name'      => $request->applicant_name,
                //         'payroll_account_no'  => $request->payroll_account_no,
                //         'position'            => $request->position,
                //         'gcash_account_no'    => $request->gcash_account_no,
                //         'official_station'    => $request->official_station,
                //         'local_no'            => $request->local_no,
                //         'amount_of_ca'        => $request->amount_of_ca,
                //         'amount_of_ca_currency' =>$request->amount_of_ca_currency,
                //         'ca_convert_to_word'  => $request->ca_convert_to_word,
                //         'purpose'             => $request->purpose,
                //         'requested_by'        => $request->requested_by,
                //         'uploaded_file'       => 'N/A',
                //         'uploaded_file_status' => 2, //no file
                //         'previous_advance'    => $request->previous_advance,
                //         'date'                => $request->date,
                //         'updated_at'          => date('Y-m-d H:i:s'),
                //     ]);

                //     ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)->update([
                //         'user_id'                 => $rapidx_user_id,
                //         'supervisor'              => $request->supervisor,
                //         'section_head'            => $request->sect_head,
                //         'department_head'         => $request->dept_head,
                //         'cashier'                 => $request->payment_released_by,
                //         'treasury_head'           => $request->treasury_head,
                //         'finance_general_manager' => $request->fin_gen_manager,
                //         'president'               => $request->president,
                //         'updated_at'              => date('Y-m-d H:i:s'),
                //     ]);
                //     DB::commit();
                //     if ($request->supervisor != ""){
                //         // CHAN APRIL 12, 2022
                //         $send_email = $request->supervisor;
                //         $send_email_to_ca_owner = $rapidx_user_id;
                //         $get_email = ApproverEmailRecipient::with('supervisor_approver')->where('supervisor',$send_email)->first();

                //         $for_approval = OnlineCashAdvance::with(['approver_email_recipients',])->get();
                //         $get_data = ['data' => $data];
                //         $recipients = SystemOneSupervisor::where('email_add', $get_email->supervisor_approver->email_add)->get();
                //         $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                //         Mail::send('mail.cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                //             $message->to($recipients[0]->email_add)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                //         });
                //     }
                //     else{
                //         $send_email = $request->sect_head;
                //         $send_email_to_ca_owner = $rapidx_user_id;
                //         $for_approval = OnlineCashAdvance::with(['approver_email_recipients',])->get();
                //         $get_data = ['data' => $data];
                //         $recipients = RapidXUser::where('id', $send_email)->get();
                //         $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                //         Mail::send('mail.cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                //             $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                //         });
                //     }
                //     return response()->json(['result' => "1"]);
                // }
            }
            catch(\Exception $e) {
                DB::rollback();
                return response()->json(['result' => $e]);
            }
        }
    }

    //============================== GET CASH ADVANCE BY ID TO EDIT ==============================
    public function get_cash_advance_by_id(Request $request){
        $cash_advances = OnlineCashAdvance::where('id', $request->cash_advance_id)->get(); // get all reports where id is equal to the cash_advance-id attribute of the button(Edit)
        $cash_advance_approver = ApproverEmailRecipient::with('cash_advance_details')->where('ca_id', $request->cash_advance_id)->get();
        $cash_advances_supervisor_approver = ApproverEmailRecipient::with('supervisor_approver')->where('ca_id', $request->cash_advance_id)->get();
        // return $cash_advances_supervisor_approver[0]->supervisor_approver->emp_name;

        return response()->json([
            'cash_advance' => $cash_advances, 
            'cash_advance_approver' => $cash_advance_approver,
            'cash_advances_supervisor_approver' => $cash_advances_supervisor_approver]);  // pass the $cash_advance(variable) to ajax as a response for retrieving and pass the values on the inputs
    }

    //============================== APPROVE BUTTON ==============================
    public function approved_cash_advance(Request $request){        
        date_default_timezone_set('Asia/Manila');

        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'cash_advance_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            OnlineCashAdvance::where('id', $request->cash_advance_id)
            ->update([
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $approve_cash_advance =  OnlineCashAdvance::with('approver_email_recipients')->where('id', $request->cash_advance_id)->get();
            // return $approve_cash_advance;

            // $to_email = ['ctmiranda@pricon@ph'];
            // $cc_email = ['cpagtalunan@pricon.ph'];
            if($approve_cash_advance[0]->status == 1){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'supervisor_date_time' => NOW(),
                ]);

                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->section_head;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;
                // $send_email_to_ca_owner = $rapidx_user_id;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();
                // return $cc_owner;

                Mail::send('mail.send_cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                });
            }

            else if($approve_cash_advance[0]->status == 2){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'section_head_date_time' => NOW(),
                ]);
                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->department_head;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;
                // return $send_email;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();
                // return $get_data;

                Mail::send('mail.send_cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                });
            }
            else if($approve_cash_advance[0]->status == 3){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'department_head_date_time' => NOW(),
                ]);
                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->cashier;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                Mail::send('mail.send_cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                });
            }
            else if($approve_cash_advance[0]->status == 4){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'cashier_date_time' => NOW(),
                ]);
                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->treasury_head;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                Mail::send('mail.send_cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                });
            }
            else if($approve_cash_advance[0]->status == 5){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'treasury_head_date_time' => NOW(),
                ]);
                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->finance_general_manager;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                Mail::send('mail.send_cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                });

            }
            else if($approve_cash_advance[0]->status == 6){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'finance_general_manager_date_time' => NOW(),
                ]);
                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->president;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                Mail::send('mail.send_cash_advance_approval_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('For Approval in Online Cash Advance');
                });
            }
            else if($approve_cash_advance[0]->status == 7){
                if($approve_cash_advance[0]->approver_email_recipients[0]->president != null){
                    ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                    ->update([
                        'president_date_time' => NOW(),
                    ]);
                }else{
                    ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                    ->update([
                        'finance_general_manager_date_time' => NOW(),
                    ]);
                }
                $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;
                $send_email_to_ca_owner = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                $get_data = ['data' => $approve_cash_advance];

                $recipients = RapidXUser::where('id', $send_email)->get();
                $cc_owner = RapidXUser::where('id', $send_email_to_ca_owner)->get();

                Mail::send('mail.cash_advance_approved_mail', $get_data, function($message) use($recipients, $cc_owner){
                    $message->to($recipients[0]->email)->cc($cc_owner[0]->email)->bcc('cbretusto@pricon.ph')->subject('Approved Online Cash Advance');
                });
                Mail::send('mail.account_payable_mail', $get_data, function($message) use($recipients){
                    $message->to('nsnambayan@pricon.ph')->cc('eanejal@pricon.ph')->cc('gbcuevas@pricon.ph')->bcc('cbretusto@pricon.ph')->subject('Accounts Payable in Online Cash Advance');
                });

                // return $send_email;
                // exit(0);
            }

            // Mail::send('mail.account_payable_mail', $get_data, function($message) use($recipients){
            //     $message->to('assanbuenaventura@pricon.ph')->cc('eanejal@pricon.ph')->cc('gbcuevas@pricon.ph')->bcc('cbretusto@pricon.ph')->subject('Accounts Payable in Online Cash Advance');
            // });

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }


    //============================== DISAPPROVED BUTTON ==============================
    public function disapproved_cash_advance(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'cash_advance_id' => 'required',
            'status'          => 'required',
        ]);

        $arr_disapproved = [
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if($validator->passes()){

            $approve_cash_advance =  OnlineCashAdvance::with('approver_email_recipients')->where('id', $request->cash_advance_id)->get();
            // return $approve_cash_advance;

            if($request->classification_remarks == 'supervisor_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update(['supervisor_remark' => $request->disapprove_remarks]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'supervisor_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 0){
                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;
                    // return $send_email;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();
                    // return $get_data;

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }

            else if($request->classification_remarks == 'section_head_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update(['section_head_remark' => $request->disapprove_remarks]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'section_head_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 1){

                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;
                    // return $send_email;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();
                    // return $get_data;

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }

            elseif($request->classification_remarks == 'department_head_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update(['department_head_remark' => $request->disapprove_remarks]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'department_head_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 2){

                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }

            elseif($request->classification_remarks == 'cashier_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update(['cashier_remark' => $request->disapprove_remarks]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'cashier_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 3){

                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }

            elseif($request->classification_remarks == 'treasury_head_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update(['treasury_head_remark' => $request->disapprove_remarks]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'treasury_head_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 4){

                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }

            elseif($request->classification_remarks == 'finance_general_manager_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)->update([
                    'finance_general_manager_remark' => $request->disapprove_remarks]);
                
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'finance_general_manager_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 5){

                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }
            elseif($request->classification_remarks == 'president_remark'){
                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)->update([
                    'president_remark' => $request->disapprove_remarks]);

                ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
                ->update([
                    'president_date_time' => NOW(),
                ]);
                if($approve_cash_advance[0]->status == 6){

                    $send_email = $approve_cash_advance[0]->approver_email_recipients[0]->user_id;

                    $get_data = ['data' => $approve_cash_advance];

                    $recipients = RapidXUser::where('id', $send_email)->get();

                    Mail::send('mail.cash_advance_disapproved_mail', $get_data, function($message) use($recipients){
                        $message->to($recipients[0]->email)->bcc('cbretusto@pricon.ph')->subject('Disapproved Online Cash Advance');
                    });
                }
            }

            OnlineCashAdvance::where('id', $request->cash_advance_id)
            ->update(
                $arr_disapproved
            );

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }
    
    //============================== GET PRESIDENT ID ==============================
    public function get_president_id(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $president = UserApprover::where('classification', 'President')->where('status', 1)->get();
        // return $president;

        return response()->json(['president' => $president]);
    }

    //============================== ADD PRESIDENT BUTTON ==============================
    public function add_president(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'president_id' => 'required',
        ]);

        if($validator->passes()){
            ApproverEmailRecipient::where('id', $request->cash_advance_id)
            ->update([
                'president' => $request->president_id,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['result' => "1"]);
             // result = 1, so pagchineck sa success sa ajax/js, pwede natin to gamitin sa condition ng if else
             // kaya nagcecreate non as variable, para lang pangcheck if tama so magshoshow tayo ng success message
            /*
                Sample:

                if(response['result'] == 1){
                    toastr.success('Already Approved');
                }
             */
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
            /*
                Sample:

                if(response['validation'] == 'hasError'){
                    toastr.error('Not Approved');
                }
             */
        }
    }

    //============================== AUTO GENERATE CASH ADVANCE NO. ==============================
    public function get_ca_no_records(Request $request){
        date_default_timezone_set('Asia/Manila');

        $var = OnlineCashAdvance::orderBy('id', 'desc')->first();
        $ca_no1 = $var->ca_no;

        if ($request->currency == 'Pesos'){
            if ($request->ca_auto_generate > 10000){
                // $var = OnlineCashAdvance::where('amount_of_ca', '>', 10000)
                //->orderBy('id', 'desc')->first(); //OLD QUERY

                if ($var == null){
                    $ca_no = '3995'; //Last CA No. before implement the Cash Advance System
                }else{
                    $ca_no = intval($ca_no1) + 1;
                }
            }
        }
        else{
            // $var = OnlineCashAdvance::orderBy('id', 'desc')->first(); //OLD QUERY
            if ($var == null){
                $ca_no = '3995'; //Last CA No. before implement the Cash Advance System
            }else{
                $ca_no = intval($ca_no1) + 1;
            }
        }
        return response()->json(['result' => 1,  'cash_advance_ca_no' => $ca_no, 'ca_auto_generate' => $request->ca_auto_generate, 'currency' => $request->currency]);   
    }
        // ==================================================================================
        // if ($request->ca_auto_generate > 9999){
        //     $var = OnlineCashAdvance::where('amount_of_ca', '>', 9999)
        //     ->orderBy('id', 'desc')->first();
        //     if ($var == null){
        //         $ca_no = '3995';
        //         // return $ca_no;
        //     }else{
        //         $ca_no1 = $var->ca_no;
        //         $ca_no = intval($ca_no1) + 1;
        //         // return $ca_no;
        //     }
        // }

        // else if($request->ca_auto_generate < 10000){
        //     $var1 = OnlineCashAdvance::where('amount_of_ca', '<',10000)
        //     ->orderBy('id', 'desc')->first();
        //     if ($var1 == null){
        //         $ca_no = '21-X264';
        //     }else{
        //         $ca_no1 = $var1->ca_no;

        //         $number = explode('-',$ca_no1);
        //         /*
        //             after explode, transform to this
        //             eto yung SAMPLE VALUES = 21-X264
        //             nung inexplode ganito nangyari ginawang array, $number = [21, 'X264']
        //         */
        //         $arr = preg_split('/(?<=[A-Z])(?=[0-9]+)/i', $number[1]); // ang value netong pinasa natin which is the $number[1] ay X264
        //         /*
        //             dito inallowed na dapat a-z lang pwede at 0-9 na numbers
        //             since ang value ng variable na $arr ay X264
        //         */                                                            
        //         $ca_no = intval($arr[1]) + 1; // dito sinelect lang ay yung 2 sa may X264 na values hanggang dulo so 264 tapos tsaka nag + 1 so ganito yung magiging output = 265

        //         $ca_no =  $year  . "-" . $arr[0] . str_pad($ca_no, 3, STR_PAD_LEFT);
        //         /* 
                //     so si variable na $ca_no ay hawak ang value na 265 
                //     so yung variable na $year ay yung year ngayon which is 21, tapos ni-combine yung "-" so ang value ni $ca_no = 21-
                //     so yung sunod ay $arr[0] ay may hawak na value na X so ngayon eto na 21-X
                //     so sunod ang ginawa sa str_pad($ca_no = 265, kaya 3 dahil eto yung haba tatlo, start sa left to the rest) 
                //     so eto na sya = 21-X265
                // */ 
        //     }
        // }
            // return response()->json(['result' => 1, 'cash_advance_ca_no' => $ca_no]);   
        // return $ca_no; 
        //==========================================================================================================================  

    //============================== ADD PREVIOUS ADVANCE ==============================
    public function cashier_previous_advance(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'cash_advance_id' => 'required',
        ]);

        if($validator->passes()){

            // $approve_cash_advance =  OnlineCashAdvance::where('id', $request->cash_advance_id)->get();

            // return $approve_cash_advance;

            // if($request->previous_advance_remarks == 'previous_advance'){
                OnlineCashAdvance::where('id', $request->cash_advance_id)
                ->update(['previous_advance' => $request->previous_advance]);
            // }

            return response()->json(['result' => "1"]);
        }
        else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    // ============================== GET PREVIOUS ADVANCE TO EDIT==============================
    public function get_previous_advance(Request $request){
        $get_previous_advance =  OnlineCashAdvance::where('id', $request->cash_advance_id)->get();
        return response()->json(['get_previous_advance' => $get_previous_advance]);
        // return $get_previous_advance;
    }

    //============================== DATE CASH RECEIVED ==============================
    public function date_cash_received(Request $request){        
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'cash_advance_id' => 'required',
        ]);

        if($validator->passes()){
            OnlineCashAdvance::where('id', $request->cash_advance_id)
            ->update(['date' => $request->date]);

            return response()->json(['result' => "1"]);
        }else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    //====================================== DOWNLOAD FILE ======================================
    public function download_file(Request $request, $id){
        $employee_infos = ApproverEmailRecipient::with('cash_advance_details')->where('id', $id)->first();
        $file =  storage_path() . "/app/public/CashAdvanceUploadedFile/" . $employee_infos->cash_advance_details->uploaded_file;
        // return $employee_infos;
        return Response::download($file, $employee_infos->cash_advance_details->uploaded_file);  
    }

    //====================================== AUTO ADD RESQUESTOR ======================================
    public function get_rapidx_user(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_user = RapidXUser::where('id', $rapidx_user_id)->get();
        // return $get_user;
        return response()->json(["get_user" => $get_user]);
    }

    //====================================== GET PAYROLL NUMBER ======================================
    public function get_payroll_account_by_user(Request $request){

        $payroll_account = PayrollAccountNo::where('emp_no', $request->emp_no)->where('logdel', 0)->get();
        // $payroll_account = PayrollAccountNo::all();
        // return $payroll_account;
        return response()->json(["payroll_account" => $payroll_account]);
    }

    //============================== DATE CASH RECEIVED ==============================
    public function date_liquidated(Request $request){
        date_default_timezone_set('Asia/Manila');

        $data = $request->all(); // collect all input fields

        $validator = Validator::make($data, [
            'cash_advance_id' => 'required',
        ]);

        if($validator->passes()){
            OnlineCashAdvance::where('id', $request->cash_advance_id)
            ->update(['date_liquidated' => $request->date_liquidated]);

            return response()->json(['result' => "1"]);
        }else{
            return response()->json(['validation' => "hasError", 'error' => $validator->messages()]);
        }
    }

    // ==========================================================================================================
    public function view_cash_advance_canceled(Request $request){
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $rapidx_username = $_SESSION['rapidx_username'];
        // $rapidx_employee_no = $_SESSION['rapidx_employee_no'];
        // return $rapidx_employee_no;
        $supervisor_id = SystemOneSupervisor::where('username', $rapidx_username)->get();

        $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])
        ->where('user_id', $rapidx_user_id)
        ->orWhere('supervisor', $rapidx_username)
        ->orWhere('section_head', $rapidx_user_id )
        ->orWhere('section_head_remark', $rapidx_user_id )
        ->orWhere('department_head', $rapidx_user_id )
        ->orWhere('department_head_remark', $rapidx_user_id )
        ->orWhere('cashier', $rapidx_user_id )
        ->orWhere('cashier_remark', $rapidx_user_id )
        ->orWhere('treasury_head', $rapidx_user_id )
        ->orWhere('treasury_head_remark', $rapidx_user_id )
        ->orWhere('finance_general_manager', $rapidx_user_id )
        ->orWhere('finance_general_manager_remark', $rapidx_user_id )
        ->orWhere('president', $rapidx_user_id )
        ->orWhere('president_remark', $rapidx_user_id )
        ->get();

        if($rapidx_username == 'gbcuevas' || $rapidx_username == 'sdcastillo'  || $rapidx_username == 'cbretusto'){
            $employee_infos = ApproverEmailRecipient::with(['cash_advance_details'])->get();
        }

        $employee_infos = collect($employee_infos)->where('logdel', 0);
        // $employee_infos = collect($employee_infos)->where('cash_advance_details.status', 7)->where('cash_advance_details.date_liquidated', '==', null);
        $employee_infos = collect($employee_infos)->where('cash_advance_details.status', 15);
        
        $approver = UserApprover::where('rapidx_id', $rapidx_user_id)->where('status', 1)->get();
        $get_supervisor_approver = ApproverEmailRecipient::where('supervisor', $rapidx_username)->get();
        $edit_button = ApproverEmailRecipient::where('user_id', $rapidx_user_id)->get('user_id');
		return DataTables::of($employee_infos)

		->addColumn('status', function($employee_info) {
			$result = "";
			$result = '<center>';
			if($employee_info->cash_advance_details->status == 15){
				$result .= '<span class="badge badge-pill badge-danger">CANCELLED</span>';
                $result .= '<br>';
			}
			$result .= '</center>';
			return $result;
		})

        ->addColumn('uploaded_file', function($employee_infos) {
			$result = "";
            $result = '<center>';
            if ($employee_infos->cash_advance_details->uploaded_file_status == 1){
                $result .= "<a href='download_file/".$employee_infos->cash_advance_details->id."'> See Attachment</a>";
            }else{
                $result .= '<span class="badge badge-pill badge-dark">No File Uploaded</span>';
            }
            $result .= '</center>';
			return $result;
		})

		->addColumn('action', function($employee_infos) use ($rapidx_user_id, $approver, $edit_button, $rapidx_username, $get_supervisor_approver) {
            $result = "";
            $result = '<center>';

            $result .= "<a href='view_pdf/". $employee_infos->id . "' target='_blank'>
                        <button type='button' class='btn btn-outline-primary btn-sm fa fa-eye text-center actionViewCashAdvance' style='width:105px;margin:2%' cash_advance-id='" . $employee_infos->id . "' data-toggle='modal' data-target='#pdfViewCashAdvance' data-keyboard='false'> View</button>
                        </a>";
            $result .= '<br>';
            $result .= '</center>';
            return $result;
        })

		->rawColumns(['status', 'action', 'uploaded_file'])
		->make(true);
    }

    public function cancel_cash_advance(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        $data = $request->all();
        OnlineCashAdvance::where('id', $request->cash_advance_id)
        ->update([
            'status' => 15
        ]);
        ApproverEmailRecipient::where('ca_id', $request->cash_advance_id)
        ->update([
            'cashier_remark' => $request->cancel_remarks
        ]);

        return response()->json(['result' => 1]);
    }

    public function get_user_log(Request $request){
        $user_log = RapidXUser::with(['rapidx_user_access_details'])
        ->where('id', $request->loginUserId)
        ->where('user_stat', 1)
        ->get();
        // return $user_log;
        return response()->json(['result' => count($user_log[0]->rapidx_user_access_details)]);
    }

}


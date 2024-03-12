<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use DOMElement;
use DOMXPath;
use Dompdf\Dompdf;
use Dompdf\Helpers;
use Dompdf\Exception;
use Dompdf\FontMetrics;
use Dompdf\Frame\FrameTree;

// MODEL
use App\ApproverEmailRecipient;
use App\SystemOneSupervisor;
use App\OnlineCashAdvance;
use App\SystemOneHRIS;
use App\UserApprover;
use App\RapidXUser;

class ViewPdfController extends Controller
{
    public function view_pdf($id)
    {
        session_start();
        $rapidx_user_id = $_SESSION['rapidx_user_id'];
        $get_info = OnlineCashAdvance::where('id', $id)->get();
        $get_requestor_esignature = ApproverEmailRecipient::with('requestor_esignature')->where('id', $id)->get();

        $get_approver = ApproverEmailRecipient::with([
            'cash_advance_details',
            'supervisor_approver',
            'sect_head_approver',
            'sect_head_approver.rapidx_user_details',
            'dept_head_approver',
            'dept_head_approver.rapidx_user_details',
            'cashier_approver',
            'cashier_approver.rapidx_user_details',
            'president_approver',
            'president_approver.rapidx_user_details',
            'treasury_head_approver',
            'treasury_head_approver.rapidx_user_details',
            'finance_general_manager_approver',
            'finance_general_manager_approver.rapidx_user_details',
        ])->where('ca_id', $id)->get();

        $get_esignature = ApproverEmailRecipient::with([
            'cash_advance_details',
            'supervisor_approver',
            'sect_head_approver',
            'dept_head_approver',
            'cashier_approver',
            'president_approver',
            'treasury_head_approver',
            'finance_general_manager_approver',
        ])->where('ca_id', $id)->get();

        //Chan April 11, 2022
        $data = [
            'id'                  => $get_info[0]->id,
            'ca_no'               => $get_info[0]->ca_no,
            'date_applied'        => $get_info[0]->date_applied,
            'date_of_liquidation' => $get_info[0]->date_of_liquidation,
            'employee_no'         => $get_info[0]->employee_no,
            'mode_of_payment'     => $get_info[0]->mode_of_payment,
            'applicant_name'      => $get_info[0]->applicant_name,
            'payroll_account_no'  => $get_info[0]->payroll_account_no,
            'position'            => $get_info[0]->position,
            'gcash_account_no'    => $get_info[0]->gcash_account_no,
            'official_station'    => $get_info[0]->official_station,
            'local_no'            => $get_info[0]->local_no,
            'amount_of_ca'        => $get_info[0]->amount_of_ca,
            'ca_convert_to_word'  => $get_info[0]->ca_convert_to_word,
            'purpose'             => $get_info[0]->purpose,
            'requested_by'        => $get_info[0]->requested_by,
            'previous_advance'    => $get_info[0]->previous_advance,
            'date'                => $get_info[0]->date,
            'date_liquidated'     => $get_info[0]->date_liquidated,

            'section_head'              => $get_approver[0]->sect_head_approver->rapidx_user_details->name,
            'department_head'           => $get_approver[0]->dept_head_approver->rapidx_user_details->name,
            'cashier'                   => $get_approver[0]->cashier_approver->rapidx_user_details->name,
            'treasury_head'             => $get_approver[0]->treasury_head_approver->rapidx_user_details->name,
            'finance_general_manager'   => $get_approver[0]->finance_general_manager_approver->rapidx_user_details->name,
        ];

        $e_signature = [
            'section_head'              => $get_esignature[0]->sect_head_approver->employee_no,
            'department_head'           => $get_esignature[0]->dept_head_approver->employee_no,
            'cashier'                   => $get_esignature[0]->cashier_approver->employee_no,
            'treasury_head'             => $get_esignature[0]->treasury_head_approver->employee_no,
            'finance_general_manager'   => $get_esignature[0]->finance_general_manager_approver->employee_no,
        ];

        $requestor_esignature = [
            'user_id'                   => $get_requestor_esignature[0]->requestor_esignature->employee_number,
        ];


        if($get_approver[0]->supervisor == null){
            $data['supervisor'] = $get_approver[0]->supervisor;
            $e_signature['supervisor'] = $get_esignature[0]->supervisor;
        }
        else{
            $data['supervisor']= $get_approver[0]->supervisor_approver->emp_name;
            $e_signature['supervisor'] = $get_esignature[0]->supervisor_approver->EmpNo;
        }
        if($get_approver[0]->president == null){
            $data['president'] = $get_approver[0]->president;
            $e_signature['president'] = $get_esignature[0]->president;
        }
        else{
            $data['president'] = $get_approver[0]->president_approver->rapidx_user_details->name;
            $e_signature['president'] =  $get_esignature[0]->president_approver->employee_no;
        }

        // return $requestor_esignature;
        // $pdf = PDF::loadView('view_cash_advance', $data, $e_signature);
        $pdf = PDF::loadView('view_cash_advance',
            array('data' => $data,
                'get_approver' => $get_approver,
                'get_esignature' => $get_esignature,
                'e_signature' => $e_signature,
                'get_requestor_esignature' => $get_requestor_esignature,
                'requestor_esignature' => $requestor_esignature,
            ));
        $pdf->setPaper('A5', 'Landscape');

        return $pdf->stream();
    }
}

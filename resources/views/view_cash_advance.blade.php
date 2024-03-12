<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Cash Advance</title>
    </head>

    <body>    
        <table style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid; width: 100%; margin-bottom:5px; font-size:64%;">
            <tr>
                <td style="text-align:left;" colspan="5"><strong>PRICON MICROELECTRONICS, INC.</strong></td>    
            </tr>
            <tr>
                <td style="text-align:left;" colspan="5"><strong>REQUEST FOR CASH ADVANCE</strong></td>
            </tr>

            <tr>
                <th width="22%" style=""></th>
                <th width="22%" style=""></th>
                <td width="30%" style="text-align:right;">CA NO.</td>
                <td width="19%" style="border-bottom: 1px solid black;">&nbsp;{{ $data['ca_no']}}</td>
                <th width="6%"></th>
            </tr>

            <tr>
                <td style="text-align:right;">DATE APPLIED:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['date_applied']}}</td>
                <td style="text-align:right;">DATE OF LIQUIDATION:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['date_of_liquidation'] }}</td>
            </tr>

            <tr>
                <td style="text-align:right;">EMPLOYEE NO:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['employee_no'] }}</td>
                <td style="text-align:right;">MODE OF PAYMENT:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['mode_of_payment'] }}</td>
            </tr>

            <tr>
                <td style="text-align:right;">APPLICANT'S NAME:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['applicant_name'] }}</td>
                <td style="text-align:right;">PAYROLL ACCOUNT NO:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['payroll_account_no'] }}</td>
            </tr>

            <tr>
                <td style="text-align:right;">POSITION:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['position'] }}</td>
                <td style="text-align:right;">GCASH ACCOUNT NO:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['gcash_account_no'] }}</td>
            </tr>

            <tr>
                <td style="text-align:right;">OFFICIAL STATION:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['official_station'] }}</td>
                <td style="text-align:right;">LOCAL NUMBER:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['local_no'] }}</td>
            </tr>

            <tr>
                <td style="text-align:right;">AMOUNT OF CA:</td>
                <td style="border-bottom: 1px solid black;">&nbsp;{{ $data['amount_of_ca'] }}</td>
                <td style="border-bottom: 1px solid black;" colspan="2">-&nbsp; {{ $data['ca_convert_to_word'] }}</td>
                <td style=""></td>
            </tr>

            <tr>
                <td style="border-bottom: 1px solid black;" colspan="5">&nbsp;</td>
            </tr>

            <tr>
                <td style="text-align:right; border-bottom: -15px;">PURPOSE:</td>
                <td colspan="3" style="border-bottom: -15px;">&nbsp;{{ $data['purpose'] }}</td>
            </tr>

            <tr>
                <td style="border-bottom: 1px solid black;" colspan="5">&nbsp;</td>
            </tr>

            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>

            <tr >
                <td style=""></td>
                <td style="">
                    <img src="{{ storage_path() . ("/app/public/e-signature/". $requestor_esignature['user_id'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 35px;" width="80" height="50">
                </td>
                <td style=""></td>
                <td>
                    @if ($get_approver[0]->supervisor != null)
                        @if ($get_esignature[0]->cash_advance_details->status == 1
                            || $get_esignature[0]->cash_advance_details->status == 2 
                            || $get_esignature[0]->cash_advance_details->status == 3 
                            || $get_esignature[0]->cash_advance_details->status == 4 
                            || $get_esignature[0]->cash_advance_details->status == 5 
                            || $get_esignature[0]->cash_advance_details->status == 6 
                            || $get_esignature[0]->cash_advance_details->status == 7 )
                            <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['supervisor'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 30px;" width="80" height="50">
                        @else

                        @endif
                    @else

                    @endif
                </td>  
            </tr>

            <tr>
                <td style="text-align:right;">REQUESTED BY:</td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['requested_by'] }}</center></td>
                <td style="text-align:right;">CHECKED BY:</td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['supervisor'] }}</center></td>
            </tr>

            <tr>
                <td style="border-bottom: -13px;"></td>
                <td style="border-bottom: -13px;"></td>
                <td style="border-bottom: -13px;"></td>
                <td style="border-bottom: -13px; font-size:6;"><center>Supervisor</center></td>
            </tr>

            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>

            <tr>
                <td style=""></td>
                <td style="">
                    @if ($get_approver[0]->supervisor != null && $get_esignature[0]->cash_advance_details->status == 2 
                        || $get_esignature[0]->cash_advance_details->status == 3 
                        || $get_esignature[0]->cash_advance_details->status == 4 
                        || $get_esignature[0]->cash_advance_details->status == 5 
                        || $get_esignature[0]->cash_advance_details->status == 6 
                        || $get_esignature[0]->cash_advance_details->status == 7 ) 
                        <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['section_head'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 35px;" width="80" height="50">

                        @elseif ($get_approver[0]->supervisor == null && $get_esignature[0]->cash_advance_details->status == 2 
                        || $get_esignature[0]->cash_advance_details->status == 3 
                        || $get_esignature[0]->cash_advance_details->status == 4 
                        || $get_esignature[0]->cash_advance_details->status == 5 
                        || $get_esignature[0]->cash_advance_details->status == 6 
                        || $get_esignature[0]->cash_advance_details->status == 7 ) 
                        <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['section_head'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 35px;" width="80" height="50">
                    @endif
                </td>

                <td style="">
                    @if ($get_esignature[0]->cash_advance_details->status == 3 
                        || $get_esignature[0]->cash_advance_details->status == 4 
                        || $get_esignature[0]->cash_advance_details->status == 5 
                        || $get_esignature[0]->cash_advance_details->status == 6 
                        || $get_esignature[0]->cash_advance_details->status == 7 ) 
                        <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['department_head'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 65px;" width="80" height="50">
                    @endif
                </td>
                <td style=""></td>
            </tr>

            <tr>
                <td style="text-align:right;">APPROVED BY:</td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['section_head'] }}</center></td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['department_head'] }}</center></td>
                <td style=""></td>
            </tr>

            <tr>
                <td style="border-bottom: -13px;"></td>
                <td style="border-bottom: -13px; font-size:6;"><center>Section Head</center></td>
                <td style="border-bottom: -13px; font-size:6;"><center>Department Head</center></td>
                <td style="border-bottom: -13px;"></td>
            </tr>

            <tr>
                <td style="border-bottom: 1px solid black;" colspan="5">&nbsp;</td>
            </tr>

            <tr>
                <th colspan="5"><center>For Accounting Department Only</center></th>
            </tr>

            <tr>
                <td style=""></td>
                <td style=""></td>
                <td style=""></td>
                <td style="">
                    @if (  $get_esignature[0]->cash_advance_details->status == 4 
                        || $get_esignature[0]->cash_advance_details->status == 5 
                        || $get_esignature[0]->cash_advance_details->status == 6 
                        || $get_esignature[0]->cash_advance_details->status == 7 ) 
                        <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['cashier'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 26px;" width="80" height="50">
                    @endif
                </td>
            </tr>

            <tr>
                <td style="text-align:right;">PREVIOUS ADVANCE:</td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['previous_advance'] }}</center></td>
                <td style="text-align:right;">PAYMENT RELEASED BY:</td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['cashier'] }}</center></td>
            </tr>

            <tr>
                <td style=""></td>
                <td style="font-size:6"></td>
                <td style="font-size:6"></td>
                <td style="font-size:6"><center>Cashier</center></td>
                <td style=""></td>
            </tr>

            <tr>
                <td style="border-bottom: -15px;" colspan="5">&nbsp;</td>
            </tr>

            <tr>
                <td style=""></td>
                <td style="">     
                    @if ($get_esignature[0]->cash_advance_details->status == 5 
                        || $get_esignature[0]->cash_advance_details->status == 6 
                        || $get_esignature[0]->cash_advance_details->status == 7 ) 
                        <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['treasury_head'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 45px;" width="80" height="50">
                    @endif
                </td>

                <td style="">
                    @if ($get_esignature[0]->cash_advance_details->status == 6 
                        || $get_esignature[0]->cash_advance_details->status == 7 ) 
                        <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['finance_general_manager'] .".png") }}" style="position: absolute; bottom:94%; margin-left: 65px;" width="80" height="50">
                    @endif
                </td>

                <td style="">
                    @if ($get_esignature[0]->cash_advance_details->status == 7 ) 
                        @if ($e_signature['president'] != "")
                            <img src="{{ storage_path() . ("/app/public/e-signature/". $e_signature['president'] .".png") }}" style="position: absolute; bottom:93%; margin-left: 25px;" width="80" height="50">
                        @endif
                    @endif
                </td>

                <td style=""></td>
            </tr>

            <tr>
                <td style="text-align:right;">NOTED BY:</td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['treasury_head'] }}</center></td>
                <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['finance_general_manager'] }}</center></td>
                @if ($e_signature['president'] != "")
                    <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ $data['president'] }}</center></td>
                @endif
                <td style=""></td>
            </tr>

            <tr>
                <td style=""></td>
                <td style="font-size:6"><center>Treasury Head</center></td>
                <td style="font-size:6;"><center>Finance General Manager</center></td>
                @if ($e_signature['president'] != "")
                    <td style="font-size:6;"><center>President</center></td>
                @endif
                <td style=""></td>
            </tr>

            <tr>
                <td style="text-align:right;">CASH RECEIVED DATE:</td>
                @if ($data['date'] != "")    
                    <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ \Carbon\Carbon::parse($data['date'])->format('M. d, Y') }}</center></td>    
                @else
                    <td style="border-bottom: 1px solid black;"></td>
                @endif

                <!--Chan April 19, 2022 -->
                <td style="text-align:right;">DATE LIQUIDATED:</td>
                @if ($data['date_liquidated'] != "")    
                    <td style="border-bottom: 1px solid black;"><center>&nbsp;{{ \Carbon\Carbon::parse($data['date_liquidated'])->format('M. d, Y') }}</center></td>
                @else
                    <td style="border-bottom: 1px solid black;"></td>
                @endif

                <td style=""></td>
            </tr>

            <tr>
                <td style=""></td>
                <td style="">&nbsp;</td>
                <td style=""></td>
                <td style=""></td>
            </tr>
        </table>
    </body>
</html>
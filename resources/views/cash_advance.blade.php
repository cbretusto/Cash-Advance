@php $layout = 'layouts.super_user_layout'; @endphp

@extends($layout)

@section('title', 'Cash Advance')

@section('content_page')
    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            padding: 4px 4px;
            margin: 1px 1px;
            font-size: 16px;
            vertical-align: middle;
        }

        table.table thead th{
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 5px;
            padding-left: 5px;
            font-size: 16px;
            text-align: center;
            vertical-align: middle;
            /* white-space:nowrap; */
            padding: 5px 5px;
            margin: 3px 3px;
        }
    </style>
    @php
        date_default_timezone_set('Asia/Manila');
    @endphp
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                {{-- <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Administrator</h1>
                    </div>
                    <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Admin</li>
                        </ol>
                    </div>
                </div> --}}
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            {{-- <div class="card-header">
                                <h3 class="card-title">Cash Advance Records</h3>
                            </div> --}}
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="tabCashAdvance" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab_cash_advance_record" data-toggle="tab" href="#CashAdvanceRecord" role="tab" aria-controls="CashAdvanceRecord" aria-selected="false">Cash Advance Record</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="CashAdvanveApproved" data-toggle="tab" href="#CashAdvanceApproved" role="tab" aria-controls="CashAdvanceApproved" aria-selected="false">APPROVED</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="CashAdvanveLiquidated" data-toggle="tab" href="#CashAdvanceLiquidated" role="tab" aria-controls="CashAdvanceLiquidated" aria-selected="false">LIQUIDATED</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="CashAdvanveDisapproved" data-toggle="tab" href="#CashAdvanceDisapproved" role="tab" aria-controls="CashAdvanceDisapproved" aria-selected="false">DISAPPROVED</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="CashAdvanveCancelled" data-toggle="tab" href="#CashAdvanceCancelled" role="tab" aria-controls="CashAdvanceCancelled" aria-selected="false">CANCELLED</a>
                                    </li>
                                </ul>

                                <div class="tab-content table-responsive" id="tabCashAdvance">
                                    <div class="tab-pane fade show active" id="CashAdvanceRecord" role="tabpanel" aria-labelledby="tab_cash_advance_record">
                                        <div style="float: right;">
                                            <button class="btn btn-dark" data-toggle="modal" data-target="#modalAddCashAdvance" id="btnShowAddCashAdvanceModal" style="margin-top: 10px;"><i class="fa fa-plus"></i> Add Cash Advance</button>
                                        </div> <br><br>
                                        <div class="table-responsive"><br>
                                            <table id="tblCashAdvance" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Status</th>
                                                        <th>CA No.</th>
                                                        <th>Date Applied</th>
                                                        <th>EmpNo.</th>
                                                        <th>Applicant Name</th>
                                                        <th>Position</th>
                                                        <th>Official Station</th>
                                                        <th>Amount</th>
                                                        <th>Mode of Payment</th>
                                                        <th>Purpose</th>
                                                        <th>Requested By</th>
                                                        <th>Uploaded File</th>
                                                        <th>Approvers</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="CashAdvanceApproved" role="tabpanel" aria-labelledby="tab_cash_advance_approved">
                                        <div class="table-responsive"><br><br>
                                            <table id="tblCashAdvanceApproved" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Status</th>
                                                        <th>CA No.</th>
                                                        <th>Date Applied</th>
                                                        <th>EmpNo.</th>
                                                        <th>Applicant Name</th>
                                                        <th>Position</th>
                                                        <th>Official Station</th>
                                                        <th>Amount</th>
                                                        <th>Mode of Payment</th>
                                                        <th>Purpose</th>
                                                        <th>Requested By</th>
                                                        <th>Uploaded File</th>
                                                        <th>Approvers</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="CashAdvanceLiquidated" role="tabpanel" aria-labelledby="tab_cash_advance_liquidated">
                                        <div class="table-responsive"><br><br>
                                            <table id="tblCashAdvanceLiquidated" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Status</th>
                                                        <th>CA No.</th>
                                                        <th>Date Applied</th>
                                                        <th>EmpNo.</th>
                                                        <th>Applicant Name</th>
                                                        <th>Position</th>
                                                        <th>Official Station</th>
                                                        <th>Amount</th>
                                                        <th>Mode of Payment</th>
                                                        <th>Purpose</th>
                                                        <th>Requested By</th>
                                                        <th>Uploaded File</th>
                                                        <th>Approvers</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="CashAdvanceDisapproved" role="tabpanel" aria-labelledby="tab_cash_advance_disapproved">
                                        <div class="table-responsive"><br><br>
                                            <table id="tblCashAdvanceDisapproved" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Status</th>
                                                        <th>CA No.</th>
                                                        <th>Date Applied</th>
                                                        <th>EmpNo.</th>
                                                        <th>Applicant Name</th>
                                                        <th>Position</th>
                                                        <th>Official Station</th>
                                                        <th>Amount</th>
                                                        <th>Mode of Payment</th>
                                                        <th>Purpose</th>
                                                        <th>Requested By</th>
                                                        <th>Uploaded File</th>
                                                        <th>Approvers</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="CashAdvanceCancelled" role="tabpanel" aria-labelledby="CashAdvanveCancelled">
                                        <div class="table-responsive"><br><br>
                                            <table id="tblCashAdvanceCancelled" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Status</th>
                                                        <th>CA No.</th>
                                                        <th>Date Applied</th>
                                                        <th>EmpNo.</th>
                                                        <th>Applicant Name</th>
                                                        <th>Position</th>
                                                        <th>Official Station</th>
                                                        <th>Amount</th>
                                                        <th>Mode of Payment</th>
                                                        <th>Purpose</th>
                                                        <th>Requested By</th>
                                                        <th>Uploaded File</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddCashAdvance">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"> PRICON MICROELECTRONICS, INC. </h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddCashAdvance" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="modal-body">
                            <div class="card ">
                                <div class="card-header">
                                    <h4><strong><center>REQUEST FOR CASH ADVANCE</center></strong></h4>
                                    <hr/>
                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-5 flex-column d-flex">
                                            <label class="form-control-label">Cash Advance No.</label>
                                            <input type="text" id="txtAddCashAdvanceNo" name="ca_no" class="form-control" placeholder="Auto Generate" style="width:125px;" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label class="form-control-label">Date Applied:</label>
                                            <input type="text" class="form-control" id="txtAddDateApplied" name="date_applied" value="{{ \Carbon\Carbon::now()->format('M. d, Y') }}" readonly>
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Date of Liquidation:</label>
                                            <input type="text" class="form-control" id="txtAddDateOfLiquidation" name="date_of_liquidation" value="{{ \Carbon\Carbon::now()->addMonth()->format('M. d, Y') }} " readonly>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Employee No.</label>
                                            <input type="text" class="form-control" id="txtAddEmployeeNo" name="employee_no" placeholder="Enter your employee no." >
                                        </div>

                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Mode of Payment:</label>
                                            <select class="form-control" id="selectAddModeOfPayment" name="mode_of_payment">
                                                <option selected disabled value="">-SELECT-</option>
                                                <option value="Payroll Account">Payroll Account</option>
                                                <option value="GCash">GCash</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Applicant Name:</label>
                                            <input type="text" class="form-control" id="txtAddApplicantName" name="applicant_name" placeholder="" readonly>
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Payroll Account No.</label>
                                            <input type="text" class="form-control" id="txtAddPayrollAccountNo" name="payroll_account_no" readonly>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Position:</label>
                                            <input type="text" class="form-control" id="txtAddPosition" name="position" placeholder="" readonly>
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Gcash Account No.</label>
                                            <input type="text" id="txtAddGcashAccountNo" name="gcash_account_no" placeholder="0000-000-0000" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" disabled="disabled">
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Official Station:</label>
                                            <input type="text" class="form-control" id="txtAddOfficialStation" name="official_station" placeholder="" readonly>
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Local No.</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4 selectLocalNo" id="selectAddLocalNo" name="local_no"></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Amount of Cash Advance:</label>
                                                <div class="input-group">
                                                    <input type="text" id="txtAddAmountOfCashAdvance" name="amount_of_ca" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" disabled="disabled">
                                                    &nbsp;-&nbsp;
                                                    <input type="text" id="txtAddConvertToWord" name="ca_convert_to_word" placeholder="" class="form-control" style="width:300px;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input peso radioBtn" type="radio" name="amount_of_ca_currency" id="txtAddAmountOfCashAdvanceCurrency" value="Pesos">
                                        <label class="form-check-label" for="inlineRadio1">PESO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input dollar radioBtn" type="radio" name="amount_of_ca_currency" id="txtAddAmountOfCashAdvanceCurrency" value="Dollars">
                                        <label class="form-check-label" for="inlineRadio2">DOLLAR</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input yen radioBtn" type="radio" name="amount_of_ca_currency" id="txtAddAmountOfCashAdvanceCurrency" value="Yen">
                                        <label class="form-check-label" for="inlineRadio3">YEN</label>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-12">
                                            <label class="col-form-label">Purpose:</label>
                                            <input type="hidden" class="form-control" name="purpose" rows="3" >
                                            <textarea type="text" class="form-control" id="txtAddPurpose" name="purpose" placeholder="Remark" maxlength="255"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Requested By:</label>
                                            <input type="text" class="form-control" id="txtAddRequestedBy" name="requested_by" placeholder="Name of requestor" readonly>
                                            {{-- <input type="text" class="form-control" id="txtAddRapidxUser" name="rapidx_user_id">  --}}
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Checked By: (OPTIONAL)</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4 selectAddSupervisor" id="selectAddSupervisor" name="supervisor"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Approved By:</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4 selectAddSectHead" id="selectAddSectionHead" name="sect_head" required></select>
                                                <select class="form-control select2bs4 selectAddDeptHead" id="selectAddDepartmentHead" name="dept_head" required></select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-control-label">Attachment:</label> <br>
                                            <input type="file" class="" id="txtAddFile" name="uploaded_file" accept=".xlsx, .xls, .csv, application/pdf" style="width:100%;">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5><strong><center>For Accounting Department Only</center></strong></h5><br>
                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Previous Advance:</label>
                                            <input type="text" class="form-control" id="txtAddPreviousAdvance" name="previous_advance" readonly>
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Payment Released By:</label>
                                            {{-- <div class="input-group" style="pointer-events:none; visibility: hidden">  --}}
                                                <div class="input-group" style="pointer-events: none;">
                                                <select class="form-control select2bs4 selectAddPaymentReleasedBy" id="selectAddPaymentReleasedBy" name="payment_released_by"></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Noted By:</label>
                                            {{-- <div class="input-group"> --}}
                                            <div class="input-group" style="pointer-events: none;">
                                                <select class="form-control select2bs4 selectAddTreasuryHead" id="selectAddTreasuryHead" name="treasury_head"></select>
                                                <select class="form-control select2bs4 selectAddFinanceGeneralManager" id="selectAddFinanceGeneralManager" name="fin_gen_manager"></select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <label class="form-control-label">Date:</label>
                                            <input type="date" class="form-control" id="txtAddDate" name="date" readonly>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between text-left">
                                        <div class="form-group col-sm-6 flex-column d-flex">
                                            <div class="input-group" style="display:none;">
                                                <select class="form-control select2bs4 selectAddPresident" id="selectAddPresident" name="president"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddCashAdvance" class="btn btn-dark"><i id="iBtnAddCashAdvanceIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditCashAdvance">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"> PRICON MICROELECTRONICS, INC. </h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditCashAdvance" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- <div class="col-lg-11 mx-auto" style="margin-top:20px;"> --}}
                            <div class="modal-body">
                                <div class="card ">
                                    <div class="card-header">
                                        <h4><strong><center>REQUEST FOR CASH ADVANCE</center></strong></h4>
                                        <hr>
                                        <div class="row justify-content-between text-left">
                                            <input type="hidden" class="form-control" name="cash_advance_id" id="txtEditCashAdvanceId">
                                            <div class="form-group col-sm-5 flex-column d-flex">
                                                <label class="form-control-label">Cash Advance No.</label>
                                                <input type="text" id="txtEditCashAdvanceNo" name="ca_no" class="form-control" style="width:125px;" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label class="form-control-label">Date Applied:</label>
                                                <input type="text" class="form-control" id="txtEditDateApplied" name="date_applied" value="<?php echo date('M. d, Y'); ?>" readonly>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Date of Liquidation:</label>
                                                <input type="text" class="form-control" id="txtEditDateOfLiquidation" name="date_of_liquidation" value="{{ \Carbon\Carbon::now()->addMonth()->format('M. d, Y') }} " readonly>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Employee No.</label>
                                                <input type="text" class="form-control" id="txtEditEmployeeNo" name="employee_no" placeholder="Enter your employee no." >
                                            </div>

                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Mode of Payment:</label>
                                                <select class="form-control" id="selectEditModeOfPayment" name="mode_of_payment">
                                                    <option selected disabled value="">-SELECT-</option>
                                                    <option value="Payroll Account">Payroll Account</option>
                                                    <option value="GCash">GCash</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Applicant Name:</label>
                                                <input type="text" class="form-control" id="txtEditApplicantName" name="applicant_name" placeholder="" readonly>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Payroll Account No.</label>
                                                <input type="text" class="form-control" id="txtEditPayrollAccountNo" name="payroll_account_no" placeholder="" readonly>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Position:</label>
                                                <input type="text" class="form-control" id="txtEditPosition" name="position" placeholder="" readonly>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Gcash Account No.</label>
                                                <input type="text" id="txtEditGcashAccountNo" name="gcash_account_no" placeholder="0000-000-0000" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11">
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Official Station:</label>
                                                <input type="text" class="form-control" id="txtEditOfficialStation" name="official_station" placeholder="" readonly>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Local No.</label>
                                                <div class="input-group">
                                                    <select class="form-control select2bs4 selectLocalNo" id="selectEditLocalNo" name="local_no"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Amount of Cash Advance:</label>
                                                    <div class="input-group">
                                                        <input type="text" id="txtEditAmountOfCashAdvance" name="amount_of_ca" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6">
                                                        &nbsp;-&nbsp;
                                                        <input type="text" id="txtEditConvertToWord" name="ca_convert_to_word" placeholder="" class="form-control" style="width:300px;" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input peso radioBtn" type="radio" name="amount_of_ca_currency" id="txtEditAmountOfCashAdvanceCurrency" value="Pesos">
                                            <label class="form-check-label" for="inlineRadio1">PESO</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input dollar radioBtn" type="radio" name="amount_of_ca_currency" id="txtEditAmountOfCashAdvanceCurrency" value="Dollars">
                                            <label class="form-check-label" for="inlineRadio2">DOLLAR</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input yen radioBtn" type="radio" name="amount_of_ca_currency" id="txtEditAmountOfCashAdvanceCurrency" value="Yen">
                                            <label class="form-check-label" for="inlineRadio3">YEN</label>
                                        </div>
                                        <hr>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-12">
                                                <label class="col-form-label">Purpose:</label>
                                                <input type="hidden" class="form-control" name="purpose" rows="3" >
                                                <textarea type="text" class="form-control" id="txtEditPurpose" name="purpose" placeholder="Remark" maxlength="255"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Requested By:</label>
                                                <input type="text" class="form-control" id="txtEditRequestedBy" name="requested_by" placeholder="Name of requestor" readonly>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Checked By:</label>
                                                <div class="input-group">
                                                    <select class="form-control select2bs4 selectEditSupervisor" id="selectEditSupervisor" name="supervisor"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Approved By:</label>
                                                <div class="input-group">
                                                    <select class="form-control select2bs4 selectEditSectHead" id="selectEditSectionHead" name="sect_head" required></select>
                                                    <select class="form-control select2bs4 selectEditDeptHead" id="selectEditDepartmentHead" name="dept_head" required></select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="form-control-label">Attachment:</label> <br>
                                                <input type="text" class="form-control" name="uploaded_file" id="txtEditReuploadFile">
                                                <input type="file" class="d-none" id="txtEditFile" name="uploaded_file" accept=".xlsx, .xls, .csv, application/pdf" style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="checkbox" id="check_box">
                                            <label >Re-upload File</label>
                                        </div>
                                        <hr>
                                        <h5><strong><center>For Accounting Department Only</center></strong></h5><br>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Previous Advance:</label>
                                                <input type="text" class="form-control" id="txtEditPreviousAdvance" name="previous_advance" readonly>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Payment Released By:</label>
                                                <div class="input-group" style="pointer-events: none;">
                                                    <select class="form-control select2bs4 selectEditPaymentReleasedBy" id="selectEditPaymentReleasedBy" name="payment_released_by"></select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Noted By:</label>
                                                <div class="input-group" style="pointer-events: none;">
                                                    <select class="form-control select2bs4 selectEditTreasuryHead" id="selectEditTreasuryHead" name="treasury_head"></select></select>
                                                    <select class="form-control select2bs4 selectEditFinanceGeneralManager" id="selectEditFinanceGeneralManager" name="fin_gen_manager"></select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Date:</label>
                                                <input type="date" class="form-control" id="txtEditDate" name="date" readonly>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <div class="input-group" style="display:none;">
                                                    <select class="form-control select2bs4 selectEditPresident" id="selectEditPresident" name="president"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditCashAdvance" class="btn btn-dark"><i id="iBtnEditCashAdvanceIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- APPROVE MODAL START -->
    <div class="modal fade" id="modalApproveRemark">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title"><i class="fa fa-thumbs-up">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formApproveCashAdvanceRemark">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangeUserApproverStatLabel"></label>
                        <input type="hidden" name="cash_advance_id" id="approvedCashAdvanceUserId">
                        <input type="hidden" name="status" id="approvedCashAdvanceUserStat">
                        <div class="row">
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-12">
                                    <h5> Are you sure you want to approve the Cash Advance request? </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnApprove" class="btn btn-success"><i id="iBtnApproveIcon" class="fa fa-thumbs-up"> </i> Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- APPROVE MODAL START END -->

    <!-- DISAPPROVE REMARK MODAL START -->
    <div class="modal fade" id="modalDisapproveRemark">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title"><i class="fa fa-thumbs-down">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formDisapproveCashAdvanceRemark">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-12">
                                    <h5> Are you sure you want to disapprove the Cash Advance request? </h5>
                                    <label class="col-form-label">Remark:</label>
                                    <input type="hidden" name="cash_advance_id" id="disapprovedCashAdvanceId">
                                    <input type="hidden" name="status" id="disapprovedCashAdvanceStat">
                                    <textarea type="text" class="form-control" id="txtDisapproveRemarks" name="disapprove_remarks" placeholder="Remark"></textarea>
                                    <input type="hidden" class="form-control" id="classification_remarks" name="classification_remarks">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDisapproveRemark" class="btn btn-danger"><i id="iBtnDisapproveRemarkIcon" class="fa fa-thumbs-down"> </i> Disapprove</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DISAPPROVE REMARK MODAL START END -->

    <!-- ADD PRESIDENT MODAL START -->
    <div class="modal fade" id="modalAddPresident">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title"><i class="fas fa-id-badge">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddPresident">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="row justify-content-between text-left">
                                <input type="hidden" name="president_id" id="addPresidentId">
                                <input type="hidden" name="cash_advance_id" id="addPresidentCashAdvanceId">
                                <div class="form-group col-sm-12">
                                    <h5> Are you sure you want to add the President? </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">  <i id="iBtnAddPresidentIcon" class="fas fa-times fa-lg"> </i>  </button>
                        <button type="submit" id="btnAddPresident" class="btn btn-info">  <i class="fa fa-check fa-lg"> </i>  </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD PRESIDENT MODAL START END -->

    <!-- CASHIER PREVIOUS ADVANCE MODAL START -->
    <div class="modal fade" id="modalPreviousAdvance">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title"><i class="fa fa-edit">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formPreviousAdvance">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Previous Advance:</label>
                                <input type="hidden" name="cash_advance_id" id="cashierPreviousAdvanceId">
                                <input type="text" class="form-control" id="txtPreviousAdvance" name="previous_advance">
                                <input type="hidden" class="form-control" id="txtPreviousAdvanceRemarks" name="previous_advance_remarks">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnPreviousAdvance" class="btn btn-info"><i id="iBtnPreviousAdvanceIcon" class=""> </i> Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div><!-- CASHIER PREVIOUS ADVANCE MODAL END -->

    <!-- DATE CASH RECEIVED MODAL START -->
    <div class="modal fade" id="modalDateCashReceived">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-edit">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formDateCashReceived">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Date of Cash Received:</label>
                                <input type="hidden" name="cash_advance_id" id="dateId">
                                <input type="date" class="form-control" id="txtDate" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDate" class="btn btn-dark"><i id="iBtnDateIcon" class=""> </i> Date Received</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DATE CASH RECEIVED MODAL END -->

    <!-- DATE LIQUIDATED MODAL START -->
    <div class="modal fade" id="modalDateLiquidated">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-edit">  </i>  System Confirmation</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formDateLiquidated">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Date Liquidated:</label>
                                <input type="hidden" name="cash_advance_id" id="dateliquidatedId">
                                {{-- <input type="text" class="form-control" id="txtDateLiquidated" name="date_liquidated" value="{{ \Carbon\Carbon::now()->format('M. d, Y') }} " readonly>  --}}
                                <input type="date" class="form-control" id="txtDateLiquidated" name="date_liquidated" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDateLiquidated" class="btn btn-dark"><i id="iBtnDateLiquidatedIcon" class=""> </i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DATE LIQUIDATED MODAL END -->

     <!-- cancel MODAL START -->
     <div class="modal fade" id="modalCancel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fas fa-times">  </i>  Cancel</h4>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formCancel">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                                <input type="hidden" name="cash_advance_id" id="cancelCAId">
                                <label class="col-form-label">Remarks: </label>

                                {{-- <input type="text" class="form-control" id="txtDateLiquidated" name="date_liquidated" value="{{ \Carbon\Carbon::now()->format('M. d, Y') }} " readonly>  --}}
                                {{-- <input type="date" class="form-control" id="txtDateLiquidated" name="date_liquidated" required>  --}}

                                <textarea name="cancel_remarks" id="cancelRemarks" cols="20" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnSaveCancel" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DATE LIQUIDATED MODAL END -->
@endsection

<!-- {{-- JS CONTENT --}} -->
@section('js_content')

    <script type="text/javascript">
        let dataTableCashAdvance;
        let arrSelectedCashAdvance = [];

        $(document).ready(function () {

            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblCashAdvance tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // USERS DATATABLES START
            GetLocalNo($(".selectLocalNo"));
            GetSupervisorApprover($(".selectAddSupervisor"));
            GetSectionHeadApprover($(".selectAddSectHead"));
            GetDepartmentHeadApprover($(".selectAddDeptHead"));
            GetCashierApprover($(".selectAddPaymentReleasedBy"));
            GetTreasuryHeadApprover($(".selectAddTreasuryHead"));
            GetFinanceGeneralManagerApprover($(".selectAddFinanceGeneralManager"));
            GetPresidentApprover($(".selectAddPresident"));

            GetSupervisorApprover($(".selectEditSupervisor"));
            GetSectionHeadApprover($(".selectEditSectHead"));
            GetDepartmentHeadApprover($(".selectEditDeptHead"));
            GetCashierApprover($(".selectEditPaymentReleasedBy"));
            GetTreasuryHeadApprover($(".selectEditTreasuryHead"));
            GetFinanceGeneralManagerApprover($(".selectEditFinanceGeneralManager"));
            GetPresidentApprover($(".selectEditPresident"));
            GetPresidentID();

            dataTableCashAdvance = $("#tblCashAdvance").DataTable({
                "processing" : false,
                "serverSide" : true,
                "order": [[ 2, "desc" ]],
                "ajax" : {
                    url: "view_cash_advance", // this will be pass in the uri called view_cash_advance that handles datatables of view_cash_advance() method inside CashAdvanceController
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false },
                    { "data" : "status" },
                    //cash_advance_details = model
                    { "data" : "cash_advance_details.ca_no" },
                    { "data" : "cash_advance_details.date_applied" },
                    { "data" : "cash_advance_details.employee_no" },
                    { "data" : "cash_advance_details.applicant_name" },
                    { "data" : "cash_advance_details.position"},
                    { "data" : "cash_advance_details.official_station" },
                    { "data" : "cash_advance_details.amount_of_ca" },
                    { "data" : "cash_advance_details.mode_of_payment" },
                    { "data" : "cash_advance_details.purpose" },
                    { "data" : "cash_advance_details.requested_by" },
                    { "data" : "uploaded_file" },
                    { "data" : "approvers"} //approvers = Add Column - Controller//
                ],
            }); // USERS DATATABLES END

            dataTableCashAdvanceApproved = $("#tblCashAdvanceApproved").DataTable({
                "processing" : false,
                "serverSide" : true,
                "order": [[ 2, "desc" ]],
                "ajax" : {
                    url: "view_cash_advance_approved", // this will be pass in the uri called view_cash_advance that handles datatables of view_cash_advance() method inside CashAdvanceController
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false },
                    { "data" : "status" },
                    //cash_advance_details = model
                    { "data" : "cash_advance_details.ca_no" },
                    { "data" : "cash_advance_details.date_applied" },
                    { "data" : "cash_advance_details.employee_no" },
                    { "data" : "cash_advance_details.applicant_name" },
                    { "data" : "cash_advance_details.position"},
                    { "data" : "cash_advance_details.official_station" },
                    { "data" : "cash_advance_details.amount_of_ca" },
                    { "data" : "cash_advance_details.mode_of_payment" },
                    { "data" : "cash_advance_details.purpose" },
                    { "data" : "cash_advance_details.requested_by" },
                    { "data" : "uploaded_file" },
                    { "data" : "approvers"} //approvers = Add Column - Controller//
                ],
            }); // USERS DATATABLES END

            dataTableCashAdvanceDisapproved = $("#tblCashAdvanceDisapproved").DataTable({
                "processing" : false,
                "serverSide" : true,
                "order": [[ 2, "desc" ]],
                "ajax" : {
                    url: "view_cash_advance_disapproved", // this will be pass in the uri called view_cash_advance that handles datatables of view_cash_advance() method inside CashAdvanceController
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false },
                    { "data" : "status" },
                    //cash_advance_details = model
                    { "data" : "cash_advance_details.ca_no" },
                    { "data" : "cash_advance_details.date_applied" },
                    { "data" : "cash_advance_details.employee_no" },
                    { "data" : "cash_advance_details.applicant_name" },
                    { "data" : "cash_advance_details.position"},
                    { "data" : "cash_advance_details.official_station" },
                    { "data" : "cash_advance_details.amount_of_ca" },
                    { "data" : "cash_advance_details.mode_of_payment" },
                    { "data" : "cash_advance_details.purpose" },
                    { "data" : "cash_advance_details.requested_by" },
                    { "data" : "uploaded_file" },
                    { "data" : "approvers"} //approvers = Add Column - Controller//
                ],
            }); // USERS DATATABLES END

            dataTableCashAdvanceLiquidated = $("#tblCashAdvanceLiquidated").DataTable({
                "processing" : false,
                "serverSide" : true,
                "order": [[ 2, "desc" ]],
                "ajax" : {
                    url: "view_cash_advance_liquidated", // this will be pass in the uri called view_cash_advance that handles datatables of view_cash_advance() method inside CashAdvanceController
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false },
                    { "data" : "status" },
                    //cash_advance_details = model
                    { "data" : "cash_advance_details.ca_no" },
                    { "data" : "cash_advance_details.date_applied" },
                    { "data" : "cash_advance_details.employee_no" },
                    { "data" : "cash_advance_details.applicant_name" },
                    { "data" : "cash_advance_details.position"},
                    { "data" : "cash_advance_details.official_station" },
                    { "data" : "cash_advance_details.amount_of_ca" },
                    { "data" : "cash_advance_details.mode_of_payment" },
                    { "data" : "cash_advance_details.purpose" },
                    { "data" : "cash_advance_details.requested_by" },
                    { "data" : "uploaded_file" },
                    { "data" : "approvers"} //approvers = Add Column - Controller//
                ],
            }); // USERS DATATABLES END

            dataTableCashAdvanceCancelled = $("#tblCashAdvanceCancelled").DataTable({
                "processing" : false,
                "serverSide" : true,
                "order": [[ 2, "desc" ]],
                "ajax" : {
                    url: "view_cash_advance_canceled", // this will be pass in the uri called view_cash_advance that handles datatables of view_cash_advance() method inside CashAdvanceController
                },
                "columns":[
                    { "data" : "action", orderable:false, searchable:false },
                    { "data" : "status" },
                    //cash_advance_details = model
                    { "data" : "cash_advance_details.ca_no" },
                    { "data" : "cash_advance_details.date_applied" },
                    { "data" : "cash_advance_details.employee_no" },
                    { "data" : "cash_advance_details.applicant_name" },
                    { "data" : "cash_advance_details.position"},
                    { "data" : "cash_advance_details.official_station" },
                    { "data" : "cash_advance_details.amount_of_ca" },
                    { "data" : "cash_advance_details.mode_of_payment" },
                    { "data" : "cash_advance_details.purpose" },
                    { "data" : "cash_advance_details.requested_by" },
                    { "data" : "uploaded_file" },
                ],
            }); // CANCELED DATATABLES END

            // ============================== ADD CASH ADVANCE ==============================
            // The AddCashAdvance(); function is inside public/js/my_js/CashAdvance.js
            // after the submission, the ajax request will pass the formAddCashAdvance(form) of data(input) in the uri(add_cash_advance)
            // then the controller will handle that uri to use specific method called add_cash_advance() inside CashAdvanceController
            $("#formAddCashAdvance").submit(function(event){
                event.preventDefault(); // to stop the form submission
                if($('#txtAddCashAdvanceNo').val() == ''){
                    alert('Cash Advance System does not accept below 10,000 pesos.')
                }else{
                    AddCashAdvance();
                    dataTableCashAdvance.draw(); // reload the tables after insertion
                }
            });

            // VALIDATION(remove errors)
            $("#btnShowAddCashAdvanceModal").click(function(){
                $("#txtAddCashAdvanceNo").removeClass('is-invalid');
                $("#txtAddCashAdvanceNo").attr('title', '');
                $("#txtAddDateApplied").removeClass('is-invalid');
                $("#txtAddDateApplied").attr('title', '');
                $("#txtAddDateOfLiquidation").removeClass('is-invalid');
                $("#txtAddDateOfLiquidation").attr('title', '');
                $("#txtAddEmployeeNo").removeClass('is-invalid');
                $("#txtAddEmployeeNo").attr('title', '');
                $("#selectAddModeOfPayment").removeClass('is-invalid');
                $("#selectAddModeOfPayment").attr('title', '');
                $("#txtAddApplicantName").removeClass('is-invalid');
                $("#txtAddApplicantName").attr('title', '');
                $("#txtAddPayrollAccountNo").removeClass('is-invalid');
                $("#txtAddPayrollAccountNo").attr('title', '');
                $("#txtAddPosition").removeClass('is-invalid');
                $("#txtAddPosition").attr('title', '');
                $("#txtAddGcashAccountNo").removeClass('is-invalid');
                $("#txtAddGcashAccountNo").attr('title', '');
                $("#txtAddOfficialStation").removeClass('is-invalid');
                $("#txtAddOfficialStation").attr('title', '');
                $("#selectAddLocalNo").removeClass('is-invalid');
                $("#selectAddLocalNo").attr('title', '');
                $("#txtAddAmountOfCashAdvance").removeClass('is-invalid');
                $("#txtAddAmountOfCashAdvance").attr('title', '');
                $("#txtAddConvertToWord").removeClass('is-invalid');
                $("#txtAddConvertToWord").attr('title', '');
                $("#txtAddPurpose").removeClass('is-invalid');
                $("#txtAddPurpose").attr('title', '');
                $("#txtAddRequestedBy").removeClass('is-invalid');
                $("#txtAddRequestedBy").attr('title', '');
                $("#txtAddFile").removeClass('is-invalid');
                $("#txtAddFile").attr('title', '');
                $("#txtAddSupervisor").removeClass('is-invalid');
                $("#txtAddSupervisor").attr('title', '');
                $("#selectAddSectionHead").removeClass('is-invalid');
                $("#selectAddSectionHead").attr('title', '');
                $("#selectAddDepartmentHead").removeClass('is-invalid');
                $("#selectAddDepartmentHead").attr('title', '');
                $("#txtAddPreviousAdvance").removeClass('is-invalid');
                $("#txtAddPreviousAdvance").attr('title', '');
                $("#selectAddPaymentReleasedBy").removeClass('is-invalid');
                $("#selectAddPaymentReleasedBy").attr('title', '');
                $("#selectAddTreasuryHead").removeClass('is-invalid');
                $("#selectAddTreasuryHead").attr('title', '');
                $("#selectAddFinanceGeneralManager").removeClass('is-invalid');
                $("#selectAddFinanceGeneralManager").attr('title', '');
                $("#selectAddPresident").removeClass('is-invalid');
                $("#selectAddPresident").attr('title', '');
                $("#txtAddDate").removeClass('is-invalid');
                $("#txtAddDate").attr('title', '');

                // READ ONLY
                // $("#txtAddPayrollAccountNo").attr('disabled', 'disabled');
                // $("#txtAddGcashAccountNo").attr('disabled', 'disabled');
            });

            // ============================== AUTO FILL APPROVERS (CASHIER TREASURY HEAD, FIN. GEN. MANAGER) ==============================
            $('#btnShowAddCashAdvanceModal').on('click', function(){
                $.ajax({
                    url: "get_noted_by",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        // console.log(response);
                        // for (let index = 0; index < response['get_noted_by'].length; index++) {
                            $('#selectAddPaymentReleasedBy').val(response['get_payment_released_by_cashier'][0]['rapidx_id']).trigger('change');
                            $('#selectAddTreasuryHead').val(response['get_noted_by_treasury_head'][0]['rapidx_id']).trigger('change');
                            $('#selectAddFinanceGeneralManager').val(response['get_noted_by_finance_general_manager'][0]['rapidx_id']).trigger('change');
                        // }
                    },
                });
            });

            $('#modalEditCashAdvance').on('click', function(){
                $.ajax({
                    url: "get_noted_by",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        // console.log(response);
                        // for (let index = 0; index < response['get_noted_by'].length; index++) {
                            $('#selectEditPaymentReleasedBy').val(response['get_payment_released_by_cashier'][0]['rapidx_id']).trigger('change');
                            $('#selectEditTreasuryHead').val(response['get_noted_by_treasury_head'][0]['rapidx_id']).trigger('change');
                            $('#selectEditFinanceGeneralManager').val(response['get_noted_by_finance_general_manager'][0]['rapidx_id']).trigger('change');
                        // }
                    },
                });
            });

            // ============================== ADD CASH ADVANCE FETCH DATA ==============================
            $("#txtAddEmployeeNo").keypress(function(){
				$(this).val($(this).val().toUpperCase());
			});
            $("#txtAddEmployeeNo").keyup(function() {
                var empNo = $(this).val();
                empNo.toUpperCase();
                // console.log(empNo);

                if(empNo != null ){
                    $.ajax({
                        url: 'get_employee_info',
                        method: 'get',
                        data: {
                            'emp_no': empNo
                        },
                        // dataType: 'text',
                        beforeSend: function(){
                            $("input[name='official_station']", $("#formAddCashAdvance")).val();
                            $("input[name='position']", $("#formAddCashAdvance")).val();
                            // console.log(value);
                        },
                        success: function(result){
                            if(result['data'] != null){
                                $("input[name='applicant_name']", $("#formAddCashAdvance")).val(result['data']['FirstName'] + " " + result['data']['LastName']);
                                $("input[name='position']", $("#formAddCashAdvance")).val(result['data']['position_info']['Position']);
                                $("input[name='official_station']", $("#formAddCashAdvance")).val(result['data']['department_info']['Department'] + ' / ' + result['data']['section_info']['Section']);
                            }else{
                                $("input[name='position']", $("#formAddCashAdvance")).val('');
                                $("input[name='official_station']", $("#formAddCashAdvance")).val('');
                                $("input[name='applicant_name']", $("#formAddCashAdvance")).val('');

                                $('#selectAddModeOfPayment').val('').trigger('change');
                                // Optional for clearing values
                                // $("#txtAddAppName").val('');
                                // $("#txtAddos").val('');
                                // $("#txtAddpos").val('');
                            }
                        }
                    });
                }else{
                    $("#txtAddApplicantName").val('');
                    $("#txtAddOfficialStation").val('');
                    $("#txtAddPosition").val('');
                }
            }); // ADD CASH ADVANCE FETCH DATA


            // ============================== (ADD) GET PAYROLL ACCOUNT NUMBER ==============================
            $("select#selectAddModeOfPayment").change(function(){
                var selectedMOP = $(this).children("option:selected").val();
                if (selectedMOP == "Payroll Account"){
                    // console.log('selected payroll');
                    var empNo = $('#txtAddEmployeeNo').val();
                    // console.log(empNo);

                    if(empNo != null ){
                        $.ajax({
                            url: 'get_payroll_account_by_user',
                            method: 'get',
                            data: {
                                'emp_no': empNo
                            },
                            // dataType: 'text',
                            beforeSend: function(){
                            },

                            success: function(result){
                                if(result['payroll_account'] != null){
                                    $("#txtAddPayrollAccountNo").val(result['payroll_account'][0].account_no).trigger('change')
                                    // console.log(result['payroll_account'].AccountNumber);
                                }else{
                                    // Optional for clearing values
                                    // $("#txtAddPayrollAccountNo").val('');
                                    // $("#txtAddos").val('');
                                    // $("#txtAddpos").val('');
                                }
                            }
                        });
                    }
                }
            });
            // ============================== (EDIT) GET PAYROLL ACCOUNT NUMBER ==============================
            $("select#selectEditModeOfPayment").change(function(){
                var selectedMOP = $(this).children("option:selected").val();
                if (selectedMOP == "Payroll Account"){
                    // console.log('selected payroll');
                    var empNo = $('#txtEditEmployeeNo').val();
                    // console.log(empNo);

                    if(empNo != null ){
                        $.ajax({
                            url: 'get_payroll_account_by_user',
                            method: 'get',
                            data: {
                                'emp_no': empNo
                            },
                            // dataType: 'text',
                            beforeSend: function(){
                            },

                            success: function(result){
                                if(result['payroll_account'] != null){
                                    $("#txtEditPayrollAccountNo").val(result['payroll_account'][0].account_no);
                                    // console.log(result['payroll_account'].AccountNumber);
                                }else{
                                    // Optional for clearing values
                                    // $("#txtAddPayrollAccountNo").val('');
                                    // $("#txtAddos").val('');
                                    // $("#txtAddpos").val('');
                                }
                            }
                        });
                    }
                }
            });

            //====================== ADD MODE OF PAYMENT ONCHANGE ======================
            $('#selectAddModeOfPayment').change(function() {
                if($(this).val() == 'Payroll Account'){
                    // $("#txtAddPayrollAccountNo").addClass('disabled');
                    $("#txtAddPayrollAccountNo").focus();
                    $("#txtAddPayrollAccountNo").prop('required', true);
                }
                else{
                    $("#txtAddPayrollAccountNo").attr("disabled", "disabled");
                    $('#txtAddPayrollAccountNo').val('');
                }

                if($(this).val() == 'GCash'){
                    $("#txtAddGcashAccountNo").removeAttr('disabled', 'disabled');
                    $("#txtAddGcashAccountNo").focus();
                    $("#txtAddGcashAccountNo").prop('required', true);
                }else{
                    $("#txtAddGcashAccountNo").attr("disabled", "disabled");
                    $('#txtAddGcashAccountNo').val('');
                }
            });

            // ============================== ADD CA AMOUNT CONVERT TO WORD ==============================
            $(function() {
                var words="";
                var currency="";
                $("#txtAddAmountOfCashAdvance").on("keyup", per);
                $('.radioBtn').on('click', function(){
                    $('#txtAddAmountOfCashAdvance').val('');
                    $('#txtAddConvertToWord').val('');
                    if($('.peso').is(":checked")){
                        currency = $('.peso').val();
                        // console.log(currency);
                    }
                    if($('.dollar').is(":checked")){
                        currency = $('.dollar').val();
                        // console.log(currency);
                    }
                    if($('.yen').is(":checked")){
                        currency = $('.yen').val();
                        // console.log(currency);
                    }
                });

                function per() {
                    var totalamount = (
                        Number($("#txtAddAmountOfCashAdvance").val())
                    );
                    words = toWords(totalamount);
                    $("#txtAddConvertToWord").val(words + currency + " Only");
                }
            }); // END ADD CA AMOUNT CONVERT TO WORD

            $('.radioBtn').on('click', function(){
                $('#txtAddCashAdvanceNo').val('');
            });
            $('#txtAddAmountOfCashAdvance').keyup(function(){
                $('#txtAddCashAdvanceNo').val('');
            });

            //============================== EDIT CASH ADVANCE ==============================
            // actionEditCashAdvance is generated by datatables and open the modalEditCashAdvance(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditCashAdvance', function(){
                // the cash_advance-id(attr) is inside the datatables of CashAdvanceController that will be use to collect the cash_advance-id
                let cash_advanceId = $(this).attr('cash_advance-id');

                // after clicking the actionEditCashAdvance(button) the cash_advanceId will be pass to the txtEditCashAdvanceId(input=hidden) and when the form is submitted this
                // will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the report
                $("#txtEditCashAdvanceId").val(cash_advanceId);

                // COLLECT THE cash_advanceId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                    //GetCashAdvanceByIdToEdit() function is inside CashAdvance.js and pass the cash_advanceId as an argument when passing the ajax that will be use to query
                    // the cash_advance-id of get_cash_advance_by_id() method inside CashAdvanceController and pass the fetched report based on that query as $cash_advance(variable)
                    // to pass the values in the inputs of modalEditCashAdvance and also to validate the fetched values, inside GetCashAdvanceByIdToEdit under CashAdvance.js
                GetCashAdvanceByIdToEdit(cash_advanceId);

                 // READ ONLY (Mode of Payment)
                // $("#txtEditPayrollAccountNo").attr('disabled', 'disabled');
                // $("#txtEditGcashAccountNo").attr('disabled', 'disabled');

                // READ ONLY (File Upload)
                $('#txtEditReuploadFile').attr('disabled', 'disabled');
                $('#txtEditAmountOfCashAdvance').attr('readonly', true);
            });
            // The EditCashAdvance(); function is inside public/js/my_js/CashAdvance.js
            // after the submission, the ajax request will pass the formEditCashAdvance(form) of its data(input) in the uri(edit_cash_advance)
            // then the controller will handle that uri to use specific method called edit_cash_advance() inside CashAdvanceController
            $("#formEditCashAdvance").submit(function(event){
                event.preventDefault();
                if($('#txtAddCashAdvanceNo').val() == 'You need 10,000 above'){
                    alert('Cash Advance System does not accept below 10,000 pesos.')
                }else{
                    EditCashAdvance();
                    dataTableCashAdvance.draw();
                }
            });

            //====================== EDIT MODE OF PAYMENT ( ONCHANGE ) ======================
            $('#selectEditModeOfPayment').change(function() {
                if($(this).val() == 'Payroll Account'){
                    // $("#txtEditPayrollAccountNo").removeAttr('disabled', false);
                    $("#txtEditPayrollAccountNo").focus();
                    $("#txtEditPayrollAccountNo").prop('required', true);
                }
                else{
                    $("#txtEditPayrollAccountNo").attr("disabled", "disabled");
                    $("#txtEditPayrollAccountNo").val('');
                }
                if($(this).val() == 'GCash'){
                    $("#txtEditGcashAccountNo").removeAttr('disabled', 'disabled');
                    $("#txtEditGcashAccountNo").focus();
                    $("#txtEditGcashAccountNo").prop('required', true);
                }else{
                    $("#txtEditGcashAccountNo").attr("disabled", "disabled");
                    $("#txtEditGcashAccountNo").val('');
                }
            });

            // ============================== EDIT CASH ADVANCE FETCH DATA ==============================
            $("#txtEditEmployeeNo").keypress(function(){
				$(this).val($(this).val().toUpperCase());
			});
            $("#txtEditEmployeeNo").keyup(function() {
                var empNo = $(this).val();
                empNo.toUpperCase();
                // console.log(empNo);

                if(empNo != null ){
                    $.ajax({
                        url: 'get_employee_info',
                        method: 'get',
                        data: {
                            'emp_no': empNo
                        },
                        // dataType: 'text',
                        beforeSend: function(){
                            $("input[name='official_station']", $("#formEditCashAdvance")).val();
                            $("input[name='position']", $("#formEditCashAdvance")).val();
                            // console.log(value);
                        },
                        success: function(result){
                            if(result['data'] != null){
                                $("input[name='applicant_name']", $("#formEditCashAdvance")).val(result['data']['FirstName'] + " " + result['data']['LastName']);
                                $("input[name='position']", $("#formEditCashAdvance")).val(result['data']['position_info']['Position']);
                                // $("input[name='official_station']", $("#formEditCashAdvance")).val(result['data']['department_info']['Department']);
                                $("input[name='official_station']", $("#formEditCashAdvance")).val(result['data']['department_info']['Department'] + '/' + result['data']['section_info']['Section']);

                            }else{
                                $("input[name='applicant_name']", $("#formEditCashAdvance")).val('');
                                $("input[name='position']", $("#formEditCashAdvance")).val('');
                                $("input[name='official_station']", $("#formEditCashAdvance")).val('');

                                $('#selectEditModeOfPayment').val('').trigger('change');
                                // Optional for clearing values
                                // $("#txtAddAppName").val('');
                                // $("#txtAddos").val('');
                                // $("#txtAddpos").val('');
                            }
                        }
                    });
                }else{
                    $("#txtEditApplicantName").val('');
                    $("#txtEditOfficialStation").val('');
                    $("#txtEditPosition").val('');
                }
            }); // ADD CASH ADVANCE FETCH DATA

            // ============================== EDIT CA AMOUNT CONVERT TO WORD ==============================
            $(function() {
                var words="";
                var currency="";
                $("#txtEditAmountOfCashAdvance").on("keydown keyup", per);
                $('.radioBtn').on('click', function(){
                    $('#txtEditAmountOfCashAdvance').val('');
                    $('#txtEditConvertToWord').val('');
                    if($('.peso').is(":checked")){
                        currency = $('.peso').val();
                        // console.log(currency);
                    }
                    if($('.dollar').is(":checked")){
                        currency = $('.dollar').val();
                        // console.log(currency);
                    }
                    if($('.yen').is(":checked")){
                        currency = $('.yen').val();
                        // console.log(currency);
                    }
                })

                function per() {
                    var totalamount = (
                        Number($("#txtEditAmountOfCashAdvance").val())
                    );
                    words = toWords(totalamount);
                    $("#txtEditConvertToWord").val(words + currency + " Only");
                }
            }); // END EDIT CA AMOUNT CONVERT TO WORD

            // ============================== APPROVE BUTTON ==============================
            // actionApproveRemark is generated by datatables and open the modalApproveRemark(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionApproveRemark', function(){
                let userApproverStat = $(this).attr('status'); // the status will collect the value (1-, 2-, 3-, 4-, 5-, 6- 7-)
                let cash_AdvanceId = $(this).attr('cash_advance-id'); // the cash_advance-id(attr) is inside the datatables of UserController that will be use to collect the cash_advance-id

                $("#approvedCashAdvanceUserStat").val(userApproverStat); // collect the user status id the default is 2, this will be use to change the user status when the formApproveCashAdvanceRemark(form) is submitted
                $("#approvedCashAdvanceUserId").val(cash_AdvanceId); // after clicking the actionApproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
            });

            // The ChangeUserStatus(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formChangeUserStat(form) of data(input) in the uri(change_user_stat)
            // then the controller will handle that uri to use specific method called change_user_stat() inside UserController
            $("#formApproveCashAdvanceRemark").submit(function(event){
                event.preventDefault();
                ApprovedCashAdvance();
            });

            // ============================== DISAPPROVE BUTTON ==============================
            $(document).on('click', '.actionDisapproveRemark', function(){
                let userApproverStat = $(this).attr('status'); // the status will collect the value (1-, 2-, 3-, 4-, 5-, 6- 7-)
                let cash_AdvanceId = $(this).attr('cash_advance-id'); // the cash_advance-id(attr) is inside the datatables of CashAdvanceController that will be use to collect the cash_advance-id
                let remarks = $(this).attr('remarks'); // the cash_advance-id(attr) is inside the datatables of CashAdvanceController that will be use to collect the cash_advance-id

                $("#disapprovedCashAdvanceStat").val(userApproverStat); // collect the user status id the default is 2, this will be use to change the user status when the formApproveCashAdvanceRemark(form) is submitted
                $("#disapprovedCashAdvanceId").val(cash_AdvanceId); // after clicking the actionApproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
                $("#classification_remarks").val(remarks); // after clicking the actionDisapproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
            });

            $("#formDisapproveCashAdvanceRemark").submit(function(event){
                event.preventDefault();
                DisapprovedCashAdvance();
            });

            // ============================== ADD PRESIDENT BUTTON ==============================
            // actionApproveRemark is generated by datatables and open the modalApproveRemark(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionAddPresident', function(){
                let cash_advance_id = $(this).attr('cash_advance-id');

             // after clicking the actionEditCashAdvance(button) the cash_advanceId will be pass to the txtEditCashAdvanceId(input=hidden) and when the form is submitted this
                // will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the report
                $("#addPresidentCashAdvanceId").val(cash_advance_id);
            });

            // The ChangeUserStatus(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formChangeUserStat(form) of data(input) in the uri(change_user_stat)
            // then the controller will handle that uri to use specific method called change_user_stat() inside UserController
            $("#formAddPresident").submit(function(event){
                event.preventDefault();
                AddPresident();
            });

            //================================ AUTO GENERATE CA NO ================================
            $('#txtAddAmountOfCashAdvance').keyup(function(){
                // console.log('eqwe');
                ca_auto_generate = $(this).val();
                var currency = "";

                if($('.peso').is(":checked")){
                    currency = $('.peso').val();
                    // console.log(currency);
                }
                if($('.dollar').is(":checked")){
                    currency = $('.dollar').val();
                    // console.log(currency);
                }
                if($('.yen').is(":checked")){
                    currency = $('.yen').val();
                    // console.log(currency);
                }

                $.ajax({
                    url: "get_ca_no_records",
                    method: "get",
                    data: {
                    ca_auto_generate: ca_auto_generate,
                    currency: currency,
                    },
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        // console.log(response);
                        $('#txtAddCashAdvanceNo').val(response['cash_advance_ca_no']);
                    },
                });
            });

            //======================== CASH ADVANCE AMOUNT CURRENCY ========================
            $('.peso, .dollar, .yen').on('click', function() {
                // $('#txtAddAmountOfCashAdvanceCurrency').attr('checked', 'checked');
                if($(this).is(":checked")){
                    $("#txtAddAmountOfCashAdvance").removeAttr('disabled', true);
                    $("#txtEditAmountOfCashAdvance").removeAttr('readonly', false);
                }
                else{
                    // $("#txtAddAmountOfCashAdvance").removeAttr('disabled', true);
                }
            });

            // ============================ AUTO ADD PRESIDENT ============================
            $('#txtAddAmountOfCashAdvance').keyup(function(){
                $.ajax({
                    url: "get_president",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        // console.log(response);
                        if($('#txtAddAmountOfCashAdvance').val()  > 99999){
                            $('#selectAddPresident').val(response['get_president'][0]['rapidx_id']).trigger('change');
                            // console.log(response['get_president'][0]['rapidx_id']);
                        }
                        else{
                            $("#selectAddPresident").val('').trigger('change');
                        }
                    },
                });
            });

            $('#txtEditAmountOfCashAdvance').keyup(function(){
                $.ajax({
                    url: "get_president",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){
                    },
                    success: function(response){
                        // console.log(response);
                        if($('#txtEditAmountOfCashAdvance').val()  > 99999){
                            $('#selectEditPresident').val(response['get_president'][0]['rapidx_id']).trigger('change');
                            // console.log(response['get_president'][0]['rapidx_id']);
                        }
                        else{
                            $("#selectEditPresident").val('').trigger('change');
                        }
                    },
                });
            });

            // ============================== ADD PREVIOUS ADVANCE ==============================
            $(document).on('click', '.actionPreviousAdvance', function(){
                // let previousAdvanceStat = $(this).attr('cashier_previous_advance'); // the status will collect the value (1-, 2-, 3-, 4-, 5-, 6- 7-)
                let cash_AdvanceId = $(this).attr('cash_advance-id'); // the cash_advance-id(attr) is inside the datatables of CashAdvanceController that will be use to collect the cash_advance-id
                let remarks = $(this).attr('remarks'); // the cash_advance-id(attr) is inside the datatables of CashAdvanceController that will be use to collect the cash_advance-id

                GetPreviousAdvance(cash_AdvanceId);

                // $("#cashierPreviousAdvanceStat").val(userApproverStat); // collect the user status id the default is 2, this will be use to change the user status when the formApproveCashAdvanceRemark(form) is submitted
                $("#cashierPreviousAdvanceId").val(cash_AdvanceId); // after clicking the actionApproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
                $("#txtPreviousAdvanceRemarks").val(remarks); // after clicking the actionDisapproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
                $("#txtPreviousAdvance").prop('required', true);
            });

            $("#formPreviousAdvance").submit(function(event){
                event.preventDefault();
                PreviousAdvance();
            });

            // ============================== DATE OF CASH RECEIVED ==============================
            $(document).on('click', '.actionDateCashReceived', function(){
                // let previousAdvanceStat = $(this).attr('cashier_previous_advance'); // the status will collect the value (1-, 2-, 3-, 4-, 5-, 6- 7-)
                let cash_AdvanceId = $(this).attr('cash_advance-id'); // the cash_advance-id(attr) is inside the datatables of CashAdvanceController that will be use to collect the cash_advance-id

                $("#dateId").val(cash_AdvanceId); // after clicking the actionApproveRemark(button) the userId will be pass to the approvedCashAdvanceUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect cash_advance-id that will be use to query the cash_advance-id in the CashAdvanceController to update the status of the user
            });

            $("#formDateCashReceived").submit(function(event){
                event.preventDefault();
                DateCashReceived();
            });

            // ================================= RE-UPLOAD FILE =================================
            $('#check_box').on('click', function() {
                    $('#check_box').attr('checked', 'checked');
                    if($(this).is(":checked")){
                        $("#txtEditFile").removeClass('d-none');
                        $("#txtEditReuploadFile").addClass('d-none');
                    }
                    else{
                        $("#txtEditFile").addClass('d-none');
                        $("#txtEditReuploadFile").removeClass('d-none');
                    }
                    $(document).ready(function(){
                        $('#modalEditCashAdvance').on('hide.bs.modal', function() {
                            $('#check_box').attr('checked', false);
                            window.location.reload();
                        });
                    });
                });

                // ================================= AUTO ADD REQUESTOR BY USER =================================
                $('#btnShowAddCashAdvanceModal').on('click', function(){
                    $.ajax({
                        url: "get_rapidx_user",
                        method: "get",
                        dataType: "json",
                        beforeSend: function(){
                        },
                        success: function(response){
                            let result = response['get_user'];
                            // console.log(result[0].name);
                            $('#txtAddRequestedBy').val(result[0].name);
                            // $('#txtEditRequestedBy').val(result[0].name);
                        },
                    });
                });

            // auto resize the textareas
            document.querySelectorAll("textarea").forEach(function (size) {
                size.addEventListener("input", function () {
                    var resize = window.getComputedStyle(this);
                    // reset height to allow textarea to shrink again
                    this.style.height = "auto";
                    // when "box-sizing: border-box" we need to add vertical border size to scrollHeight
                    this.style.height = (this.scrollHeight + parseInt(resize.getPropertyValue("border-top-width")) + parseInt(resize.getPropertyValue("border-bottom-width"))) + "px";
                });
            });

             // ============================== DATE LIQUIDATED ==============================
            $(document).on('click', '.actionDateLiquidated', function(){
                let cash_AdvanceId = $(this).attr('cash_advance-id');
                $("#dateliquidatedId").val(cash_AdvanceId);
            });

            $("#formDateLiquidated").submit(function(event){
                event.preventDefault();
                DateLiquidated();
            });

            function reloadCashAdvanceDataTable() {
            dataTableCashAdvance.draw();
            dataTableCashAdvanceApproved.draw();
            dataTableCashAdvanceDisapproved.draw();
            dataTableCashAdvanceLiquidated.draw();
            }
            $("#modalApproveRemark").on('hidden.bs.modal', function () {
                console.log('DataTable Reload Successfully');
                reloadCashAdvanceDataTable();
            });
            $("#modalDisapproveRemark").on('hidden.bs.modal', function () {
                console.log('DataTable Reload Successfully');
                reloadCashAdvanceDataTable();
            });
            $("#modalDateCashReceived").on('hidden.bs.modal', function () {
            console.log('DataTable Reload Successfully');
            reloadCashAdvanceDataTable();
        });
            $("#modalDateLiquidated").on('hidden.bs.modal', function () {
                console.log('DataTable Reload Successfully');
                reloadCashAdvanceDataTable();
            });


            $(document).on('click','.actionCancelCA', function(){
                let caId = $(this).attr('cash_advance-id');
                $('#cancelCAId').val(caId);
            });

            $('#formCancel').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "cancel_cash_advance",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if(response['result'] == 1){
                            toastr.success('Cancelled!!');
                            $('#modalCancel').modal('hide');
                            $('#formCancel')[0].reset();
                            dataTableCashAdvanceApproved.draw();
                        }
                    }
                });
            });

        }); // JQUERY DOCUMENT READY END

    </script>
@endsection

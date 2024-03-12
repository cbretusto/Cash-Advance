//============================== ADD CASH ADVANCE ==============================
function AddCashAdvance(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    let formData = new FormData($('#formAddCashAdvance')[0]);

	$.ajax({
        url: "add_cash_advance",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddCashAdvanceIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddCashAdvance").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving Failed!');
                if(response['error']['ca_no'] === undefined){
                    $("#txtAddCashAdvanceNo").removeClass('is-invalid');
                    $("#txtAddCashAdvanceNo").attr('title', '');
                }
                else{
                    $("#txtAddCashAdvanceNo").addClass('is-invalid');
                    $("#txtAddCashAdvanceNo").attr('title', response['error']['ca_no']);
                }

                if(response['error']['date_applied'] === undefined){
                    $("#txtAddDateApplied").removeClass('is-invalid');
                    $("#txtAddDateApplied").attr('title', '');
                }
                else{
                    $("#txtAddDateApplied").addClass('is-invalid');
                    $("#txtAddDateApplied").attr('title', response['error']['date_applied']);
                }

                if(response['error']['date_of_liquidation'] === undefined){
                    $("#txtAddDateOfLiquidation").removeClass('is-invalid');
                    $("#txtAddDateOfLiquidation").attr('title', '');
                }
                else{
                    $("#txtAddDateOfLiquidation").addClass('is-invalid');
                    $("#txtAddDateOfLiquidation").attr('title', response['error']['date_of_liquidation']);
                }

                if(response['error']['employee_no'] === undefined){
                    $("#txtAddEmployeeNo").removeClass('is-invalid');
                    $("#txtAddEmployeeNo").attr('title', '');
                }
                else{
                    $("#txtAddEmployeeNo").addClass('is-invalid');
                    $("#txtAddEmployeeNo").attr('title', response['error']['employee_no']);
                }
                if(response['error']['mode_of_payment'] === undefined){
                    $("#selectAddModeOfPayment").removeClass('is-invalid');
                    $("#selectAddModeOfPayment").attr('title', '');
                }
                else{
                    $("#selectAddModeOfPayment").addClass('is-invalid');
                    $("#selectAddModeOfPayment").attr('title', response['error']['mode_of_payment']);
                }
                if(response['error']['applicant_name'] === undefined){
                    $("#txtAddApplicantName").removeClass('is-invalid');
                    $("#txtAddApplicantName").attr('title', '');
                }
                else{
                    $("#txtAddApplicantName").addClass('is-invalid');
                    $("#txtAddApplicantName").attr('title', response['error']['applicant_name']);
                }
                if(response['error']['payroll_account_no'] === undefined){
                    $("#txtAddPayrollAccountNo").removeClass('is-invalid');
                    $("#txtAddPayrollAccountNo").attr('title', '');
                }
                else{
                    $("#txtAddPayrollAccountNo").addClass('is-invalid');
                    $("#txtAddPayrollAccountNo").attr('title', response['error']['payroll_account_no']);
                }
                if(response['error']['position'] === undefined){
                    $("#txtAddPosition").removeClass('is-invalid');
                    $("#txtAddPosition").attr('title', '');
                }
                else{
                    $("#txtAddPosition").addClass('is-invalid');
                    $("#txtAddPosition").attr('title', response['error']['position']);
                }
                if(response['error']['gcash_account_no'] === undefined){
                    $("#txtAddGcashAccountNo").removeClass('is-invalid');
                    $("#txtAddGcashAccountNo").attr('title', '');
                }
                else{
                    $("#txtAddGcashAccountNo").addClass('is-invalid');
                    $("#txtAddGcashAccountNo").attr('title', response['error']['gcash_account_no']);
                }
                if(response['error']['official_station'] === undefined){
                    $("#txtAddOfficialStation").removeClass('is-invalid');
                    $("#txtAddOfficialStation").attr('title', '');
                }
                else{
                    $("#txtAddOfficialStation").addClass('is-invalid');
                    $("#txtAddOfficialStation").attr('title', response['error']['official_station']);
                }
                if(response['error']['local_no'] === undefined){
                    $("#selectAddLocalNo").removeClass('is-invalid');
                    $("#selectAddLocalNo").attr('title', '');
                }
                else{
                    $("#selectAddLocalNo").addClass('is-invalid');
                    $("#selectAddLocalNo").attr('title', response['error']['local_no']);
                }
                if(response['error']['amount_of_ca'] === undefined){
                    $("#txtAddAmountOfCashAdvance").removeClass('is-invalid');
                    $("#txtAddAmountOfCashAdvance").attr('title', '');
                }
                else{
                    $("#txtAddAmountOfCashAdvance").addClass('is-invalid');
                    $("#txtAddAmountOfCashAdvance").attr('title', response['error']['amount_of_ca']);
                }
                if(response['error']['amount_of_ca_currency'] === undefined){
                    $("#txtAddAmountOfCashAdvanceCurrency").removeClass('is-invalid');
                    $("#txtAddAmountOfCashAdvanceCurrency").attr('title', '');
                }
                else{
                    $("#txtAddAmountOfCashAdvanceCurrency").addClass('is-invalid');
                    $("#txtAddAmountOfCashAdvanceCurrency").attr('title', response['error']['amount_of_ca_currency']);
                }
                if(response['error']['purpose'] === undefined){
                    $("#txtAddPurpose").removeClass('is-invalid');
                    $("#txtAddPurpose").attr('title', '');
                }
                else{
                    $("#txtAddPurpose").addClass('is-invalid');
                    $("#txtAddPurpose").attr('title', response['error']['purpose']);
                }
                if(response['error']['requested_by'] === undefined){
                    $("#txtAddRequestedBy").removeClass('is-invalid');
                    $("#txtAddRequestedBy").attr('title', '');
                }
                else{
                    $("#txtAddRequestedBy").addClass('is-invalid');
                    $("#txtAddRequestedBy").attr('title', response['error']['requested_by']);
                }
                if(response['error']['uploaded_file'] === undefined){
                    $("#txtAddFile").removeClass('is-invalid');
                    $("#txtAddFile").attr('title', '');
                }
                else{
                    $("#txtAddFile").addClass('is-invalid');
                    $("#txtAddFile").attr('title', response['error']['uploaded_file']);
                }
                if(response['error']['supervisor'] === undefined){
                    $("#selectAddSupervisor").removeClass('is-invalid');
                    $("#selectAddSupervisor").attr('title', '');
                }
                else{
                    $("#selectAddSupervisor").addClass('is-invalid');
                    $("#selectAddSupervisor").attr('title', response['error']['supervisor']);
                }

                if(response['error']['sect_head'] === undefined){
                    $("#selectAddSectionHead").removeClass('is-invalid');
                    $("#selectAddSectionHead").attr('title', '');
                }
                else{
                    $("#selectAddSectionHead").addClass('is-invalid');
                    $("#selectAddSectionHead").attr('title', response['error']['sect_head']);
                }
                if(response['error']['dept_head'] === undefined){
                    $("#selectAddDepartmentHead").removeClass('is-invalid');
                    $("#selectAddDepartmentHead").attr('title', '');
                }
                else{
                    $("#selectAddDepartmentHead").addClass('is-invalid');
                    $("#selectAddDepartmentHead").attr('title', response['error']['dept_head']);
                }
                if(response['error']['previous_advance'] === undefined){
                    $("#txtAddPreviousAdvance").removeClass('is-invalid');
                    $("#txtAddPreviousAdvance").attr('title', '');
                }
                else{
                    $("#txtAddPreviousAdvance").addClass('is-invalid');
                    $("#txtAddPreviousAdvance").attr('title', response['error']['previous_advance']);
                }
                if(response['error']['payment_released_by'] === undefined){
                    $("#selectAddPaymentReleasedBy").removeClass('is-invalid');
                    $("#selectAddPaymentReleasedBy").attr('title', '');
                }
                else{
                    $("#selectAddPaymentReleasedBy").addClass('is-invalid');
                    $("#selectAddPaymentReleasedBy").attr('title', response['error']['payment_released_by']);
                }
                if(response['error']['treasury_head'] === undefined){
                    $("#selectAddTreasuryHead").removeClass('is-invalid');
                    $("#selectAddTreasuryHead").attr('title', '');
                }
                else{
                    $("#selectAddTreasuryHead").addClass('is-invalid');
                    $("#selectAddTreasuryHead").attr('title', response['error']['treasury_head']);
                }
                if(response['error']['finance_general_manager'] === undefined){
                    $("#selectAddFinanceGeneralManager").removeClass('is-invalid');
                    $("#selectAddFinanceGeneralManager").attr('title', '');
                }
                else{
                    $("#selectAddFinanceGeneralManager").addClass('is-invalid');
                    $("#selectAddFinanceGeneralManager").attr('title', response['error']['finance_general_manager']);
                }
                if(response['error']['president'] === undefined){
                    $("#selectAddPresident").removeClass('is-invalid');
                    $("#selectAddPresident").attr('title', '');
                }
                else{
                    $("#selectAddPresident").addClass('is-invalid');
                    $("#selectAddPresident").attr('title', response['error']['president']);
                }
            }
            else{
                if(response['result'] == 1){
                    $("#modalAddCashAdvance").modal('hide');
                    $("#formAddCashAdvance")[0].reset();
                    toastr.success('Succesfully Saved!');
                    dataTableCashAdvance.draw(); // reload the tables after insertion
                }else{
                    alert('Cash Advance No. "'+$("#txtAddCashAdvanceNo").val()+'" is already exist! '+"\n\n"+' Please refresh the browser to process the request once again.')
                }
            }

            // if(response['result'] == 0){
            //     alert('Cash Advance No. "'+$("#txtAddCashAdvanceNo").val()+'" is already exist! '+"\n\n"+' Please refresh the browser to process the request once again.')
            // }

            $("#iBtnAddCashAdvanceIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddCashAdvance").removeAttr('disabled');
            $("#iBtnAddCashAdvanceIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddCashAdvanceIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddCashAdvance").removeAttr('disabled');
            $("#iBtnAddCashAdvanceIcon").addClass('fa fa-check');
        }
    });
}

//============================== GET LOCAL NO ==============================
function GetLocalNo(cboElement)
{
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "get_local_no",
    method: "get",
    dataType: "json",

    beforeSend: function(){
        result = '<option value="0" selected disabled> -- Loading -- </option>';
        cboElement.html(result);
    },
    success: function(response){
        result = '';

        if(response['phone_dir'].length > 0){
            result = '<option value="0" selected disabled> -- Local No. -- </option>';
            for(let index = 0; index < response['phone_dir'].length; index++){
                result += '<option value="' + response['phone_dir'][index].phone_number +' - '+ response['phone_dir'][index].location + '">' + response['phone_dir'][index].assigned_user + ', '+response['phone_dir'][index].location +' (#'+response['phone_dir'][index].phone_number +') </option>';
            }
            // console.log('qweqwe');
        }
        else{
            result = '<option value="0" selected disabled> No record found </option>';
        }
        cboElement.html(result);
    // console.log(response);
    }

    });
}

//=================================== DIGITS CONVERT TO WORD ===================================
function toWords(number) {
    var zero = ["Zero","One","Two","Three","Four","Five","Six","Seven","Eight","Nine",];

    var ten = ["Ten","Eleven","Twelve","Thirteen","Fourteen","Fifteen","Sixteen","Seventeen","Eighteen","Nineteen",];

    var twenty = ["Twenty","Thirty","Forty","Fifty","Sixty","Seventy","Eighty","Ninety",];

    var thousand = ["", "Thousand", "Million", "Billion", "Trillion"];

    number = number.toString();
    number = number.replace(/[\, ]/g, "");

    if (number != parseFloat(number))
        return "not a number";
        var x = number.indexOf(".");

    if (x == -1) x = number.length;

    if (x > 15) return "too big";
        var number1 = number.split("");
        var str = "";
        var str1 = 0;

    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (number1[i] == "1") {
                str += ten[Number(number1[i + 1])] + " ";
                i++;
                str1 = 1;
            } else if (number1[i] != 0) {
                str += twenty[number1[i] - 2] + " ";
                str1 = 1;
            }
        }else if (number1[i] != 0) {
            str += zero[number1[i]] + " ";
            if ((x - i) % 3 == 0) str += "Hundred ";
            str1 = 1;
        }

        if ((x - i) % 3 == 1) {
            if (str1) str += thousand[(x - i - 1) / 3] + " ";
            str1 = 0;
        }
    }
    if (x != number.length) {
        var y = number.length;
        str += "point ";
        for (var i = x + 1; i < y; i++) str += zero[number1[i]] + " ";
    }
    return str.replace(/\number+/g, " ");
}

//============================== EDIT CASH ADVANCE ==============================
function EditCashAdvance(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };
    let formData = new FormData($('#formEditCashAdvance')[0]);

    $.ajax({
        url: "edit_cash_advance",
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditCashAdvanceIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditCashAdvance").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating Cash Advance Failed!');

                if(response['error']['ca_no'] === undefined){
                    $("#txtEditCashAdvanceNo").removeClass('is-invalid');
                    $("#txtEditCashAdvanceNo").attr('title', '');
                }
                else{
                    $("#txtEditCashAdvanceNo").addClass('is-invalid');
                    $("#txtEditCashAdvanceNo").attr('title', response['error']['ca_no']);
                }

                if(response['error']['date_applied'] === undefined){
                    $("#txtEditDateApplied").removeClass('is-invalid');
                    $("#txtEditDateApplied").attr('title', '');
                }
                else{
                    $("#txtEditDateApplied").addClass('is-invalid');
                    $("#txtEditDateApplied").attr('title', response['error']['date_applied']);
                }

                if(response['error']['date_of_liquidation'] === undefined){
                    $("#txtEditDateOfLiquidation").removeClass('is-invalid');
                    $("#txtEditDateOfLiquidation").attr('title', '');
                }
                else{
                    $("#txtEditDateOfLiquidation").addClass('is-invalid');
                    $("#txtEditDateOfLiquidation").attr('title', response['error']['date_of_liquidation']);
                }

                if(response['error']['employee_no'] === undefined){
                    $("#txtEditEmployeeNo").removeClass('is-invalid');
                    $("#txtEditEmployeeNo").attr('title', '');
                }
                else{
                    $("#txtEditEmployeeNo").addClass('is-invalid');
                    $("#txtEditEmployeeNo").attr('title', response['error']['employee_no']);
                }
                if(response['error']['mode_of_payment'] === undefined){
                    $("#selectEditModeOfPayment").removeClass('is-invalid');
                    $("#selectEditModeOfPayment").attr('title', '');
                }
                else{
                    $("#selectEditModeOfPayment").addClass('is-invalid');
                    $("#selectEditModeOfPayment").attr('title', response['error']['mode_of_payment']);
                }
                if(response['error']['applicant_name'] === undefined){
                    $("#txtEditApplicantName").removeClass('is-invalid');
                    $("#txtEditApplicantName").attr('title', '');
                }
                else{
                    $("#txtEditApplicantName").addClass('is-invalid');
                    $("#txtEditApplicantName").attr('title', response['error']['applicant_name']);
                }
                if(response['error']['payroll_account_no'] === undefined){
                    $("#txtEditPayrollAccountNo").removeClass('is-invalid');
                    $("#txtEditPayrollAccountNo").attr('title', '');
                }
                else{
                    $("#txtEditPayrollAccountNo").addClass('is-invalid');
                    $("#txtEditPayrollAccountNo").attr('title', response['error']['payroll_account_no']);
                }
                if(response['error']['position'] === undefined){
                    $("#txtEditPosition").removeClass('is-invalid');
                    $("#txtEditPosition").attr('title', '');
                }
                else{
                    $("#txtEditPosition").addClass('is-invalid');
                    $("#txtEditPosition").attr('title', response['error']['position']);
                }
                if(response['error']['gcash_account_no'] === undefined){
                    $("#txtEditGcashAccountNo").removeClass('is-invalid');
                    $("#txtEditGcashAccountNo").attr('title', '');
                }
                else{
                    $("#txtEditGcashAccountNo").addClass('is-invalid');
                    $("#txtEditGcashAccountNo").attr('title', response['error']['gcash_account_no']);
                }
                if(response['error']['official_station'] === undefined){
                    $("#txtEditOfficialStation").removeClass('is-invalid');
                    $("#txtEditOfficialStation").attr('title', '');
                }
                else{
                    $("#txtEditOfficialStation").addClass('is-invalid');
                    $("#txtEditOfficialStation").attr('title', response['error']['official_station']);
                }
                if(response['error']['local_no'] === undefined){
                    $("#selectEditLocalNo").removeClass('is-invalid');
                    $("#selectEditLocalNo").attr('title', '');
                }
                else{
                    $("#selectEditLocalNo").addClass('is-invalid');
                    $("#selectEditLocalNo").attr('title', response['error']['local_no']);
                }
                if(response['error']['amount_of_ca'] === undefined){
                    $("#txtEditAmountOfCashAdvance").removeClass('is-invalid');
                    $("#txtEditAmountOfCashAdvance").attr('title', '');
                }
                else{
                    $("#txtEditAmountOfCashAdvance").addClass('is-invalid');
                    $("#txtEditAmountOfCashAdvance").attr('title', response['error']['amount_of_ca']);
                }
                if(response['error']['purpose'] === undefined){
                    $("#txtEditPurpose").removeClass('is-invalid');
                    $("#txtEditPurpose").attr('title', '');
                }
                else{
                    $("#txtEditPurpose").addClass('is-invalid');
                    $("#txtEditPurpose").attr('title', response['error']['purpose']);
                }
                if(response['error']['requested_by'] === undefined){
                    $("#txtEditRequestedBy").removeClass('is-invalid');
                    $("#txtEditRequestedBy").attr('title', '');
                }
                else{
                    $("#txtEditRequestedBy").addClass('is-invalid');
                    $("#txtEditRequestedBy").attr('title', response['error']['requested_by']);
                }
                if(response['error']['uploaded_file'] === undefined){
                    $("#txtEditFile").removeClass('is-invalid');
                    $("#txtEditFile").attr('title', '');
                }
                else{
                    $("#txtEditFile").addClass('is-invalid');
                    $("#txtEditFile").attr('title', response['error']['uploaded_file']);
                }
                if(response['error']['supervisor'] === undefined){
                    $("#selectEditSupervisor").removeClass('is-invalid');
                    $("#selectEditSupervisor").attr('title', '');
                }
                else{
                    $("#selectEditSupervisor").addClass('is-invalid');
                    $("#selectEditSupervisor").attr('title', response['error']['supervisor']);
                }
                if(response['error']['sect_head'] === undefined){
                    $("#selectEditSectHead").removeClass('is-invalid');
                    $("#selectEditSectHead").attr('title', '');
                }
                else{
                    $("#selectEditSectHead").addClass('is-invalid');
                    $("#selectEditSectHead").attr('title', response['error']['sect_head']);
                }
                if(response['error']['dept_head'] === undefined){
                    $("#selectEditDeptHead").removeClass('is-invalid');
                    $("#selectEditDeptHead").attr('title', '');
                }
                else{
                    $("#selectEditDeptHead").addClass('is-invalid');
                    $("#selectEditDeptHead").attr('title', response['error']['dept_head']);
                }
                if(response['error']['previous_advance'] === undefined){
                    $("#txtEditPreviousAdvance").removeClass('is-invalid');
                    $("#txtEditPreviousAdvance").attr('title', '');
                }
                else{
                    $("#txtEditPreviousAdvance").addClass('is-invalid');
                    $("#txtEditPreviousAdvance").attr('title', response['error']['previous_advance']);
                }
                if(response['error']['payment_released_by'] === undefined){
                    $("#selectEditaymentReleasedBy").removeClass('is-invalid');
                    $("#selectEditaymentReleasedBy").attr('title', '');
                }
                else{
                    $("#selectEditaymentReleasedBy").addClass('is-invalid');
                    $("#selectEditaymentReleasedBy").attr('title', response['error']['payment_released_by']);
                }
                if(response['error']['treasury_head'] === undefined){
                    $("#selectEditTreasuryHead").removeClass('is-invalid');
                    $("#selectEditTreasuryHead").attr('title', '');
                }
                else{
                    $("#selectEditTreasuryHead").addClass('is-invalid');
                    $("#selectEditTreasuryHead").attr('title', response['error']['treasury_head']);
                }
                if(response['error']['finance_general_manager'] === undefined){
                    $("#selectEditFinanceGeneralManager").removeClass('is-invalid');
                    $("#selectEditFinanceGeneralManager").attr('title', '');
                }
                else{
                    $("#selectEditFinanceGeneralManager").addClass('is-invalid');
                    $("#selectEditFinanceGeneralManager").attr('title', response['error']['finance_general_manager']);
                }
            }else{
                if(response['result'] == 1){
                    $("#modalEditCashAdvance").modal('hide');
                    $("#formEditCashAdvance")[0].reset();

                    dataTableCashAdvance.draw();
                    toastr.success('Succesfully Saved!');
                }else{
                    toastr.warning(response['tryCatchError']);
                }
            }

            $("#iBtnEditCashAdvanceIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditCashAdvance").removeAttr('disabled');
            $("#iBtnEditCashAdvanceIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditCashAdvanceIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditCashAdvance").removeAttr('disabled');
            $("#iBtnEditCashAdvanceIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT CASH ADVANCE BY ID TO EDIT ==============================
function GetCashAdvanceByIdToEdit(cash_AdvanceId){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "get_cash_advance_by_id",
        method: "get",
        data: {
            cash_advance_id: cash_AdvanceId
        },
        dataType: "json",
        beforeSend: function(){
        },
        success: function(response){
            let cash_advances = response['cash_advance'];
            let cash_advance_approver = response['cash_advance_approver'];
            let cash_advances_supervisor_approver = response['cash_advances_supervisor_approver'];

            if(cash_advances.length > 0){
                $("#txtEditCashAdvanceNo")      .val(cash_advances[0].ca_no);
                $("#txtEditDateApplied")        .val(cash_advances[0].date_applied);
                $("#txtEditDateOfLiquidation")  .val(cash_advances[0].date_of_liquidation);
                $("#txtEditEmployeeNo")         .val(cash_advances[0].employee_no);
                $("#selectEditModeOfPayment")   .val(cash_advances[0].mode_of_payment).trigger('change');
                $("#txtEditApplicantName")      .val(cash_advances[0].applicant_name);
                $("#txtEditPayrollAccountNo")   .val(cash_advances[0].payroll_account_no);
                $("#txtEditPosition")           .val(cash_advances[0].position);
                $("#txtEditGcashAccountNo")     .val(cash_advances[0].gcash_account_no);
                $("#txtEditOfficialStation")    .val(cash_advances[0].official_station);
                $("#txtEditAmountOfCashAdvance").val(cash_advances[0].amount_of_ca);
                $("#txtEditConvertToWord")      .val(cash_advances[0].ca_convert_to_word);
                $("#txtEditPurpose")            .val(cash_advances[0].purpose);
                $("#txtEditRequestedBy")        .val(cash_advances[0].requested_by);
                $("#txtEditReuploadFile")       .val(cash_advances[0].uploaded_file);
                $("#txtEditPreviousAdvance")    .val(cash_advances[0].previous_advance);
                $("#txtEditDate")               .val(cash_advances[0].date);
                $("#selectEditLocalNo")         .val(cash_advances[0].local_no).trigger('change');

                $("#selectEditSupervisor")              .val(cash_advances_supervisor_approver[0].supervisor).trigger('change');
                $("#selectEditSectionHead")             .val(cash_advance_approver[0].section_head).trigger('change');
                $("#selectEditDepartmentHead")          .val(cash_advance_approver[0].department_head).trigger('change');
                $("#selectEditPaymentReleasedBy")       .val(cash_advance_approver[0].cashier).trigger('change');
                $("#selectEditTreasuryHead")            .val(cash_advance_approver[0].treasury_head).trigger('change');
                $("#selectEditFinanceGeneralManager")   .val(cash_advance_approver[0].finance_general_manager).trigger('change');
                $("#selectEditPresident")               .val(cash_advance_approver[0].president).trigger('change');

                if(cash_advances[0].amount_of_ca_currency == 'Pesos'){
                    $(".peso ").prop("checked",true);
                    console.log('peso')
                }else if (cash_advances[0].amount_of_ca_currency == 'Dollars'){
                    $(".dollar").prop("checked",true);
                    console.log('dollar')
                }else if (cash_advances[0].amount_of_ca_currency == 'Yen'){
                    $(".yen").prop("checked",true);
                    console.log('yen')
                }

                $('#modalEditCashAdvance').on('hide', function() {
                    window.location.reload();
                });
            }
            else{
                toastr.warning('No Record Found!');
            }
        },

        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== APPROVE BUTTON ==============================
function ApprovedCashAdvance(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "approved_cash_advance",
        method: "post",
        data: $('#formApproveCashAdvanceRemark').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnApproveIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnApprove").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Cannot Approve!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Already Approved');
                }

                $("#modalApproveRemark").modal('hide');
                $("#formApproveCashAdvanceRemark")[0].reset();
                dataTableCashAdvance.draw();
            }

            $("#iBtnApproveIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnApprove").removeAttr('disabled');
            $("#iBtnApproveIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnApproveIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnApprove").removeAttr('disabled');
            $("#iBtnApproveIcon").addClass('fa fa-check');
        }
    });
}

//============================== DISAPPROVE BUTTON ==============================
function DisapprovedCashAdvance(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "disapproved_cash_advance",
        method: "post",
        data: $('#formDisapproveCashAdvanceRemark').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnDisapproveRemarkIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnDisapproveRemark").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                if(response['error']['disapprove_remarks'] === undefined){
                    $("#txtDisapproveRemarks").removeClass('is-invalid');
                    $("#txtDisapproveRemarks").attr('title', '');
                }
                else{
                    $("#txtDisapproveRemarks").addClass('is-invalid');
                    $("#txtDisapproveRemarks").attr('title', response['error']['disapprove_remarks']);
                }

                toastr.error('Cannot Approve!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Disapproved');
                }

                $("#modalDisapproveRemark").modal('hide');
                $("#formDisapproveCashAdvanceRemark")[0].reset();
                dataTableCashAdvance.draw();
            }

            $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDisapproveRemark").removeAttr('disabled');
            $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDisapproveRemark").removeAttr('disabled');
            $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        }
    });

}

//============================== GET PRESIDENT ID ==============================
function GetPresidentID()
{
    $.ajax({

        url: "get_president_id",
        method: "get",
        data:{
        },

        dataType: "json",
        beforeSend: function(){

        },
        success: function(JsonObject){
            let president_id = JsonObject['president'];
            $("#addPresidentId").val(president_id[0].rapidx_id);
        },

        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== ADD PRESIDENT BUTTON ==============================
function AddPresident(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "add_president",
        method: "post",
        data: $('#formAddPresident').serialize(),
        dataType: "json",
        beforeSend: function(){
            // $("#iBtnAddPresidentIcon").addClass('fa fa-spinner fa-pulse');
            // $("#btnAddPresident").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('Cannot Add the President!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Successfully Added');
                }

                $("#modalAddPresident").modal('hide');
                // $("#formAddPresident")[0].reset();
                dataTableCashAdvance.draw();
            }

            // $("#iBtnAddPresidentIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnAddPresident").prop('disabled', 'disabled');
            // $("#iBtnAddPresidentIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            // $("#iBtnAddPresidentIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnAddPresident").prop('disabled', 'disabled');
            // $("#iBtnAddPresidentIcon").addClass('fa fa-check');
        }
    });
}

//============================== PREVIOUS ADVANCE ==============================
function PreviousAdvance(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "cashier_previous_advance",
        method: "post",
        data: $('#formPreviousAdvance').serialize(),
        dataType: "json",
        beforeSend: function(){
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").prop('disabled', 'disabled');
        },
        success: function(response){
            $("#txtPreviousAdvance").val(response['approve_cash_advance']);

            if(response['validation'] == 'hasError'){
                if(response['error']['previous_advance'] === undefined){
                    $("#txtPreviousAdvance").removeClass('is-invalid');
                    $("#txtPreviousAdvance").attr('title', '');
                }
                else{
                    $("#txtPreviousAdvance").addClass('is-invalid');
                    $("#txtPreviousAdvance").attr('title', response['error']['previous_advance']);
                }

                toastr.error('Cannot Approve!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Successfully Added');
                }

                $("#modalPreviousAdvance").modal('hide');
                $("#formPreviousAdvance")[0].reset();
                dataTableCashAdvance.draw();
            }

            // $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").removeAttr('disabled');
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            // $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").removeAttr('disabled');
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        }
    });

}

//=========================== ADD PREVIOUS ADVANCE ==========================
function GetPreviousAdvance(cash_AdvanceId){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "get_previous_advance",
        method: "get",
        data: {
            cash_advance_id: cash_AdvanceId
        },
        dataType: "json",
        beforeSend: function(){
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").prop('disabled', 'disabled');
        },
        success: function(response){
            $("#txtPreviousAdvance").val(response['get_previous_advance'][0].previous_advance);

            // $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").removeAttr('disabled');
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            // $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").removeAttr('disabled');
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        }
    });

}

//============================== DATE OF CASH RECEIVED ==============================
function DateCashReceived(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "date_cash_received",
        method: "post",
        data: $('#formDateCashReceived').serialize(),
        dataType: "json",
        beforeSend: function(){
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").prop('disabled', 'disabled');
        },
        success: function(response){
            $("#txtDate").val(response['approve_cash_advance']);

            if(response['validation'] == 'hasError'){
                if(response['error']['date'] === undefined){
                    $("#txtDate").removeClass('is-invalid');
                    $("#txtDate").attr('title', '');
                }
                else{
                    $("#txtDate").addClass('is-invalid');
                    $("#txtDate").attr('title', response['error']['date']);
                }

                toastr.error('Error!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Successfully Added');
                }

                $("#modalDateCashReceived").modal('hide');
                $("#formDateCashReceived")[0].reset();
                dataTableCashAdvance.draw();
            }

            // $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").removeAttr('disabled');
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            // $("#iBtnDisapproveRemarkIcon").removeClass('fa fa-spinner fa-pulse');
            // $("#btnDisapproveRemark").removeAttr('disabled');
            // $("#iBtnDisapproveRemarkIcon").addClass('fa fa-check');
        }
    });
}

//============================== DATE LIQUIDATED==============================
function DateLiquidated(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    $.ajax({
        url: "date_liquidated",
        method: "post",
        data: $('#formDateLiquidated').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnDateLiquidatedIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnDateLiquidated").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                if(response['error']['date_liquidated'] === undefined){
                    $("#txtDateLiquidated").removeClass('is-invalid');
                    $("#txtDateLiquidated").attr('title', '');
                }
                else{
                    $("#txtDateLiquidated").addClass('is-invalid');
                    $("#txtDateLiquidated").attr('title', response['error']['date_liquidated']);
                }

                toastr.error('Error!');
            }else{
                if(response['result'] == 1){
                    toastr.success('Successfully Added');
                }

                $("#modalDateLiquidated").modal('hide');
                $("#formDateLiquidated")[0].reset();
                dataTableCashAdvance.draw();
            }

            $("#iBtnDateLiquidatedIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDateLiquidated").removeAttr('disabled');
            $("#iBtnDateLiquidatedIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnDateLiquidatedIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnDateLiquidated").removeAttr('disabled');
            $("#iBtnDateLiquidatedIcon").addClass('fa fa-check');
        }
    });
}

//============================== ADD USER ==============================
function AddUser(){
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
        url: "add_user",
        method: "post",
        data: $('#formAddUser').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnAddUserIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnAddUser").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Saving User Failed!');

                if(response['error']['employee_no'] === undefined){
                    $("#txtAddUserEmployeeNo").removeClass('is-invalid');
                    $("#txtAddUserEmployeeNo").attr('title', '');
                }
                else{
                    $("#txtAddUserEmployeeNo").addClass('is-invalid');
                    $("#txtAddUserEmployeeNo").attr('title', response['error']['employee_no']);
                }

                if(response['error']['classification'] === undefined){
                    $("#selectAddUserClassification").removeClass('is-invalid');
                    $("#selectAddUserClassification").attr('title', '');
                }
                else{
                    $("#selectAddUserClassification").addClass('is-invalid');
                    $("#selectAddUserClassification").attr('title', response['error']['classification']);
                }
            }
            else if(response['result'] == 1){
                $("#modalAddUser").modal('hide');
                $("#formAddUser")[0].reset();
                toastr.success('User was succesfully saved!');
                dataTableUsers.draw(); // reload the tables after insertion
            }

            $("#iBtnAddUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddUser").removeAttr('disabled');
            $("#iBtnAddUserIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnAddUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnAddUser").removeAttr('disabled');
            $("#iBtnAddUserIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER ==============================
function EditUser(){
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
        url: "edit_user",
        method: "post",
        data: $('#formEditUser').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnEditUserIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnEditUser").prop('disabled', 'disabled');
        },
        success: function(response){
            if(response['validation'] == 'hasError'){
                toastr.error('Updating Approver Failed!');

                if(response['error']['employee_no'] === undefined){
                    $("#txtEditUserEmployeeNo").removeClass('is-invalid');
                    $("#txtEditUserEmployeeNo").attr('title', '');
                }
                else{
                    $("#txtEditUserEmployeeNo").addClass('is-invalid');
                    $("#txtEditUserEmployeeNo").attr('title', response['error']['employee_no']);
                }

                if(response['error']['classification'] === undefined){
                    $("#selectEditUserClassification").removeClass('is-invalid');
                    $("#selectEditUserClassification").attr('title', '');
                }
                else{
                    $("#selectEditUserClassification").addClass('is-invalid');
                    $("#selectEditUserClassification").attr('title', response['error']['classification']);
                }
            }
            else if(response['result'] == 1){
                $("#modalEditUser").modal('hide');
                $("#formEditUser")[0].reset();
                toastr.success('User was succesfully saved!');
                dataTableUsers.draw(); // reload the tables after insertion
            }

            $("#iBtnEditUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditUser").removeAttr('disabled');
            $("#iBtnEditUserIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnEditUserIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnEditUser").removeAttr('disabled');
            $("#iBtnEditUserIcon").addClass('fa fa-check');
        }
    });
}

//============================== EDIT USER BY ID TO EDIT ==============================
function GetUserByIdToEdit(userId){
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
        url: "get_user_by_id",
        method: "get",
        data: {
            user_id: userId
        },
        dataType: "json",
        beforeSend: function(){    
        },
        success: function(response){
            let user = response['user'];
            if(user.length > 0){
                $("#txtEditUserEmployee_no").val(user[0].employee_no);
                $("#selectEditRapidxUser").val(user[0].rapidx_user).trigger('change');
                // console.log(user[0].rapidx_user);
                $("selectEditUserClassification").val(user[0].classification).trigger('change');
            }
            else{
                toastr.warning('No User Record Found!');
            }
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}

//============================== CHANGE USER STATUS ==============================
function ChangeUserStatus(){
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
        url: "change_user_stat",
        method: "post",
        data: $('#formChangeUserStat').serialize(),
        dataType: "json",
        beforeSend: function(){
            $("#iBtnChangeUserStatIcon").addClass('fa fa-spinner fa-pulse');
            $("#btnChangeUserStat").prop('disabled', 'disabled');
        },
        success: function(response){

            if(response['validation'] == 'hasError'){
                toastr.error('User activation failed!');
            }else{
                if(response['result'] == 1){
                    if($("#txtChangeUserStatUserStat").val() == 1){
                        toastr.success('User activation success!');
                        $("#txtChangeUserStatUserStat").val() == 2;
                    }
                    else{
                        toastr.success('User deactivation success!');
                        $("#txtChangeUserStatUserStat").val() == 1;
                    }
                }
                $("#modalChangeUserStat").modal('hide');
                $("#formChangeUserStat")[0].reset();
                dataTableUsers.draw();
            }

            $("#iBtnChangeUserStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeUserStat").removeAttr('disabled');
            $("#iBtnChangeUserStatIcon").addClass('fa fa-check');
        },
        error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
            $("#iBtnChangeUserStatIcon").removeClass('fa fa-spinner fa-pulse');
            $("#btnChangeUserStat").removeAttr('disabled');
            $("#iBtnChangeUserStatIcon").addClass('fa fa-check');
        }
    });
}

//============================== SELECT USER APPROVER ( RAPIDX ) ==============================
function LoadRapidXUserList(cboElement)
{
    let result = '<option value="">N/A</option>';

    $.ajax({

    url: "load_rapidx_user_list",
    method: "get",
    dataType: "json",
    beforeSend: function(){
            result = '<option value=""> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(JsonObject){
            result = '';
            if(JsonObject['users'].length > 0){
                result = '<option selected disabled>-- Select User Approver -- </option>';
                for(let index = 0; index < JsonObject['users'].length; index++){
                    let disabled = '';

                    if(JsonObject['users'][index].status == 2){
                        disabled = 'disabled';
                    }
                    else{
                        disabled = '';
                    }
                    result += '<option data-code="' + JsonObject['users'][index].employee_id + '" value="' + JsonObject['users'][index].id + '" ' + disabled + '>' + JsonObject['users'][index].name + '</option>';
                }
            }
            else{
                result = '<option value=""> -- No record found -- </option>';
            }

            cboElement.html(result);
        },
        error: function(data, xhr, status){
            result = '<option value=""> -- Reload Again -- </option>';
            cboElement.html(result);
            toastr.error('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

// ============================================= GET SECTION HEAD =============================================
function GetSectionHeadApprover(cboElement){
    let result = '<option value="0" selected disabled> -- Section Head -- </option>';
    $.ajax({
        url: 'get_section_head_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            
            if(response['user_approvers'].length > 0){
                result = '<option value="0" selected disabled> -- Section Head -- </option>';
                for(let index = 0; index < response['user_approvers'].length; index++){
                    result += '<option value="' + response['user_approvers'][index].rapidx_id + '">' + response['user_approvers'][index].rapidx_user_details.name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}

// ============================================= GET DEPARTMENT HEAD =============================================
function GetDepartmentHeadApprover(cboElement){
    let result = '<option value="0" selected disabled> -- Department Head -- </option>';
    $.ajax({
        url: 'get_department_head_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            
            if(response['user_approvers'].length > 0){
                result = '<option value="0" selected disabled> -- Department Head -- </option>';
                for(let index = 0; index < response['user_approvers'].length; index++){
                    result += '<option value="' + response['user_approvers'][index].rapidx_id + '">' + response['user_approvers'][index].rapidx_user_details.name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}

// ============================================= GET CASHIER =============================================
function GetCashierApprover(cboElement){
    let result = '<option value="0" selected disabled> -- Cashier -- </option>';
    $.ajax({
        url: 'get_cashier_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['user_approvers'].length > 0){
                result = '<option value="0" selected disabled> -- Cashier -- </option>';
                for(let index = 0; index < response['user_approvers'].length; index++){
                    result += '<option value="' + response['user_approvers'][index].rapidx_id + '">' + response['user_approvers'][index].rapidx_user_details.name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}

// ============================================= GET TREASURY HEAD =============================================
function GetTreasuryHeadApprover(cboElement){
    let result = '<option value="0" selected disabled> -- Treasury Head  -- </option>';
    $.ajax({
        url: 'get_treasury_head_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['user_approvers'].length > 0){
                result = '<option value="0" selected disabled> -- Treasury Head -- </option>';
                for(let index = 0; index < response['user_approvers'].length; index++){
                    result += '<option value="' + response['user_approvers'][index].rapidx_id + '">' + response['user_approvers'][index].rapidx_user_details.name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}

// ============================================= GET FINANCE GENERAL MANAGER=============================================
function GetFinanceGeneralManagerApprover(cboElement){
    let result = '<option value="0" selected disabled> -- Fin. Gen. Manager -- </option>';
    $.ajax({
        url: 'get_finance_general_manager_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['user_approvers'].length > 0){
                result = '<option value="0" selected disabled> -- Fin. Gen. Manager -- </option>';
                for(let index = 0; index < response['user_approvers'].length; index++){
                    result += '<option value="' + response['user_approvers'][index].rapidx_id + '">' + response['user_approvers'][index].rapidx_user_details.name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}  

// ============================================= GET PRESIDENT =============================================
function GetPresidentApprover(cboElement){
    let result = '<option value="0" selected disabled> -- President -- </option>';
    $.ajax({
        url: 'get_president_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['user_approvers'].length > 0){
                result = '<option value="0" selected>  </option>';
                for(let index = 0; index < response['user_approvers'].length; index++){
                    result += '<option value="' + response['user_approvers'][index].rapidx_id + '">' + response['user_approvers'][index].rapidx_user_details.name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}  

// ============================================= GET SUPERVISOR =============================================
function GetSupervisorApprover(cboElement){
    let result = '<option value="0" selected disabled> -- Optional -- </option>';
    $.ajax({
        url: 'get_supervisor_approver',
        method: 'get',
        dataType: 'json',
        beforeSend: function(){
            result = '<option value="0" selected disabled> -- Loading -- </option>';
            cboElement.html(result);
        },
        success: function(response){
            result = '';
            if(response['supervisor'].length > 0){
                result = '<option value="" selected> -- Optional -- </option>';
                for(let index = 0; index < response['supervisor'].length; index++){
                    result += '<option value="' + response['supervisor'][index].username + '">' + response['supervisor'][index].emp_name + '</option>';
                }
            }
            else{
                result = '<option value="0" selected disabled> No record found </option>';
            }
            cboElement.html(result);
        }
    });
}


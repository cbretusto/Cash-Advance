@php $layout = 'layouts.super_user_layout'; @endphp

@extends($layout)

@section('title', 'User Approver')

@section('content_page')

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
                            <div class="card-header">
                                <h3 class="card-title">User Approver Management</h3>
                            </div>
                            <div class="card-body">
                                <div style="float: right;">                   
                                    <button class="btn btn-dark" data-toggle="modal" data-target="#modalAddUser" id="btnShowAddUserModal"><i class="fa fa-user-plus"></i> Add User Approver</button>
                                </div> <br><br>
                                <div class="table-responsive">
                                    <table id="tblUsers" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                        <thead>
                                            <tr style="text-align:center">
                                            <th>Employee No.</th>
                                            <th>Name</th>
                                            <th>Classification</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ADD MODAL START -->
    <div class="modal fade" id="modalAddUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add User Approver</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formAddUser">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Employee No.</label>
                                    <input type="text" class="form-control" name="employee_no" id="txtAddUserEmployeeNo" required>
                                </div>   

                                <div class="form-group">
                                    <label>Name</label>
                                    <select class="form-control sel-rapidx-user-list select2bs4" id="selectAddRapidxUser" name="rapidx_user"></select>
                                </div>                             

                                <div class="form-group">
                                    <label>Classification</label>
                                    <select class="form-control" name="classification" id="selectAddUserPosition" style="width: 100%;">
                                        <option selected disabled value="">-SELECT-</option>
                                        <option value="President">President</option>
                                        <option value="Finance General Manager">Finance General Manager</option>
                                        <option value="Treasury Head">Treasury Head</option>
                                        <option value="Section Head">Section Head</option>
                                        <option value="Department Head">Department Head</option>
                                        <option value="Cashier">Cashier</option>
                                        {{-- <option value="Supervisor">Supervisor</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnAddUser" class="btn btn-dark"><i id="iBtnAddUserIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="fa fa-user-plus"></i> Edit User Approver</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formEditUser">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee No.</label>
                                        <input type="text" class="form-control" name="employee_no" id="txtEditUserEmployeeNo">
                                    </div>   
                                    <input type="hidden" class="form-control" name="user_id" id="txtEditUserId">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <select class="form-control sel-rapidx-user-list select2bs4" id="selectEditRapidxUser" name="rapidx_user"></select>
                                    </div>                             

                                    <div class="form-group">
                                        <label>Classification</label>
                                        <select class="form-control" name="classification" id="selectEditUserClassification" style="width: 100%;">
                                            <option selected disabled value="">-SELECT-</option>
                                            <option value="President">President</option>
                                            <option value="Finance General Manager">Finance General Manager</option>
                                            <option value="Treasury Head">Treasury Head</option>
                                            <option value="Section Head">Section Head</option>
                                            <option value="Department Head">Department Head</option>
                                            <option value="Cashier">Cashier</option>
                                            {{-- <option value="Supervisor">Supervisor</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditUser" class="btn btn-dark"><i id="iBtnEditUserIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ADD MODAL END -->

    <!-- CHANGE USER STAT MODAL START -->
    <div class="modal fade" id="modalChangeUserStat">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="h4ChangeUserTitle"><i class="fa fa-user"></i> Change Status</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formChangeUserStat">
                    @csrf
                    <div class="modal-body">
                        <label id="lblChangeUserStatLabel"></label>
                        <input type="hidden" name="user_id" placeholder="User Id" id="txtChangeUserStatUserId">
                        <input type="hidden" name="status" placeholder="Status" id="txtChangeUserStatUserStat">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                        <button type="submit" id="btnChangeUserStat" class="btn btn-dark"><i id="iBtnChangeUserStatIcon" class="fa fa-check"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- CHANGE USER STAT MODAL END -->
@endsection

<!-- {{-- JS CONTENT --}} -->
@section('js_content')
    <script type="text/javascript">
        let dataTableUsers;
        let arrSelectedUsers = [];

        $(document).ready(function () {
            
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            // $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $('.sel-rapidx-user-list').select2({
                theme: "bootstrap4"
            });

            $(document).on('click','#tblUsers tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // USERS DATATABLES START
            // The GetUserApprover(); function is inside public/js/my_js/UserApprover.js
            // this will fetch <option> based on the uri called get_user_approver
            // then the controller will handle that uri to use specific method called get_user_approver() inside UserApproverController
            LoadRapidXUserList($('.sel-rapidx-user-list'));

            dataTableUsers = $("#tblUsers").DataTable({
                "processing" : false,
                "serverSide" : true,
                "order":  [[ 5, "desc" ], [ 1, "asc" ]],
                // "aaSorting": [[ 1, "asc" ]],
                "ajax" : {
                    url: "view_users", // this will be pass in the uri called view_users that handles datatables of view_users() method inside UserApproverController
                },
                "columns":[
                    { "data" : "employee_no" },
                    { "data" : "fullname" }, //Add Column - Controller//
                    { "data" : "classification" },
                    { "data" : "username" },
                    { "data" : "emp_email" }, //Add Column - Controller//
                    { "data" : "status" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            }); // USERS DATATABLES END

            //============================== ADD USER ==============================
            // The AddUser(); function is inside public/js/my_js/UserApprover.js
            // after the submission, the ajax request will pass the formAddUser(form) of data(input) in the uri(add_user)
            // then the controller will handle that uri to use specific method called add_user() inside UserApproverController
            $("#formAddUser").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddUser();
                window.location.reload();
            });

            // VALIDATION(remove errors)
            $("#btnShowAddUserModal").click(function(){
                $("#txtAddUserEmployeeNo").removeClass('is-invalid');
                $("#txtAddUserEmployeeNo").attr('title', '');
                $("#txtAddUserName").removeClass('is-invalid');
                $("#txtAddUserName").attr('title', '');
                $("#selectAddUserPosition").removeClass('is-invalid');
                $("#selectAddUserPosition").attr('title', '');
            });  

            //============================== EDIT USER ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditUser', function(){
                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let userId = $(this).attr('user-id'); 

                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtEditUserId").val(userId);

                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetUserByIdToEdit(userId); 
            });

            // The EditUser(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
            // then the controller will handle that uri to use specific method called edit_user() inside UserController
            $("#formEditUser").submit(function(event){
                event.preventDefault();
                EditUser();
            });

            //============================== CHANGE USER STATUS ==============================
            // aChangeUserStat is generated by datatables and open the modalChangeUserStat(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionChangeUserStat', function(){
                let userStat = $(this).attr('status'); // the status will collect the value (1-active, 2-inactive)
                let userId = $(this).attr('user-id'); // the user-id(attr) is inside the datatables of UserController that will be use to collect the user-id

                $("#txtChangeUserStatUserStat").val(userStat); // collect the user status id the default is 2, this will be use to change the user status when the formChangeUserStat(form) is submitted
                $("#txtChangeUserStatUserId").val(userId); // after clicking the aChangeUserStat(button) the userId will be pass to the txtChangeUserStatUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the status of the user

                if(userStat == 1){
                    $("#lblChangeUserStatLabel").text('Are you sure to activate?'); 
                    $("#h4ChangeUserTitle").html('<i class="fa fa-user"></i> Activate User');
                }
                else{
                    $("#lblChangeUserStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeUserTitle").html('<i class="fa fa-user"></i> Deactivate User');
                }
            });

            // The ChangeUserStatus(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formChangeUserStat(form) of data(input) in the uri(change_user_stat)
            // then the controller will handle that uri to use specific method called change_user_stat() inside UserController
            $("#formChangeUserStat").submit(function(event){
                event.preventDefault();
                ChangeUserStatus();
            });

        }); // JQUERY DOCUMENT READY END
    </script>    
@endsection

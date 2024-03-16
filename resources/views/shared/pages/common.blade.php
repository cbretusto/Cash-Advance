<!-- MODALS -->
<div class="modal fade" id="modalGenBarcode">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-qrcode"></i> Generate QR Code</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <center>
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                      ->size(150)->errorCorrection('H')
                      ->generate('0')) !!}" id="imgGenBarcode" style="max-width: 200px;">
            <br>
            <label id="lblGenBarcodeVal">...</label>
          </center>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="btnPrintBarcode" class="btn btn-primary"><i id="iBtnPrintBarcodeIcon" class="fa fa-print"></i> Print</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <!-- MODALS -->
<div class="modal fade" id="modalLogout">
  <div class="modal-dialog">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-user"></i> Logout</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="formSignOut">
        @csrf
        <div class="modal-body">
          <label>Are you sure to logout?</label>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" id="btnSignOut" class="btn btn-primary"><i id="iBtnSignOutIcon" class="fa fa-check"></i> Yes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function(){
    $("#formSignOut").submit(function(event){
      event.preventDefault();
      SignOut();
    });

    $("body").css({"overflow-y" : "auto"});
    $(document).on("hidden.bs.modal", function () {
        $("body").addClass("modal-open");
        $("body").css({"overflow-y" : "auto"});
    });
    $(document).on("show.bs.modal", function () {
        $("body").css({"overflow-y" : "hidden"});
    });
  });
</script>











<div class="card-body">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#userList" type="button" role="tab">User List</button>
      </li>
      <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#approverList" type="button" role="tab">Approver List</button>
      </li>
  </ul>
  <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="userList" role="tabpanel">
          <div class="text-right mt-4">                   
              <button type="button" class="btn btn-dark mb-3" id="buttonAddUser" data-bs-toggle="modal" data-bs-target="#modalUser"><i class="fa fa-plus fa-md"></i> New User</button>
          </div>
          <div class="table-responsive">
              <table id="tableUserList" class="table table-bordered table-hover nowrap" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>Action</th>
                          <th>Status</th>
                          <th>Employee No.</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Department</th>
                      </tr>
                  </thead>
              </table>
          </div>
      </div>
      <div class="tab-pane fade" id="approverList" role="tabpanel">
          <div class="text-right mt-4">                   
              <button type="button" class="btn btn-dark mb-3" id="buttonAddApprover" data-bs-toggle="modal" data-bs-target="#modalApprover"><i class="fa fa-plus fa-md"></i> New Approver</button>
          </div>
          <div class="table-responsive">
              <table id="tableApproverList" class="table table-bordered table-hover nowrap" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>Action</th>
                          <th>Name</th>
                          <th>Classification</th>
                      </tr>
                  </thead>
              </table>
          </div>
      </div>
  </div>
</div>
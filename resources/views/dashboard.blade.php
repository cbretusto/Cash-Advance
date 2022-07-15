@php $layout = 'layouts.super_user_layout'; @endphp

@extends($layout)

@section('title', 'Dashboard')

  @section('content_page')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              
                <div class="card-header">
                  <h3 class="card-title">CASH ADVANCE MODULE</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3 id="h3TotalNoOfUsers"></h3>
                            <p>Cash Advance</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                          </div>
                          <a href="{{ route('cash_advance') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3 id="h3TotalNoOfUsers"></h3>
                            <p>User Approver</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-thumbs-up"></i>
                          </div>
                          <a href="{{ route('user_approver') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                          </a>
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
@endsection

@section('js_content')
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
      // CountUserByStatForDashboard(1);
    });
  </script>
@endsection

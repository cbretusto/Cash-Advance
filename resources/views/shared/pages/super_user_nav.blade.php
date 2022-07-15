<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{ asset('public/images/pricon_logo2.png') }}"
        alt="CNPTS"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Cash Advance System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="../RapidX/" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              RapidX
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">ADMINISTRATOR</li>
        <li class="nav-item">
          <a href="cash_advance" class="nav-link">
            <i class="fas fa-hand-holding-usd"> </i>
            <p> Cash Advance Management </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="user_approver" class="nav-link">
            <i class="fas fa-thumbs-up"> </i>
            <p> User Approver Management </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
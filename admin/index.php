<?php

  include('../layout/header.php');

  $userId = 0;
  if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
  }
  if (isset($_SESSION["full_name"])) {
    $fullName = $_SESSION["full_name"];
  }
  if ($userId == 0) {
    header('Location: login.php');
  }

?>

  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper">
    <header class="topbar bg-custom-dark">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <a class="navbar-brand" href="index.php"><h4>Unspoken Puzzle</h4></a>
          <a href="javascript:void(0)"></a>
        </div>
        <div class="navbar-collapse collapse bg-light">
          <ul class="navbar-nav float-right ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-account font-24 text-dark"></i></a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated p-0">
              <a class="dropdown-item" href="../logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar bg-custom-dark">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="users.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="books.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Books</span></a></li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title">Dashboard</h4>
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dasboard</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="d-md-flex align-items-center">
                <div>
                  <h4 class="card-title">Site Analysis</h4>
                  <h5 class="card-subtitle">Overview of Latest Month</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-9">
                  <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-line-chart"></div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="row">
                    <div class="col-6">
                      <div class="bg-dark p-10 text-white text-center">
                        <i class="fa fa-user m-b-5 font-16"></i>
                        <h5 class="m-b-0 m-t-5">2540</h5>
                        <small class="font-light">Total Users</small>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="bg-dark p-10 text-white text-center">
                        <i class="fa fa-plus m-b-5 font-16"></i>
                        <h5 class="m-b-0 m-t-5">120</h5>
                        <small class="font-light">New Users</small>
                      </div>
                    </div>
                    <div class="col-6 m-t-15">
                      <div class="bg-dark p-10 text-white text-center">
                        <i class="fa fa-cart-plus m-b-5 font-16"></i>
                        <h5 class="m-b-0 m-t-5">656</h5>
                        <small class="font-light">Total Shop</small>
                      </div>
                    </div>
                    <div class="col-6 m-t-15">
                      <div class="bg-dark p-10 text-white text-center">
                        <i class="fa fa-tag m-b-5 font-16"></i>
                        <h5 class="m-b-0 m-t-5">9540</h5>
                        <small class="font-light">Total Orders</small>
                      </div>
                    </div>
                    <div class="col-6 m-t-15">
                      <div class="bg-dark p-10 text-white text-center">
                        <i class="fa fa-table m-b-5 font-16"></i>
                        <h5 class="m-b-0 m-t-5">100</h5>
                        <small class="font-light">Pending Orders</small>
                      </div>
                    </div>
                    <div class="col-6 m-t-15">
                      <div class="bg-dark p-10 text-white text-center">
                        <i class="fa fa-globe m-b-5 font-16"></i>
                        <h5 class="m-b-0 m-t-5">8540</h5>
                        <small class="font-light">Online Orders</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          
      </div>
    </div>
    <footer class="footer">
      Powered By: <a href="https://appworksco.com" target="_blank">Appworks Co.</a>.
    </footer>
  </div>

<?php
  include('../layout/footer.php');
?>
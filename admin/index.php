<?php

  include('../db/connector.php');
  include('../models/user-facade.php');
  include('../models/book-facade.php');
  include('../models/purchased-book-facade.php');
  include('../layout/dashboard-header.php');

  $userFacade = new UserFacade;
  $bookFacade = new BookFacade;
  $puchasedBookFacade = new PurchasedBookFacade;

  $userId = 0;
  if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
  }
  if (isset($_SESSION["full_name"])) {
    $fullName = $_SESSION["full_name"];
  }
  if ($userId == 0) {
    header('Location: ../login.php');
  }

  $yearlyDate = date('Y');

  $janProductSales = $puchasedBookFacade->janProductSales($yearlyDate);
  $febProductSales = $puchasedBookFacade->febProductSales($yearlyDate);
  $marProductSales = $puchasedBookFacade->marProductSales($yearlyDate);
  $aprProductSales = $puchasedBookFacade->aprProductSales($yearlyDate);
  $mayProductSales = $puchasedBookFacade->mayProductSales($yearlyDate);
  $junProductSales = $puchasedBookFacade->junProductSales($yearlyDate);
  $julProductSales = $puchasedBookFacade->julProductSales($yearlyDate);
  $augProductSales = $puchasedBookFacade->augProductSales($yearlyDate);
  $sepProductSales = $puchasedBookFacade->sepProductSales($yearlyDate);
  $octProductSales = $puchasedBookFacade->octProductSales($yearlyDate);
  $novProductSales = $puchasedBookFacade->novProductSales($yearlyDate);
  $decProductSales = $puchasedBookFacade->decProductSales($yearlyDate);

  if ($janProductSales == NULL) {
    $janProductSales = 0;
  }
  if ($febProductSales == NULL) {
    $febProductSales = 0;
  }
  if ($marProductSales == NULL) {
    $marProductSales = 0;
  }
  if ($aprProductSales == NULL) {
    $aprProductSales = 0;
  }
  if ($mayProductSales == NULL) {
    $mayProductSales = 0;
  }
  if ($junProductSales == NULL) {
    $junProductSales = 0;
  }
  if ($julProductSales == NULL) {
    $julProductSales = 0;
  }
  if ($augProductSales == NULL) {
    $augProductSales = 0;
  }
  if ($sepProductSales == NULL) {
    $sepProductSales = 0;
  }
  if ($octProductSales == NULL) {
    $octProductSales = 0;
  }
  if ($novProductSales == NULL) {
    $novProductSales = 0;
  }
  if ($decProductSales == NULL) {
    $decProductSales = 0;
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
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="users.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="books.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Books</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="news.php" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">News</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="shop.php" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Shop</span></a></li>
          </ul>
          <p class="ms-4 mt-4 text-light">Settings</p>
          <ul id="sidebarnav">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="banner.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Banner</span></a></li>
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

    </div>
    <footer class="footer">
      Powered By: <a href="https://appworksco.com" target="_blank">Appworks Co.</a>.
    </footer>
  </div>

<?php
  include('../layout/dashboard-footer.php');
?>
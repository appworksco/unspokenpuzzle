<?php

include('../db/connector.php');
include('../models/news-facade.php');
include('../layout/dashboard-header.php');

$newsFacade = new NewsFacade;

if (isset($_GET["msg"])) {
  $msg = $_GET["msg"];
  array_push($success, $msg);
}

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
        <a class="navbar-brand" href="index.php">
          <h4>Unspoken Puzzle</h4>
        </a>
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
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
                <h4 class="page-title">News Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between py-3">
                            <h4 class="card-title">News Information</h4>
                            <a href="add-news.php" class="btn btn-primary">Add News</a>
                        </div>
                        <?php include('../errors.php'); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $news = $newsFacade->fetchNews()->fetchAll();
                                    foreach ($news as $new) {
                                    ?>
                                        <tr>
                                            <td><?= $new["title"] ?></td>
                                            <td><?= date('F j, Y', strtotime($new["created_at"])) ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="update-news.php?news_id=<?= $new["id"] ?>" class="btn btn-primary">Update</a>
                                                    <a href="delete-news.php?news_id=<?= $new["id"] ?>" class="btn btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer class="footer">
      Powered By: <a href="https://appworksco.com" target="_blank">Appworks Co.</a>.
    </footer>
  </div>

  <?php
  include('../layout/dashboard-footer.php');
  ?>
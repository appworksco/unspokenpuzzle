<?php

  include('db/connector.php');
  include('models/book-facade.php');
  include('layout/header.php');

  $bookFacade = new BookFacade;

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
    <header class="topbar bg-primary">
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
                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar bg-primary">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Books</span></a></li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title">Books</h4>
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Books</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row el-element-overlay">
        <?php
        $books = $bookFacade->fetchBooks()->fetchAll();
        foreach($books as $book) { ?>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="el-card-item">
              <div class="el-card-avatar el-overlay-1"> <img src="<?= $book["book_image"] ?>" alt="user" />
                <div class="el-overlay">
                  <ul class="list-style-none el-info">
                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="<?= $book["book_image"] ?>"><i class="mdi mdi-magnify-plus"></i></a></li>
                    <li class="el-item"><a class="btn default btn-outline el-link" href="read.php?book_id=<?= $book["id"] ?>"><i class="mdi mdi-link"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="el-card-content">
                <h4 class="m-b-0"><?= $book["book_name"] ?></h4>
                <span class="text-muted">Price: <?= $book["price"] ?></span>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <footer class="footer text-center">
      Powered By: <a href="https://appworksco.com" target="_blank">Appworks Co.</a>.
    </footer>
  </div>

<?php
  include('layout/footer.php');
?>
<?php

  include('../db/connector.php');
  include('../models/book-facade.php');
  include('../layout/dashboard-header.php');

  $bookFacade = new BookFacade;

  $userId = 0;
  if (isset($_GET["book_id"])) {
    $bookId = $_GET["book_id"];
  }
  if (isset($_GET["description"])) {
    $description = $_GET["description"];
  }
  if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
  }
  if (isset($_SESSION["full_name"])) {
    $fullName = $_SESSION["full_name"];
  }
  if ($userId == 0) {
    header('Location: ../login.php');
  }

  if (isset($_POST["update"])) {
    $bookId = $_POST["book_id"];
    $file = $_FILES["book_image"];
		$fileName = $_FILES["book_image"]["name"];
		$fileTmpName = $_FILES["book_image"]["tmp_name"];
		$fileSize = $_FILES["book_image"]["size"];
		$fileError = $_FILES["book_image"]["error"];
		$fileType = $_FILES["book_image"]["type"];
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		$allowed = array('jpg', 'jpeg', 'png');
    $bookName = $_POST["book_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    if ($fileSize > 5000) {
      $fileNameNew = uniqid('', true) . "." . $fileActualExt;
      $fileDestination = '../assets/book-images/' . $fileNameNew;
      move_uploaded_file($fileTmpName, $fileDestination);
      // Insert Data To Database
      $bookImage = './assets/book-images/' . $fileNameNew;
      $updateBook = $bookFacade->updateBook($bookId, $bookImage, $bookName, $description, $price);
      if ($updateBook) {
        header("Location: books.php");
      }
    }
    
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
          <h4 class="page-title">Update</h4>
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="books.php">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
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
            <form class="form-horizontal" action="update-book.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                  <h4 class="card-title">Information</h4>
                </div>
                <?php include('../errors.php');
                $fetchUBookById = $bookFacade->fetchBookById($bookId) ;
                while ($row = $fetchUBookById->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="form-group row">
                  <label for="bookImage" class="col-sm-2 text-right control-label col-form-label">Book Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="bookI mage" name="book_image">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bookName" class="col-sm-2 text-right control-label col-form-label">Book Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="bookName" placeholder="Book Name Here" name="book_name" value="<?= $row["book_name"] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 text-right control-label col-form-label">Description</label>
                  <div class="col-sm-10">
                    <input type="hidden" value="" name="book_id">
                    <textarea class="w-100 p-2" id="description" placeholder="Description Here" name="description" style="height: 130px"><?= $row["description"] ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="price" class="col-sm-2 text-right control-label col-form-label">Price</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" placeholder="Price Here" name="price" value="<?= $row["price"] ?>">
                  </div>
                </div>
              </div>
              <div class="border-top">
                <div class="card-body">
                  <input type="hidden" value="<?= $bookId ?>" name="book_id">
                  <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
              </div>
              <?php } ?>
            </form>
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
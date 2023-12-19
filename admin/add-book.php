<?php

  include('../db/connector.php');
  include('../models/book-facade.php');
  include('../layout/dashboard-header.php');

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

  if (isset($_POST["add_book"])) {
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

    if (empty($fileTmpName)) {
      array_push($invalid, "Book image should not be empty!");
    } if (empty($bookName)) {
      array_push($invalid, 'Book Name should not be empty!');
    } if (empty($description)) {
      array_push($invalid, 'Description should not be empty!');
    } if (empty($price)) {
      array_push($invalid, 'Price should not be empty!');
    } else {

      $verifyBookName = $bookFacade->verifyBookName($bookName);

      if ($verifyBookName > 0) {
        array_push($invalid, "Book already exist!");
      } elseif ($fileError === 0) {
				if (in_array($fileActualExt, $allowed)) {
					if ($fileSize > 5000) {
						$fileNameNew = uniqid('', true) . "." . $fileActualExt;
						$fileDestination = '../assets/book-images/' . $fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						// Insert Data To Database
						$bookImage = './assets/book-images/' . $fileNameNew;
            $addBook = $bookFacade->addBook($bookImage, $bookName, $description, $price);
						if ($addBook) {
							array_push($success, "Book added successfully!");
						} else {
							array_push($invalid, "Book not added!");
						}
					} else {
						array_push($invalid, "File size should not exceed 5MB!");
					}
				} else {
					array_push($invalid, "File type is not supported!");
				}
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
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="users.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="books.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Books</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="chapters.php" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Chapters</span></a></li>
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
          <h4 class="page-title">Add Book</h4>
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Books</li>
                <li class="breadcrumb-item active" aria-current="page">Add Book</li>
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
            <form class="form-horizontal" action="add-book.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                  <h4 class="card-title">Information</h4>
                </div>
                <?php include('../errors.php'); ?>
                <div class="form-group row">
                  <label for="bookImage" class="col-sm-2 text-right control-label col-form-label">Book Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="bookImage" name="book_image">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bookName" class="col-sm-2 text-right control-label col-form-label">Book Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="bookName" placeholder="Book Name Here" name="book_name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 text-right control-label col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="w-100 p-2" id="description" placeholder="Description Here" name="description" style="height: 130px"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="price" class="col-sm-2 text-right control-label col-form-label">Price</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" placeholder="Price Here" name="price">
                  </div>
                </div>
              </div>
              <div class="border-top">
                <div class="card-body">
                  <button type="submit" class="btn btn-primary" name="add_book">Submit</button>
                </div>
              </div>
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
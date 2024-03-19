<?php

include('../db/connector.php');
include('../models/book-facade.php');
include('../models/chapter-facade.php');
include('../layout/dashboard-header.php');

$bookFacade = new BookFacade;
$chapterFacade = new ChapterFacade;

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
if (isset($_GET["book_id"])) {
  $bookId = $_GET["book_id"];
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
      header("Location: continue.php?book_id=" . $bookId);
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
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between py-3">
                <h4 class="card-title">Information</h4>
              </div>
              <?php include('../errors.php'); ?>
              <div class="row">
                <div class="col-lg-4">
                  <?php
                  $books = $bookFacade->fetchBookById($bookId)->fetchAll();
                  foreach ($books as $book) {
                  ?>
                    <img src="<?= '../' . $book["book_image"] ?>" class="w-100" alt="Book Image">
                  <?php } ?>
                </div>
                <div class="col-lg-6">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Story Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Table of Contents</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <form class="form-horizontal mt-2" action="continue.php" method="post" enctype="multipart/form-data">
                        <?php include('../errors.php');
                        $fetchUBookById = $bookFacade->fetchBookById($bookId);
                        while ($row = $fetchUBookById->fetch(PDO::FETCH_ASSOC)) { ?>
                          <div class="form-group row">
                            <label for="bookImage" class="control-label col-form-label">Book Image</label>
                            <input type="file" class="form-control" id="bookI mage" name="book_image">
                          </div>
                          <div class="form-group row">
                            <label for="bookName" class="control-label col-form-label">Book Name</label>
                            <input type="text" class="form-control" id="bookName" placeholder="Book Name Here" name="book_name" value="<?= $row["book_name"] ?>">
                          </div>
                          <div class="form-group row">
                            <label for="description" class="control-label col-form-label">Description</label>
                            <input type="hidden" value="" name="book_id">
                            <textarea class="w-100 p-2" id="description" placeholder="Description Here" name="description" style="height: 130px"><?= $row["description"] ?></textarea>
                          </div>
                          <div class="form-group row">
                            <label for="price" class="control-label col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="Price Here" name="price" value="<?= $row["price"] ?>">
                          </div>
                          <input type="hidden" value="<?= $bookId ?>" name="book_id">
                          <button type="submit" class="btn btn-primary w-100 my-2" name="update">Update</button>
                        <?php } ?>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <a href="add-chapter.php?book_id=<?= $bookId ?>" class="btn btn-primary w-100 my-2">Add Chapter</a>
                      <?php
                      $chapters = $chapterFacade->fetchChapterByBookId($bookId)->fetchAll();
                      foreach ($chapters as $chapter) { ?>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $chapter["chapter"] ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                Chapter <?= $chapter["chapter"] ?>
                              </button>
                            </h2>
                            <div id="flush-collapse<?= $chapter["chapter"] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">
                                <a href="update-chapter.php?book_id=<?= $chapter["book_id"] ?>&chapter=<?= $chapter["chapter"] ?>" class="btn btn-info">Update</a>
                                <a href="delete-chapter.php?book_id=<?= $chapter["book_id"] ?>&chapter=<?= $chapter["chapter"] ?>" class="btn btn-danger">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
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
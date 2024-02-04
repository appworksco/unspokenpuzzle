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
                <a href="add-book.php" class="btn btn-primary">Add Book</a>
              </div>
              <?php include('../errors.php'); ?>
              <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Book Image</th>
                      <th>Book Name</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Chapters</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $books = $bookFacade->fetchBooks()->fetchAll();
                    foreach($books as $book) { 
                      $bookId = $book["id"];  
                    ?>
                    <tr>
                      <td><img src="<?= '../' . $book["book_image"] ?>" alt="Book Image" style="height: 100px"></td>
                      <td><?= $book["book_name"] ?></td>
                      <td><?= $book["description"] ?></td>
                      <td><?= $book["price"] ?></td>
                      <td class="w-100">                        
                        <?php
                        $chapters = $chapterFacade->fetchChapterByBookId($bookId)->fetchAll();
                        foreach($chapters as $chapter) { ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $chapter["chapter"]?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                  Chapter <?= $chapter["chapter"] ?>
                                </button>
                              </h2>
                              <div id="flush-collapse<?= $chapter["chapter"]?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                  <a href="update-chapter.php?book_id=<?= $chapter["book_id"] ?>&chapter=<?= $chapter["chapter"] ?>" class="btn btn-info">Update</a>
                                  <a href="delete-chapter.php?book_id=<?= $chapter["book_id"] ?>&chapter=<?= $chapter["chapter"] ?>" class="btn btn-danger">Delete</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>  
                      </td>
                      <td>
                        <a href="add-chapter.php?book_id=<?= $book["id"] ?>" class="btn btn-primary w-100">Add Chapter</a>
                        <a href="update-book.php?book_id=<?= $book["id"] ?>" class="btn btn-info w-100">Update</a>
                        <a href="delete-book.php?book_id=<?= $book["id"] ?>&book_image=<?= $book["book_image"] ?>" class="btn btn-danger w-100">Delete</a>
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
    <footer class="footer">
      Powered By: <a href="https://appworksco.com" target="_blank">Appworks Co.</a>.
    </footer>
  </div>

<?php
    include('../layout/dashboard-footer.php');
?>
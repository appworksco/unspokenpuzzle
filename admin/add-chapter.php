<?php

  include('../db/connector.php');
  include('../models/book-facade.php');
  include('../models/chapter-facade.php');
  include('../layout/dashboard-header.php');

  $bookFacade = new BookFacade;
  $chapterFacade = new ChapterFacade;

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

  if (isset($_POST["add_chapter"])) {
    $bookId = $_POST["book_id"];
    $chapter = $_POST["chapter"];
    $content = $_POST["content"];

    if (empty($bookId)) {
      array_push($invalid, "Book Name should not be empty!");
    } if (empty($chapter)) {
      array_push($invalid, 'Chapter should not be empty!');
    } if (empty($content)) {
      array_push($invalid, 'Content should not be empty!');
    } else {

      $verifyChapter = $chapterFacade->verifyChapterById($bookId, $chapter);

      if ($verifyChapter < 1) {
        $addChapter = $chapterFacade->addChapter($bookId, $chapter, $content);
        if ($addChapter) {
          array_push($success, "Chapter added successfully!");
        } else {
          array_push($invalid, "Chapter not added!");
        }
      } else {
        array_push($invalid, "Chapter already exist!");
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
          <h4 class="page-title">Add Chapter</h4>
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Chapters</li>
                <li class="breadcrumb-item active" aria-current="page">Add Chapter</li>
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
            <form class="form-horizontal" action="add-chapter.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                  <h4 class="card-title">Information</h4>
                </div>
                <?php include('../errors.php'); ?>
                <div class="form-group row">
                  <label for="bookId" class="col-sm-2 text-right control-label col-form-label">Book Name</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="book_id" id="bookId">
                    <?php 
                      $books = $bookFacade->fetchBooks();
                      foreach($books as $book) { ?>
                        <option value="<?= $book["id"] ?>"><?= $book["book_name"] ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="chapter" class="col-sm-2 text-right control-label col-form-label">Chapter</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="chapter" placeholder="Chapter Here" name="chapter">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="content" class="col-sm-2 text-right control-label col-form-label">Content</label>
                  <div class="col-sm-10">
                    <textarea class="w-100 p-2" id="content" placeholder="Content Here" name="content" style="height: 130px"></textarea>
                  </div>
                </div>
              </div>
              <div class="border-top">
                <div class="card-body">
                  <button type="submit" class="btn btn-primary" name="add_chapter">Submit</button>
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
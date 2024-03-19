<?php
include('../db/connector.php');
include('../models/news-facade.php');
include('../layout/dashboard-header.php');

$newsFacade = new NewsFacade;

$userId = 0;
if (isset($_GET["news_id"])) {
    $newsId = $_GET["news_id"];
}
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
}
if ($userId == 0) {
    header('Location: ../login.php');
}

if (isset($_POST["update"])) {
    $newsId = $_POST["news_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    
    $updateNews = $newsFacade->updateNews($newsId, $title, $description);
    if ($updateNews) {
        header("Location: news.php");
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
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="news.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">News</span></a></li>
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
          
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="books.php">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update News</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="form-horizontal" action="update-news.php" method="post">
                            <div class="card-body">
                                <div class="d-flex justify-content-between py-3">
                                    <h4 class="card-title">Update News</h4>
                                </div>
                                <?php include('../errors.php');
                                $fetchUNewsById = $newsFacade->fetchNewsById($newsId);
                                while ($row = $fetchUNewsById->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 text-right control-label col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" placeholder="Title Here" name="title" value="<?= $row["title"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" value="<?= $newsId ?>" name="news_id">
                                            <textarea class="form-control" id="description" placeholder="Description Here" name="description" style="height: 130px"><?= $row["description"] ?></textarea>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
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
</div>

<?php include('../layout/dashboard-footer.php'); ?>
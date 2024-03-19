<?php

include('db/connector.php');
include('models/user-facade.php');
include('models/shop-facade.php');
include('layout/header.php');

$userfacade = new UserFacade;
$shopfacade = new ShopFacade;

$userId = 0;
if (isset($_SESSION["user_id"])) {
  $userId = $_SESSION["user_id"];
}
if (isset($_SESSION["full_name"])) {
  $fullName = $_SESSION["full_name"];
}
if (isset($_SESSION["wallet"])) {
  $wallet = $_SESSION["wallet"];
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
<div class="main-wrapper">
  <header class="site-header bg-black">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <div class="d-block w-100">
          <div>
            <a class="navbar-brand fst-young-serif" href="index.php"><img src="./assets/images/logo.png" alt="Logo" style="width: 80px"> Unspoken Puzzle</a>
            <button class="navbar-toggler float-end mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
          <div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item pe-3">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item pe-3">
                  <a class="nav-link" aria-current="page" href="about.php">About</a>
                </li>
                <li class="nav-item pe-3">
                  <a class="nav-link" aria-current="page" href="books.php">Books</a>
                </li>
                <li class="nav-item pe-3">
                  <a class="nav-link" aria-current="page" href="news.php">News</a>
                </li>
                <li class="nav-item pe-3">
                  <a class="nav-link" aria-current="page" href="contacts.php">Contacts</a>
                </li>
                <li class="nav-item pe-3">
                  <a class="nav-link" aria-current="page" href="shop.php">Shop</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $fullName ?>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                      <a class="dropdown-item disabled" href="#">
                        My Wallet
                        <small class="dropdown-item disabled">
                          &#8369;
                          <?php
                          $users = $userfacade->fetchUsersById($userId);
                          foreach ($users as $user) {
                            echo $user["wallet"];
                          }
                          ?>
                        </small>
                      </a>
                    </li>
                    <li><a class="dropdown-item" href="my-books.php">My Books</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="site-products bg-black pb-5" style="padding-top: 50px;">
    <div class="container">
      <h1 class="text-light py-4 fst-young-serif">Products</h1>
      <?php include('errors.php'); ?>
      <div class="row">
        <?php
        $products = $shopfacade->fetchProducts();

        foreach ($products as $product) {
        ?>
          <div class="col-sm-3" style="padding-top: 50px;">
            <div class="card mb-5">
              <a href="<?= $product['link'] ?>" target="_blank"><img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                <div class="card-body p-3">
                  <h5 class="card-title"><?= $product['name'] ?></h5>
                </div>
              </a>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="site-footer bg-black">
    <div class="container py-3">
      <div class="d-lg-flex justify-content-between">
        <p class="text-light m-0">Copyright &copy; 2023 Unspoken Puzzle. All Rights Reserved</p>
        <p class="text-light m-0">Powered By: <a href="https://www.appworksco.com/" class="text-decoration-none" target="_blank">Appworks Co.</a></p>
      </div>
    </div>
  </div>
</div>

<?php
include('layout/footer.php');
?>
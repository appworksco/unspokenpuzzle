<?php

  include('db/connector.php');
  include('models/user-facade.php');
  include('models/book-facade.php');
  include('models/purchased-book-facade.php');
  include('layout/header.php');

  $userfacade = new UserFacade;
  $bookFacade = new BookFacade;
  $purchasedBookFacade = new PurchasedBookFacade;

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

  if (isset($_POST["buy"])) {
    $userId = $_POST["user_id"];
    $bookId = $_POST["book_id"];
    $wallet = $_POST["wallet"];
    $price = $_POST["price"];

    if ($wallet > $price) {
      // $addMyBooks
      $amount = $wallet - $price;
      $updateWallet = $userfacade->updateWallet($userId, $amount);
      if ($updateWallet) {
        // Add book to user
        $addPurchasedBookById = $purchasedBookFacade->addPurchasedBookByUserId($userId, $bookId);
        if ($addPurchasedBookById) {
          $msg = 'The book has been successfully bought. You can now start reading it on "My Books".';
          array_push($success, $msg);
        }
      }
    } else {
      $msg = 'You do not have enough funds in your wallet. Deposit now through Gcash to continue the transaction.';
      array_push($invalid, $msg);
    }
  }

?>

  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div class="main-wrapper bg-primary">
    <header class="site-header">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="index.php">Unspoken Puzzle</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item pe-3">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                          foreach($users as $user) {
                            echo $user["wallet"];
                          }
                        ?>
                      </small>
                    </a>
                  </li>
                  <li><a class="dropdown-item" href="my-books.php">My Books</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="site-hero">
      <div class="container">
        <h1 class="display-5 text-white">Reading is essential for those who seek to rise above the ordinary.</h1>
        <small class="text-white">- Jim Rohn</small>
        <!-- <div class="owl-carousel">
          <div><p>asdasd</p></div>
          <div> Your Content </div>
          <div> Your Content </div>
          <div> Your Content </div>
          <div> Your Content </div>
          <div> Your Content </div>
          <div> Your Content </div>
        </div> -->
      </div>
    </div>

    <div class="site-suggestions">
      <div class="container">
        <h1 class="h3 text-uppercase text-white py-3">Suggestions</h1>
        <?php include('errors.php'); ?>
        <div class="row">
          <?php
          $books = $bookFacade->fetchBooks()->fetchAll();
          foreach($books as $book) { ?>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
              <form action="index.php" method="post">
                <div class="card-body p-0">
                  <img src="<?= $book["book_image"] ?>" class="w-100 mb-3" alt="user" />
                  <div class="px-3">
                    <h4 class="m-b-0"><?= $book["book_name"] ?></h4>
                    <span class="text-muted">Price: <?= $book["price"] ?></span>
                  </div>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Synopsis
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><?= $book["description"] ?></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer mt-2 p-0">
                  <div class="d-flex">
                    <input type="hidden" value="<?= $userId ?>" name="user_id">
                    <?php 
                      $users = $userfacade->fetchUsersById($userId);
                      foreach($users as $user) { ?>
                        <input type="hidden" value="<?= $user["wallet"] ?>" name="wallet">
                    <?php } ?>
                    <input type="hidden" value="<?= $book["id"] ?>" name="book_id">
                    <input type="hidden" value="<?= $book["price"] ?>" name="price">
                    <a class="btn btn-info w-100" href="<?= $book["book_image"] ?>"><i class="mdi mdi-magnify-plus"></i> View</a>
                    <button type="submit" class="btn btn-success w-100" name="buy"><i class="mdi mdi-link"></i> Buy</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="site-footer bg-primary-dark">
      <div class="container py-3">
        <div class="d-lg-flex justify-content-between">
          <p class="text-light m-0">Copyright &copy; 2023 Unspoken Puzzle. All Rights Reserved</p>
          <p class="text-light m-0">Powered By: <a href="https://www.appworksco.com/" class="text-warning" target="_blank">Appworks Co.</a></p>
        </div>
      </div>
    </div>
  </div>

<?php
  include('layout/footer.php');
?>
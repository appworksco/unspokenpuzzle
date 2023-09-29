<?php
  include('db/connector.php');
  include('models/user-facade.php');
  include('layout/header.php');

  $userFacade = new UserFacade;

  if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
    array_push($success, $msg);
  }

  if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) {
      array_push($invalid, 'Username should not be empty!');
    } if (empty($password)) {
      array_push($invalid, 'Password should not be empty!');
    } else {
      $verifyUsernameAndPassword = $userFacade->verifyUsernameAndPassword($username, $password);
      $login = $userFacade->login($username, $password);
      if ($verifyUsernameAndPassword > 0) {
        while ($row = $login->fetch(PDO::FETCH_ASSOC)) {
          if ($row['user_type'] == 0) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            header('Location: admin/index.php');
          } else {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['wallet'] = $row['wallet'];
            header('Location: index.php');
          }
        }
      } else {
        array_push($invalid, "Incorrect username or password!");
      }
    }
  }
?>

  <div class="main-wrapper">
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-space">
      <div class="auth-box border-top border-secondary" style="z-index: 2">
        <div id="loginform">
          <div class="text-center p-t-20 p-b-20">
            <h4>Unspoken Puzzle</h4>
          </div>
          <?php include('errors.php'); ?>
          <form class="form-horizontal m-t-20" action="login.php" method="post">
            <div class="row p-b-30">
              <div class="col-12">
                <div class="input-group mb-1">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white"><i class="ti-user"></i></span>
                  </div>
                  <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white"><i class="ti-pencil"></i></span>
                  </div>
                  <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
                </div>
              </div>
            </div>
            <div class="row border-top border-secondary">
              <div class="col-12">
                <div class="form-group">
                  <div class="p-t-20">
                    <button type="submit" class="btn btn-primary mb-1 w-100" name="login">Login</button>
                    <small>Don't have an account? <a href="register.php">Register</a></small><br>
                    <small>Powered By: <a href="https://www.appworksco.com" target="blank">Appworks Co.</a></small>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
  include('layout/footer.php');
?>
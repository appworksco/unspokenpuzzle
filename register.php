<?php
  include('db/connector.php');
  include('models/user-facade.php');
  include('layout/header.php');

  $userFacade = new UserFacade;

  if (isset($_POST["register"])) {
    $userType = '1';
    $email = $_POST["email"];
    $fullName = $_POST["full_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($password != $confirmPassword){
      array_push($invalid, 'Password does not match!');
    } else {
      $register = $userFacade->register($userType, $email, $fullName, $username, $password);
      if ($register) {
        header('Location: login.php?msg=Account created successfully!');
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
          <form class="form-horizontal m-t-20" action="register.php" method="post">
            <div class="row p-b-30">
              <div class="col-12">
                <div class="input-group mb-1">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-custom-dark text-white"><i class="ti-user"></i></span>
                  </div>
                  <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required="" name="email">
                </div>
                <div class="input-group mb-1">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-custom-dark text-white"><i class="ti-user"></i></span>
                  </div>
                  <input type="text" class="form-control form-control-lg" placeholder="Full Name" aria-label="Full Name" aria-describedby="basic-addon2" required="" name="full_name">
                </div>
                <div class="input-group mb-1">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-custom-dark text-white"><i class="ti-user"></i></span>
                  </div>
                  <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon3" required="" name="username">
                </div>
                <div class="input-group mb-1">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-custom-dark text-white"><i class="ti-pencil"></i></span>
                  </div>
                  <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon4" required="" name="password">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-custom-dark text-white"><i class="ti-pencil"></i></span>
                  </div>
                  <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="basic-addon5" required="" name="confirm_password">
                </div>
              </div>
            </div>
            <div class="row border-top border-secondary">
              <div class="col-12">
                <div class="form-group">
                  <div class="p-t-20">
                    <button type="submit" class="btn bg-custom-dark text-white mb-1 w-100" name="register">Register</button>
                    <small>Already had an account? <a href="login.php">Login</a></small><br>
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
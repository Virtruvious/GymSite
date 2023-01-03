<!DOCTYPE html>
<html lang="en">

<?php
require_once __ROOT__.'/User/Scripts/CreateAccount.php';
require_once __ROOT__.'/User/Scripts/UserLogin.php';
$errorfname = $errorlname = $errorpwd = $errordob = $errorlogin = $erroremail = $errorpost = $errorloginusername = $errorlpassword = "";
$allFields = "yes";

if (isset($_POST['csubmit'])) {
  if ($_POST['firstname'] == "") {
    $errorfname = "You must enter a First Name!";
    $allFields = "no";
  }
  if ($_POST['lastname'] == "") {
    $errorlname = "You must enter a Last Name!";
    $allFields = "no";
  }
  if ($_POST['password'] == "") {
    $errorpwd = "You must enter a Password!";
    $allFields = "no";
  }
  if ($_POST['dob'] == "") {
    $errordob = "You must enter a Date of Birth!";
    $allFields = "no";
  }
  if ($_POST['email'] == "") {
    $erroremail = "You must enter a valid email!";
    $allFields = "no";
  }
  if ($_POST['postcode'] == "") {
    $errorpost = "You must enter a postcode!";
    $allFields = "no";
  }

  if ($allFields == "yes") {
    $createUser = createUser();

    header('Location: //localhost/GymSite/User/Home.php?username=' . $createUser);
  }
}

if (isset($_POST['login'])) {
  if ($_POST['username'] == "") {
    $errorloginusername = "You must enter a Username!";
    $allFields = "no";
  }
  if ($_POST['password'] == "") {
    $errorlpassword = "You must enter a Password!";
    $allFields = "no";
  }

  if ($allFields == "yes") {
    $userLogin = userLogin();

    if ($userLogin == null) {
      $errorlogin = "Incorrect Username or Password!";
    } else {
      header('Location: //localhost/GymSite/User/Home.php?username=' . $_POST['username']);
    }
  }
}
?>


<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<link rel="stylesheet" href="./assets/site.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<body class="bgColour">
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" style="padding-left: 50px; padding-right: 50px;" href="//localhost/GymSite/">
        <h2>MiniGym Sheffield</h2>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <strong>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link btn btn-outline-light spaced" href="//localhost/GymSite/">About Us</a>
            </li>
            <div class="dropdown spaced">
              <button class="btn btn-outline-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #3c4a72;"><strong>Account</strong></button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#Login">Login</button>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#CreateAccount">Create an Account</button>
              </div>
            </div>
            <div class="dropdown spaced">
              <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #3c4a72;"><strong>Staff</strong></button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a type="button" class="dropdown-item" href="//localhost/Gymsite/Staff/Login.php">Staff Login</a>
                <a type="button" class="dropdown-item" href="//localhost/Gymsite/Manager/Login.php">Manager Login</a>
              </div>
            </div>
          </ul>
        </div>
      </strong>
    </nav>
  </header>

  <div class="modal fade" id="CreateAccount" tabindex="-1" role="dialog" aria-labelledby="Create Account" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateAccLabel">Create Your MiniGym Account!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="createUser" method="post">
            <div class="input-group">
              <div class="form-group" style="padding-right: 11%;">
                <label for="firstname" class="col-form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" placeholder="John">
                <span class="text-danger"><?php echo $errorfname; ?></span>
              </div>
              <div class="form-group">
                <label for="lastname" class="col-form-label">Last Name</label>
                <input class="form-control" name="lastname" placeholder="Doe">
                <span class="text-danger"><?php echo $errorlname; ?></span>
              </div>
            </div>
            <div class="form-group">
              <label for="postcode" class="col-form-label">Password</label>
              <input class="form-control" type="password" name="password" placeholder="********">
              <span class="text-danger"><?php echo $errorpwd; ?></span>
            </div>
            <div class="form-group">
              <label for="dob" class="col-form-label">Date of Birth</label>
              <input class="form-control" name="dob" type="date">
              <span class="text-danger"><?php echo $errordob; ?></span>
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email Address</label>
              <input class="form-control" name="email" placeholder="johndoe@example.com">
              <span class="text-danger"><?php echo $erroremail; ?></span>
            </div>
            <div class="form-group">
              <label for="postcode" class="col-form-label">Postcode</label>
              <input class="form-control" name="postcode" placeholder="S9 3TY">
              <span class="text-danger"><?php echo $errorpost; ?></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input class="btn btn-success" id="csubmit" type="submit" value="Create User" name="csubmit">
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="User Login" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateAccLabel">Login to Your MiniGym Account!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span class="text-danger"><?php echo $errorlogin; ?></span>
          <form id="userLogin" method="post">
            <div class="form-group">
              <label for="firstname" class="col-form-label">Username</label>
              <input type="text" class="form-control" name="username" placeholder="Johoe77">
              <span class="text-danger"><?php echo $errorloginusername; ?></span>
            </div>
            <div class="form-group">
              <label for="postcode" class="col-form-label">Password</label>
              <input class="form-control" type="password" name="password" placeholder="********">
              <span class="text-danger"><?php echo $errorlpassword; ?></span>
            </div>
        </div>
        <div class="modal-footer">
          <div class="login-move-left">
            <a href="//localhost/GymSite/User/AccountReset.php">Forgot your password?</a>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input class="btn btn-success" id="login" type="submit" value="Login" name="login">
        </div>
        </form>
      </div>
    </div>
  </div>
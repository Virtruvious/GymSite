<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__.'/User/Scripts/ResetPassword.php';

$lallFields = "yes";
$enabledetailcheck = "";
$enablepwdreset = "disabled";

if (isset($_POST['checkdetail'])) { 
    if ($_POST['username'] == "") {
      $lallFields = "no";
    }
    if ($_POST['postcode'] == "") {
      $lallFields = "no";
    }
    if ($_POST['email'] == "") {
      $lallFields = "no";
    }
    if ($_POST['birthmonth'] == "") {
      $lallFields = "no";
    }

    $file = fopen("username.txt", "w");
    fwrite($file, $_POST['username']);
    fclose($file);
  
    if ($lallFields == "yes") {
      $userDetails = CheckDetails();

      if (!($userDetails == null)) { // Sucessfully validated login details
        $enablepwdreset = "";
        $enabledetailcheck = "disabled";
      }
    }
  }

if (isset($_POST['resetpwd'])) {
    if ($_POST['password1'] == "") {
      $lallFields = "no";
    }
    if ($_POST['password2'] == "") {
      $lallFields = "no";
    }
  
    if ($lallFields == "yes") {
      if ($_POST['password1'] == $_POST['password2']) {
        $file = fopen("username.txt", "r");
        $username = fread($file, filesize("username.txt"));
        $userLogin = ResetPassword($username);
        fclose($file);
        unlink("username.txt");
      }
    }
  }?>


<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Reset Password</title>

<div class="container bgColour">
    <main>
        <br>
        <div class="col-12">
            <h1>Password Reset Portal </h1>
        </div>
        <hr>

        <center><strong><div class="">
		    <?php // Error and success messages 
        if (isset($_POST['checkdetail'])) {
          if (!($lallFields == "yes")) {
            $message = errorMessage();
            echo $message;
          } else if ($userDetails == null) {
            $message = incorrectDetails();
            echo $message;
          } else {
            $message = correctDetails();
            echo $message;
          }
        }

        if (isset($_POST['resetpwd'])) {
          if (!($lallFields == "yes")) {
            $message = errorResetMessage();#
            $enablepwdreset = "";
            $enabledetailcheck = "disabled";
            echo $message;
          } else if (!($_POST['password1'] == $_POST['password2'])) {
            $message = errorPwdMatch();
            $enablepwdreset = "";
            $enabledetailcheck = "disabled";
            echo $message;
          } 
        }
        
		    ?>
	      </div></strong></center>

        <div class="col-6">
        <form method="post">
          <div class="form-group col-md-6">
              Username
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="username" <?php echo $enabledetailcheck?> placeholder="Johoe92">
          </div>
          <div class="form-group col-md-6">
              Postcode
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="postcode" <?php echo $enabledetailcheck?> placeholder="S9 3TY">
          </div>
          <div class="form-group col-md-6">
              Email
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="email" <?php echo $enabledetailcheck?> placeholder="JohnDoe@example.com">
          </div>
          <div class="form-group col-md-6">
              Month of Birth
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="birthmonth" <?php echo $enabledetailcheck?> placeholder="08">
          </div>
          <br>
          <div class="form-group col-md-6">
            <button type="submit" class="btn btn-success" name="checkdetail" <?php echo $enabledetailcheck?>>Check Details</button>
          </div>
			  </form>
        <br>
        <form method="post">
          <div class="input-group">
            <div class="form-group col-md-6" style="padding-right: 20px;">
                New Password
              <label class="control-label labelFront"></label>
              <input class="form-control" type="password" name ="password1" <?php echo $enablepwdreset?> placeholder="********">
            </div>
            <div class="form-group col-md-6" style="padding-right: 20px;">
                Confirm New Password
              <label class="control-label labelFront"></label>
              <input class="form-control" type="password" name ="password2" <?php echo $enablepwdreset?> placeholder="********">
            </div>
          </div>
          <br> 
          <div class="form-group col-md-6">
            <button type="submit" class="btn btn-success" name="resetpwd" <?php echo $enablepwdreset?>>Reset Password</button>
          </div>
          </form>
        </div>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
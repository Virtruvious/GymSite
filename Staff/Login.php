<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__.'/Staff/Scripts/StaffLogin.php';

$allFields = "yes";
$errorlogin = "";

if (isset($_POST['stafflogin'])) { 
    if ($_POST['id'] == "") {
        $allFields = "no";
    }
    if ($_POST['password'] == "") {
        $allFields = "no";
    }
  
    if ($allFields == "yes") {
        $staffLogin = staffLogin();
  
        if ($staffLogin == null) {
            $errorlogin = "<center><b><div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
            Incorrect Staff ID or Password.	
            </div></b></center>";
        } else if (!($staffLogin[0]['status'] == "active")) {
            $errorlogin = "<center><b><div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
            Your staff account has been disabled. Please contact your manager.
            </div></b></center>";
        } else {
            RedirectTo('//localhost/GymSite/Staff/Home.php?id=' . $_POST['id']);
        }
    }  
}?>


<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Staff Login</title>

<div class="container bgColour">
    <main>
        <br>
        <div class="col-12">
            <h1>MiniGym Staff Login Portal</h1>If you encounter any issues logging in, please contact your manager.
        </div>
        <hr>

        <?php echo $errorlogin; ?>

        <?php if ($allFields == "no") { ?>
            <center><div class="alert alert-danger fade show col-10" role="alert" style="font-weight: bold;">
                Please ensure all fields are filled!
            </div></center>
        <?php } ?>

        <div class="col-6">
        <form method="post">
          <div class="form-group col-md-6">
                Staff ID
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="id" placeholder="XX00">
          </div>
          <div class="form-group col-md-6">
                Password
            <label class="control-label labelFront"></label>
            <input class="form-control" type="password" name ="password" placeholder="********">
          </div>
          <br>
          <div class="form-group col-md-6">
            <button type="submit" class="btn btn-success" name="stafflogin">Securely Login</button>
          </div>
		</form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
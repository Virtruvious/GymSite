<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__.'/Staff/Scripts/Customers.php';

$lallFields = "yes";
$updateSuccess = "";
$staffif = $_GET['id'];
$username = $_GET['username'];

if (isset($_POST['update'])) { 
    if ($_POST['fname'] == "") {
        $lallFields = "no";
    }
    if ($_POST['lname'] == "") {
        $lallFields = "no";
    }
    if ($_POST['postcode'] == "") {
        $lallFields = "no";
    }
    if ($_POST['email'] == "") {
        $lallFields = "no";
    }
    if ($_POST['dob'] == "") {
        $lallFields = "no";
    }
    if ($_POST['password'] == "") {
        $lallFields = "no";
    }
  
    if ($lallFields == "yes") {
      $updateSuccess = UpdateCustomer($username);
    }
}?>


<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Update Customers</title>

<div class="container bgColour">
    <main>
        <br>
        <div class="col-12">
            <h1>Update Customer Details</h1>
        </div>
        <hr>

        <center>
        <?php echo $updateSuccess; ?>
        </center>

        <?php if ($lallFields == "no") { ?>
            <center><div class="alert alert-danger fade show col-10" role="alert" style="font-weight: bold;">
                Please ensure all fields are filled!
            </div></center>
        <?php } ?>

        <div class="col-6">
        <form method="post">
          <div class="form-group col-md-6">
              Username
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="username" disabled value="<?php echo $username?>" placeholder="Johoe92">
          </div>
          <div class="input-group col-md-6">
            <div class="form-group col-md-6" style="padding-right: 11%;">
                First Name
                <label class="control-label labelFront"></label>
                <input class="form-control" type="text" name ="fname" placeholder="John">
            </div>
            <div class="form-group col-md-6" style="padding-right: 11%;">
                Last Name
                <label class="control-label labelFront"></label>
                <input class="form-control" type="text" name ="lname" placeholder="Doe">
            </div>
          </div>
          <div class="form-group col-md-6">
                Postcode
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="postcode" placeholder="S9 3TY">
          </div>
          <div class="form-group col-md-6">
                Email
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="email" placeholder="JohnDoe@example.com">
          </div>
          <div class="form-group col-md-6">
                Date of Birth
            <label class="control-label labelFront"></label>
            <input class="form-control" type="date" name ="dob">
          </div>
          <div class="form-group col-md-6">
                Password
            <label class="control-label labelFront"></label>
            <input class="form-control" type="password" name ="password" placeholder="********">
          </div>
          <br>
          <div class="form-group col-md-10">
            <button type="submit" class="btn btn-success" name="update">Update Details</button>
            <a href='Home.php<?php echo '?id='.$_GET['id']?>' class="btn btn-primary">Return to Staff Portal</a>
          </div>
		</form>
        </div>
        <br>
        <br>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
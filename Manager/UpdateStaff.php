<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__.'/Manager/Scripts/StaffScripts.php';

$staffid = $_GET['editid'];
$lallFields = "yes";
$updateSuccess = "";

if (isset($_POST['update'])) { 
    if ($_POST['fname'] == "") {
        $lallFields = "no";
    }
    if ($_POST['lname'] == "") {
        $lallFields = "no";
    }
    if ($_POST['email'] == "") {
        $lallFields = "no";
    }
    if ($_POST['password'] == "") {
        $lallFields = "no";
    }
    if ($_POST['status'] == "") {
        $lallFields = "no";
    }
    if ($_POST['role'] == "") {
        $lallFields = "no";
    }
  
    if ($lallFields == "yes") {
      $updateSuccess = updateStaff($staffid);
    }
}?>

<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Staff Update Portal</title>

<div class="container bgColour">
    <main>
        <br>
        <div class="col-12">
            <h1>Update a Staff Account</h1>
        </div>
        <hr>

        <center>
        <?php echo $updateSuccess; ?>

        <?php if ($lallFields == "no") { ?>
            <center><div class="alert alert-danger fade show col-10" role="alert" style="font-weight: bold;">
                Please ensure all fields are filled!
            </div></center>
        <?php } ?>
        </center>

        <div class="col-6">
        <form method="post">
          <div class="form-group col-md-6">
                Staff ID
            <label class="control-label labelFront"></label>
            <input class="form-control" value="<?php echo $_GET['editid']?>" disabled>
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
                Password
            <label class="control-label labelFront"></label>
            <input class="form-control" type="password" name ="password" placeholder="********">
          </div>
          <div class="form-group col-md-6">
                Email
            <label class="control-label labelFront"></label>
            <input class="form-control" type="text" name ="email" placeholder="JohnDoe@example.com">
          </div>
			<div class="dropdown col-md-6">
				<label class="control-label labelFront">Staff Role</label>
				<select name ="role" class="form-select">
					<option selected>Select New Staff Role</option>
					<option value="admin">Manager</option>
					<option value="staff">Staff</option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label class="control-label labelFront">Staff Status</label>
				<select name ="status" class="form-select">
					<option selected>Select New Staff Status</option>
					<option value="active">Active</option>
					<option value="disabled">Disabled</option>
				</select>
			</div>
          <br>
          <div class="form-group col-md-10">
            <button type="submit" class="btn btn-success" name="update">Update Account</button>
            <a href='Home.php?id=<?php echo $_GET['id']?>' class="btn btn-primary">Return to Manager Portal</a>
          </div>
		</form>
        </div>
        <br>
        <br>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
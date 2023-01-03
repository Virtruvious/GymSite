<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__ . '/Manager/Scripts/StaffScripts.php';
$managerid = $_GET['id'];
$staff = getStaff();
$result = "";

if(isset($_POST['delete'])){
	$staffid = $_POST['staffid'];
	$result = deleteStaff($staffid);
}
?>

<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Staff Account Management</title>

<div class="container bgColour">
    <main>
        <h1>Staff Account Management Portal</h1>
        <hr>

		<center>
		<?php echo $result; ?>
        
		<div class="titlebar-section staff">
			<a class="btn btn-outline-light" href="AddStaff.php?id=<?php echo $managerid?>">Add New Staff Account</a>
		</div>
		<div class="titlebar-section staff">
			<a class="btn btn-outline-light" href='Home.php?id=<?php echo $_GET['id']?>'>Return to Manager Portal</a>
		</div>
		<hr>

		<div class="container">    
            <h3><b>Staff Member Index</b></h3>
    	</div>

		<div class="row">
			<div class="col-12" style="padding-bottom: 50px;">
				<table class="table table-striped table-bordered">
					<thead class="table-dark">
						<td>Staff ID</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Email</td>
						<td>Role</td>
						<td>Status</td>
						<td>Password</td>
						<td>Actions</td>
					</thead>

					<?php
						for ($i=0; $i<count(getStaff()); $i++):
					?>

					<tr>
						<td><?php echo $staff[$i]['id']?></td>
						<td><?php echo $staff[$i]['fname']?></td>
						<td><?php echo $staff[$i]['lname']?></td>
						<td><?php echo $staff[$i]['email']?></td>
						<td><?php echo $staff[$i]['role']?></td>
						<td><?php echo $staff[$i]['status']?></td>
						<td><?php echo $staff[$i]['pwd']?></td>
						<td>
							<div class="input-group">
								<div style="padding-right: 11%;">
									<a class="btn btn-outline-dark" href="UpdateStaff.php<?php echo '?id='.$managerid?>&editid=<?php echo $staff[$i]['id']; ?>">Update</a>
								</div>
								<form method="post">
									<input type="hidden" name="staffid" value="<?php echo $staff[$i]['id']; ?>">
									<button class="btn btn-outline-danger" type="submit" name="delete">Delete</button>
								</form>	
							</div>
						</td
					</tr>
					<?php endfor;?>
				</table>
			</div>
		</div>
		</main>
	</div>
        </center>
        <br>
        <br>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
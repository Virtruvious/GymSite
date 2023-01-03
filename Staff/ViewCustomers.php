<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__ . '/Staff/Scripts/Customers.php';
$staffid = $_GET['id'];
$customer = getCustomer();
$result = "";

if(isset($_POST['delete'])){
	$customerid = $_POST['username'];
	$result = deleteCustomer($customerid);
}
?>

<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Customer Management</title>

<div class="container bgColour">
    <main>
        <h1>Customer Management Portal</h1>
        <hr>

		<center>
		<?php echo $result; ?>
        
		<div class="titlebar-section staff">
			<a class="btn btn-outline-light" href="AddCustomer.php?id=<?php echo $staffid?>">Add New Customer Account</a>
		</div>
		<div class="titlebar-section staff">
			<a class="btn btn-outline-light" href='Home.php?id=<?php echo $_GET['id']?>'>Return to Staff Portal</a>
		</div>
		<hr>

		<div class="container">    
            <h3><b>Customer Index</b></h3>
    	</div>

		<div class="row">
			<div class="col-12" style="padding-bottom: 50px;">
				<table class="table table-striped table-bordered">
					<thead class="table-dark">
						<td>Username</td>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Date of Birth</td>
						<td>Email</td>
						<td>Postcode</td>
						<td>Password</td>
						<td>Actions</td>
					</thead>

					<?php
						for ($i=0; $i<count(getCustomer()); $i++):
					?>

					<tr>
						<td><?php echo $customer[$i]['username']?></td>
						<td><?php echo $customer[$i]['fname']?></td>
						<td><?php echo $customer[$i]['lname']?></td>
						<td><?php echo $customer[$i]['datebirth']?></td>
						<td><?php echo $customer[$i]['email']?></td>
						<td><?php echo $customer[$i]['postcode']?></td>
						<td><?php echo $customer[$i]['password']?></td>
						<td>
							<div class="input-group">
								<div style="padding-right: 11%;">
									<a class="btn btn-outline-dark" href="UpdateCustomer.php<?php echo '?id='.$staffid?>&username=<?php echo $customer[$i]['username']; ?>">Update</a>
								</div>
								<form method="post">
									<input type="hidden" name="username" value="<?php echo $customer[$i]['username']; ?>">
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
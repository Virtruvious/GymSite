<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__ . '/Staff/Scripts/Memberships.php';
$staffid = $_GET['id'];
$customer = getMembership();
$result = "";

if(isset($_POST['pending'])){
    echo 'hi';
	$result = changeMembership('pending');
}

if(isset($_POST['active'])){
	$result = changeMembership('active');
}

if(isset($_POST['suspended'])){
	$result = changeMembership('suspended');
}
?>

<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Membership Management</title>

<div class="container bgColour">
    <main>
        <h1>Membership Management Portal</h1>
        <hr>

		<center>
		<?php echo $result; ?>
        
		<div class="titlebar-section staff">
			<a class="btn btn-outline-light" href='Home.php?id=<?php echo $_GET['id']?>'>Return to Staff Portal</a>
		</div>
		<hr>

		<div class="container">    
            <h3><b>Customer Membership Index</b></h3>
    	</div>

		<div class="row">
			<div class="col-12" style="padding-bottom: 50px;">
				<table class="table table-striped table-bordered">
					<thead class="table-dark">
						<td>Username</td>
						<td>Membership Type</td>
                        <td>Expiration Date</td>
						<td>Status</td>
						<td>Actions</td>
					</thead>

					<?php
						for ($i=0; $i<count(getMembership()); $i++):
                            $pendingstatus = $activestatus = $suspendedstatus = "";
                            $username = $customer[$i]['username'];
					?>

					<tr>
						<td><?php echo $customer[$i]['username']?></td>
						<td><?php echo ucfirst($customer[$i]['type'])?></td>
                        <td><?php echo $customer[$i]['expires']?></td>
						<td><?php echo ucfirst($customer[$i]['status'])?></td>
						<td>
                            <?php if($customer[$i]['status'] == 'pending') {
                                $pendingstatus = "disabled";
                            } else if ($customer[$i]['status'] == 'active') {
                                $activestatus = "disabled";
                            } else {
                                $suspendedstatus = "disabled";
                            }
                               
                            ?>
							<div class="input-group">
								<div style="padding-right: 5%;"> <form method="post">
									<input type="hidden" name="username" value="<?php echo $username; ?>">
									<button class="btn btn-outline-primary" <?php echo $pendingstatus?> type="submit" name="pending">Set to Pending</button>
								</form></div>
                                <div style="padding-right: 5%;"> <form method="post">
									<input type="hidden" name="username" value="<?php echo $username; ?>">
									<button class="btn btn-outline-success" <?php echo $activestatus?> type="submit" name="active">Set to Active</button>
								</form></div>
                                <form method="post">
									<input type="hidden" name="username" value="<?php echo $username; ?>">
									<button class="btn btn-outline-danger" <?php echo $suspendedstatus?> type="submit" name="suspended">Set to Suspended</button>
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
        <br>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
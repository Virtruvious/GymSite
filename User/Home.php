<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__ . '/User/Scripts/UserHome.php';
$username = $_GET['username'];

$userdetails = getDetails($username);

$membershipdetails = checkMembership($username);

print_r($membershipdetails);
?>

<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>User Home</title>

<div class="container bgColour">
    <main>
        <br>
        <div class="col-12">
            <h1>Welcome <?php echo $userdetails[0][1]?>,</h1>
        </div>
        <hr>

        <center>
        <div class="container" style="color: #6a22e8;">    
            <h3><b>Membership Details</b></h3>
            DO THE MEMBERSHIP DETAILS HERE
        </div>
        </center>

        <hr>
        <h3><i>Your Details...</i></h3>        <h6>Something look wrong or outdated? Update your details with the blue button!</h6>
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
                        <td>Actions</td>
					</thead>

					<tr>
						<td><?php echo $userdetails[0][0] //Username?></td>
						<td><?php echo $userdetails[0][1] //First Name?></td>
						<td><?php echo $userdetails[0][2] //Last Name?></td>
						<td><?php echo $userdetails[0][3] //Date of Birth?></td>
						<td><?php echo $userdetails[0][4] //Email?></td>
                        <td><?php echo $userdetails[0][5] //Postcode?></td>
						<td>
							<a class="btn btn-primary" href="updateUser.php?uid=<?php echo $user[$i]['userId']; ?>">Update</a>
						</td
					</tr>
				</table>
			</div>
		</div>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
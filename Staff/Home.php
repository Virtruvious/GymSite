<?php define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Assets/navbar.php';
require_once __ROOT__ . '/Staff/Scripts/StaffHome.php';
$staffid = $_GET['id'];

$staffDetails = getStaffDetails($staffid);
?>

<link rel="stylesheet" href="../Assets/site.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Staff Home</title>

<div class="container bgColour">
    <main>
        <div class="col-12">
            <h1>Welcome <?php echo ucfirst($staffDetails[0]['fname'])?>,</h1>
        </div>
        <hr>
        <center><h3 class="bg-dark text-light">ACCESS LEVEL: <?php echo strtoupper($staffDetails[0]['role'])?></h3></center>
        <hr>
        
        <center>
        <div class="container" style="color: #000000;">    
            <h3><b>Staff Customer Management Portal</b></h3><i>What would you like to do today?</i>
			<div class="container titlebar staff">
        		<div class="container"> 
            		<div class="blurbg titlebar-section" style="margin: 25px; color: white;">
                		<h3><b>View Customers</b></h3>
                		<p>Create, Update and Delete Customer Accounts</p>
                		<a href="ViewCustomers.php?id=<?php echo $staffid?>" class="btn btn-outline-light">Manage Customers</a>
            		</div>
                    <div class="blurbg titlebar-section" style="margin: 25px; color: white;">
                		<h3><b>Payment Processing Portal</b></h3>
                		<p>Approve Payments for <b>MiniGym <i>PRO</i> Memberships</b></p>
                		<a href="ViewMemberships.php?id=<?php echo $staffid?>" class="btn btn-outline-light">Manage Payments</a>
            		</div>
        		</div>
    	</div>
        </center>
        <br>
        <br>
        <br>
    </main>
</div>

<?php require_once __ROOT__.'/Assets/footer.php'; ?>
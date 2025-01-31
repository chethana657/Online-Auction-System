<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'Buyer') {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<link rel="icon" href="../images/logo.png">
	<link rel = "stylesheet" href = "styles/payment_methods.css">
</head>

<body>
	<div>
        <?php
        include "buyer_header.php";
        ?>
    </div>
	
	<div class="page-container">
	<div class="container">
		<div class="padding1">
			<h2 class="padding">Payment Method</h2>
			
			<button type="button"
			onclick="location.href='credit.php';" id="myButton" class="bttn">
			Credit & Debit card buttons</button>
			

		<button type="button"
			onclick="location.href='bank.php';" id="myButton" class="bttn">
			Bank Transfers</button>
		</div>
	</div>
	</div>

	<div>
        <?php
        include "buyer_footer.php";
        ?>
    </div>
</body>
</html>
<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'Seller') {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<link rel="icon" href="../iamges/logo.png">
</head

<body>
	<div>
        <?php
        include "seller_header.php";
        ?>
    </div>
	
	<div>
        <?php
        include "my_items.php";
        ?>
    </div>

	<div>
        <?php
        include "seller_footer.php";
        ?>
    </div>

</body>
</html>
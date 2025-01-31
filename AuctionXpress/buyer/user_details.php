<!-- user_details.php -->
<?php
session_start();
include '../config.php';

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user details from the database
    $sql = "SELECT * FROM buyers WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $contactNo = $row['contactNo'];
        $userType = "Buyer";
		
    } else {
        $firstName = "N/A";
        $lastName = "";
        $email = "N/A";
        $contactNo = "N/A";
        $userType = "Buyer";
    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: ../login.html");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
	<link rel="icon" href="../iamges/logo.png">
    <link rel="stylesheet" href="styles/user_details.css">
</head>
<body>
	<div>
        <?php
        include "buyer_header.php";
        ?>
    </div>
    <h1 id='header'>
        <h2>User Details</h2>
    </h1>
    <div class="container">
        <div class="user-details">
			<p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>User Type:</strong> <?php echo $userType; ?></p>
            <p><strong>Name:</strong> <?php echo $firstName." ".$lastName; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Contact No:</strong> <?php echo $contactNo; ?></p>
            <p><a href="edit_profile.php">Edit Profile</a></p>
        </div>
    </div>
	
	<?php
        include "buyer_footer.php";
    ?>
</body>
</html>

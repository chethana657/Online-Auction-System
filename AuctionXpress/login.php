<!-- login.php -->

<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            $_SESSION['username'] = $username;
			$_SESSION['userType'] = $row['userType'];
			
			if ($_SESSION['userType'] == 'Seller') {
				header("Location: seller/seller_home.php");
			} elseif ($_SESSION['userType'] == 'Buyer') {
				header("Location: buyer/buyer_home.php");
			} elseif ($_SESSION['userType'] == 'Admin') {
				header("Location: admin/admin_home.php");
			}
			exit;	
        } 
		else {
            echo "<script>alert('Invalid username or password. Please try again.'); window.history.back();</script>";
        }
    } 
	else {
        echo "<script>alert('Invalid username or password. Please try again.'); window.history.back();</script>";
    }
}
$conn->close();
?>



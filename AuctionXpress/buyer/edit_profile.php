<!-- edit_profile.php -->
<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $username = $_SESSION['username'];
    $password = $_POST['password'];

    $sqlu = "UPDATE users SET password='$password' WHERE username='$username'";
    $sqlb = "UPDATE buyers SET firstName='$firstName', lastName='$lastName', email='$email', contactNo='$contactNo' WHERE username='$username'";
    if ($conn->query($sqlu) === TRUE && $conn->query($sqlb) === TRUE) {
        echo "<script>alert('Your profile updated successfully'); window.location.href = 'user_details.php';</script>";
        exit;
    } else {
        $_SESSION['error'] = "Error updating record: " . $conn->error;
    }
} else {
    $username = $_SESSION['username'];
    $sqlu = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sqlu);
    $row = $result->fetch_assoc();
	$password = $row['password'];
	
	$sqlb = "SELECT * FROM buyers WHERE username='$username'";
	$result = $conn->query($sqlb);
    $row = $result->fetch_assoc();
	$firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $contactNo = $row['contactNo'];
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
	<link rel="icon" href="../iamges/logo.png">
	<link rel="stylesheet" href="register.css">
</head>
<body>
	<div>
        <?php
        include "buyer_header.php";
        ?>
    </div>
	<div class="container">
        <h2>Edit Profile</h2>
		<?php
		if(isset($_SESSION['error'])) {
			echo "<p>{$_SESSION['error']}</p>";
			unset($_SESSION['error']);
		}
		?>
		
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
            </div>
			<div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
            </div>
			<div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
			<div class="form-group">
                <label for="contactNo">Contact No:</label>
                <input type="tel" id="contactNo" name="contactNo" value="<?php echo $contactNo; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
            </div>
			<br>
            <input type="submit" value="Register">
        </form>
		<p><a href="user_details.php">Go back to your profile</a></p>
    </div>
	<?php
        include "buyer_footer.php";
	?>
</body>
</html>



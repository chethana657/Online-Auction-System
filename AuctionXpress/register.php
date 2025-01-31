<!-- register.php -->

<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
	$userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
		echo "<script>alert('Username is already taken. Please choose another one.'); window.history.back();</script>";
    } else {
        $sql = "INSERT INTO users (userType, username, password) VALUES ('$userType', '$username', '$password')";
        
		if ($userType == 'Buyer'){
			$sqlS = "INSERT INTO buyers (firstName, lastName, email, contactNo, username) VALUES ('$firstName', '$lastName', '$email', '$contactNo', '$username')";
			
			if ($conn->query($sql) === TRUE && $conn->query($sqlS) === TRUE) {
				echo "<script>alert('Registration successful. You can now login.'); window.location.href = 'login.html';</script>";
			}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				echo "Error: " . $sqlS . "<br>" . $conn->error;
			}
		}
		else if ($userType == 'Seller'){
			$sqlB = "INSERT INTO sellers (firstName, lastName, email, contactNo, username) VALUES ('$firstName', '$lastName', '$email', '$contactNo', '$username')";
			
			if ($conn->query($sql) === TRUE && $conn->query($sqlB) === TRUE) {
				echo "<script>alert('Registration successful. You can now login.'); window.location.href = 'login.html';</script>";
			}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				echo "Error: " . $sqlB . "<br>" . $conn->error;
			}
		}
        
    }
}
$conn->close();
?>


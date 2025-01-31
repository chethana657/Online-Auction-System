<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $password = $_POST['password'];
    $userType = "Seller";

    // Update seller's first name in the database
    $sql_sellers = "INSERT INTO sellers (username, firstName, lastName, email, contactNo) VALUES ('$username', '$firstName', '$lastName', '$email', '$contactNo');";
    $sql_users = "INSERT INTO users (username, userType, password) VALUES ('$username', '$userType', '$password');";
	
    if ($conn->query($sql_sellers) === TRUE && $conn->query($sql_users) === TRUE) {
        echo "<script>alert('Seller details added successfully.'); window.location.href = 'sellers_list.php';</script>";
    } else {
        echo "Error adding seller details: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Seller</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Add Seller</h2>
        <form method="POST">
			<label for="username">Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label for="firstName">First Name:</label><br>
            <input type="text" id="firstName" name="firstName" required><br><br>
			<label for="lastName">Last Name:</label><br>
            <input type="text" id="lastName" name="lastName" required><br><br>
			<label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
			<label for="contactNo">Contact No:</label><br>
            <input type="text" id="contactNo" name="contactNo" required><br><br>
			<label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Add Seller">
        </form>
        <p><a href="sellers_list.php">Cancel</a></p>
    </div>
</body>
</html>

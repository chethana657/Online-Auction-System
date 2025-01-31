<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = "Admin";

    $sql_users = "INSERT INTO users (username, userType, password) VALUES ('$username', '$userType', '$password');";
	
    if ($conn->query($sql_users) === TRUE) {
        echo "<script>alert('Admin details added successfully.'); window.location.href = 'admins_list.php';</script>";
    } else {
        echo "Error adding admin details: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Add Admin</h2>
        <form method="POST">
			<label for="username">Username:</label><br>
            <input type="text" name="username" required><br><br>
			<label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Add Admin">
        </form>
        <p><a href="Admin_list.php">Cancel</a></p>
    </div>
</body>
</html>

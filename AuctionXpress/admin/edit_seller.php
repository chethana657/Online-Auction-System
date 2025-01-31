<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $newFirstName = $_POST['firstName'];
    $newLastName = $_POST['lastName'];
    $newEmail = $_POST['email'];
    $newContactNo = $_POST['contactNo'];

    // Update seller's first name in the database
    $sql_update = "UPDATE sellers SET firstName = '$newFirstName', lastName='$newLastName', email='$newEmail', contactNo='$newContactNo' WHERE username = '$username'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Seller details updated successfully.'); window.location.href = 'sellers_list.php';</script>";
    } else {
        echo "Error updating seller details: " . $conn->error;
    }
}

// Check if username parameter is provided in the URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Retrieve seller details
    $sql_select = "SELECT * FROM sellers WHERE username = '$username'";
    $result = $conn->query($sql_select);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $contactNo = $row['contactNo'];
    } else {
        echo "Seller not found.";
        exit;
    }
} else {
    echo "Username parameter is missing.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Seller</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Seller</h2>
        <form method="post">
		
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <label for="firstName">First Name:</label><br>
            <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>"><br><br>
			<label for="lastName">Last Name:</label><br>
            <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"><br><br>
			<label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
			<label for="contactNo">Contact No:</label><br>
            <input type="text" id="contactNo" name="contactNo" value="<?php echo $contactNo; ?>"><br><br>
            <input type="submit" value="Update">
        </form>
        <p><a href="sellers_list.php">Cancel</a></p>
    </div>
</body>
</html>

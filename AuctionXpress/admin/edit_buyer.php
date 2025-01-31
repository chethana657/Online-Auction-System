<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $newFirstName = $_POST['firstName'];
    $newLastName = $_POST['lastName'];
    $newEmail = $_POST['email'];
    $newContactNo = $_POST['contactNo'];


    $sql_update = "UPDATE buyers SET firstName = '$newFirstName', lastName='$newLastName', email='$newEmail', contactNo='$newContactNo' WHERE username = '$username'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Buyer details updated successfully.'); window.location.href = 'buyers_list.php';</script>";
    } else {
        echo "Error updating buyer details: " . $conn->error;
    }
}


if (isset($_GET['username'])) {
    $username = $_GET['username'];


    $sql_select = "SELECT * FROM buyers WHERE username = '$username'";
    $result = $conn->query($sql_select);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $contactNo = $row['contactNo'];
    } else {
        echo "buyers not found.";
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
    <title>Edit Buyer</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Buyer</h2>
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
        <p><a href="buyers_list.php">Cancel</a></p>
    </div>
</body>
</html>

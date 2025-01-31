<?php
include '../config.php';

// Check if username parameter is provided in the URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Retrieve seller details
    $sql_users = "DELETE FROM users WHERE username = '$username'";
    $sql_sellers = "DELETE FROM sellers WHERE username = '$username'";
    $conn->query($sql_users);
    $conn->query($sql_sellers);

    echo "<script>alert('Seller deleted successfully.'); window.location.href = 'sellers_list.php';</script>";
}
else {
    echo "Username parameter is missing.";
    exit;
}
$conn->close();
?>



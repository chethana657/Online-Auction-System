<?php
include '../config.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $sql_users = "DELETE FROM users WHERE username = '$username'";
    $sql_buyers = "DELETE FROM buyers WHERE username = '$username'";
    $conn->query($sql_users);
    $conn->query($sql_buyers);

    echo "<script>alert('Buyer deleted successfully.'); window.location.href = 'buyers_list.php';</script>";
}
else {
    echo "Username parameter is missing.";
    exit;
}
$conn->close();
?>



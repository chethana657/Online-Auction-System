<?php
include '../config.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $sql = "DELETE FROM users WHERE username = '$username'";
    $conn->query($sql);

    echo "<script>alert('Admin deleted successfully.'); window.location.href = 'admins_list.php';</script>";
}
else {
    echo "Username parameter is missing.";
    exit;
}
$conn->close();
?>



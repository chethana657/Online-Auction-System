<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $itemId = $_POST['itemId'];
    $approvalStatus = $_POST['approvalStatus'];

    // Validate approval status to prevent SQL injection
    $validStatus = ['waiting', 'approved', 'not-approved'];
    if (!in_array($approvalStatus, $validStatus)) {
        echo "Invalid approval status.";
        exit();
    }

    // Update approval status in the database
    $sql = "UPDATE items SET approval='$approvalStatus' WHERE itemId='$itemId'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Approval status changed successfully.'); window.location.href = 'admin_home.php';</script>";
    } else {
        echo "Error updating approval status: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

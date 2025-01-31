<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemPrice = $_POST['itemPrice'];
    $username = $_SESSION['username'];

    // Update the item in the database
    $sql = "UPDATE items SET itemName='$itemName', itemDescription='$itemDescription', itemPrice='$itemPrice' WHERE itemId='$itemId' AND uploadedBy='$username'";
    
    if ($conn->query($sql) === TRUE) {
        // Item updated successfully
        echo "<script>alert('Item updated successfully.'); window.location.href = 'seller_home.php';</script>";
    } else {
        echo "Error updating item: " . $conn->error;
    }
} else {
    // Redirect to login page if user is not logged in or if it's not a POST request
    header("Location: ../login.html");
    exit;
}
$conn->close();
?>

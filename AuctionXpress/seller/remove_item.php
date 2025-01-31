<?php
session_start();
include '..\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    if(isset($_POST['itemId'])) {
        $itemId = $_POST['itemId'];
        
        // Additional security check: Validate $itemId to prevent SQL injection
        
        $username = $_SESSION['username'];

        // Check if the item belongs to the logged-in user
        $sql = "SELECT * FROM items WHERE itemId='$itemId' AND uploadedBy='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Item belongs to the user, proceed with removal
            $sql_delete = "DELETE FROM items WHERE itemId='$itemId'";
            if ($conn->query($sql_delete) === TRUE) {
                // Item removed successfully
                echo "<script>alert('Item removed successfully.'); window.location.href = 'seller_home.php';</script>";
            } else {
                echo "Error removing item: " . $conn->error;
            }
        } else {
            echo "<script>alert('You do not have permission to remove this item.'); window.location.href = 'my_items.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid request.'); window.location.href = 'my_items.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'my_items.php';</script>";
}
$conn->close();
?>

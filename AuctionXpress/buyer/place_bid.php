<!-- place_bid.php -->
<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['itemId'];
    $bidAmount = $_POST['bidAmount'];
    $tableName = "bids_" . $itemId;

    // Check if the bid amount is valid
    $sql = "SELECT itemPrice FROM items WHERE itemId = $itemId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $labeledPrice = $row['itemPrice'];
        if ($bidAmount <= $labeledPrice) {
            echo "<script>alert('Place a bid higher than the labeled price.');</script>";
            echo "<script>window.location.href='item_details.php?itemId=$itemId';</script>";
            exit();
        }
    } else {
        echo "Item not found.";
        exit();
    }

    // Check if the bid amount is higher than the highest bid
    $sql = "SELECT MAX(bidedAmount) AS highestBid FROM $tableName";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $highestBid = $row['highestBid'];
        if ($bidAmount <= $highestBid) {
            echo "<script>alert('Place a bid higher than the highest bid.');</script>";
            echo "<script>window.location.href='item_details.php?itemId=$itemId';</script>";
            exit();
        }
    }

    // Create the bids table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS $tableName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        bidedBy VARCHAR(30) NOT NULL,
        bidedAmount DECIMAL(10,2) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        // Insert the bid record into the bids table
        session_start(); // Start the session
        $bidedBy = $_SESSION['username']; // Get the username from the session
        $sql = "INSERT INTO $tableName (bidedBy, bidedAmount) VALUES ('$bidedBy', '$bidAmount')";
        if ($conn->query($sql) === TRUE) {
            // Bid placed successfully
            $_SESSION['success_message'] = "Bid placed successfully.";
            header("Location: item_details.php?itemId=$itemId");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>

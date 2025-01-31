<?php
include '../config.php';

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch items uploaded by the user
    $sql = "SELECT * FROM items WHERE uploadedBy='$username'";
    $result = $conn->query($sql);
} else {
    // Redirect to login page if user is not logged in
    header("Location: ../login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Items</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>My Items</h2>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='item'>";
                echo "<div class='approval-status " . strtolower($row['approval']) . "'>" . $row['approval'] . "</div>"; // Display approval status
                echo "<div class='item-details'>";
                echo "<h3>Item ID: " . $row["itemId"] . "</h3>";
                echo "<h4>" . $row["itemName"] . "</h4>";
                echo "<p>Description: " . $row["itemDescription"] . "</p>";
                echo "<p>Price: Rs." . $row["itemPrice"] . "</p>";
                echo "</div>";
                echo "<div class='item-photo'>";
                if ($row["itemPhoto"]) {
                    echo "<img src='" . $row["itemPhoto"] . "'><br>";
                }
                echo "</div>";
                echo "<div class='item-actions'>";
				
				// Bid status button form
                echo "<form method='get' action='bid_item.php'>";
                echo "<input type='hidden' name='itemId' value='" . $row["itemId"] . "'>";
                echo "<button type='submit' class='bid-button'>Bid Status</button>";
                echo "</form>";
                // Edit button form
                echo "<form method='get' action='update_item.php'>";
                echo "<input type='hidden' name='itemId' value='" . $row["itemId"] . "'>";
                echo "<button type='submit' class='edit-button'>Edit</button>";
                echo "</form>";
                // Remove button form
                echo "<form method='post' action='remove_item.php'>";
                echo "<input type='hidden' name='itemId' value='" . $row["itemId"] . "'>";
                echo "<button type='submit' class='remove-button'>Remove</button>";
                echo "</form>";
                echo "</div>"; // Closing item-actions
                echo "</div>"; // Closing item
            }
        } else {
            echo "No items uploaded yet.";
        }
        ?>
    </div>
</body>
</html>

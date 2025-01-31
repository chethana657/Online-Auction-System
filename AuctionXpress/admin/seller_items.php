<!-- seller_items.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Seller's Items</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Seller's Items</h2>
        <?php
        include '../config.php';

        // Check if the username parameter is set
        if (isset($_GET['username'])) {
            $username = $_GET['username'];

            // Retrieve the seller's items from the items table
            $sql = "SELECT * FROM items WHERE uploadedBy = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='item'>";
                    echo "<h3>" . $row["itemName"] . "</h3>";
                    echo "<p>Description: " . $row["itemDescription"] . "</p>";
                    echo "<p>Price: $" . $row["itemPrice"] . "</p>";
                    // Add more item details as needed
                    echo "</div>";
                }
            } else {
                echo "No items found for this seller.";
            }
        } else {
            echo "Seller username not provided.";
        }
        $conn->close();
        ?>
        <p><a href="sellers_list.php">Go back to sellers list</a></p>
    </div>
</body>
</html>

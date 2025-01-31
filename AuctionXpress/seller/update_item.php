<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['username']) && isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
    $username = $_SESSION['username'];

    // Fetch the item details
    $sql = "SELECT * FROM items WHERE itemId='$itemId' AND uploadedBy='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Item found, display the update form
        $row = $result->fetch_assoc();
        // You can use the fetched data to pre-fill the update form fields
        $itemName = $row['itemName'];
        $itemDescription = $row['itemDescription'];
        $itemPrice = $row['itemPrice'];
        // Display the update form
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Item</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<div>
        <?php
        include "seller_header.php";
        ?>
    </div>
    <div class="container">
        <h2>Update Item</h2>
        <form method="post" action="process_update.php">
            <input type="hidden" name="itemId" value="<?php echo $itemId; ?>">
            <label for="itemName">Item Name:</label><br>
            <input type="text" id="itemName" name="itemName" value="<?php echo $itemName; ?>"><br>
            <label for="itemDescription">Description:</label><br>
            <textarea id="itemDescription" name="itemDescription"><?php echo $itemDescription; ?></textarea><br>
            <label for="itemPrice">Price:</label><br>
            <input type="text" id="itemPrice" name="itemPrice" value="<?php echo $itemPrice; ?>"><br>
            <button type="submit">Save Changes</button>
        </form>
    </div>
	<div>
        <?php
        include "seller_footer.php";
        ?>
    </div>
</body>
</html>
<?php
    } else {
        echo "You do not have permission to edit this item or the item does not exist.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>

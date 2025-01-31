<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['itemId'];
    $NewItemName = $_POST['itemName'];
    $NewItemDescription = $_POST['itemDescription'];
    $NewItemPrice = $_POST['itemPrice'];
	$NewStartTime = $_POST['startTime'];
	$NewEndTime = $_POST['endTime'];

    $sql = "UPDATE items SET itemName = '$NewItemName', itemDescription='$NewItemDescription', itemPrice='$NewItemPrice', startTime='$NewStartTime', endTime='$NewEndTime' WHERE itemId = '$itemId'";
			
    if ($conn->query($sql) === TRUE) {
		$approvalStatus = 'waiting';
		$itemId = $conn->insert_id;
		$sql_approval = "UPDATE items SET approval='$approvalStatus' WHERE itemId='$itemId'";
		$conn->query($sql_approval);
		
        echo "<script>alert('Item updated successfully.'); window.location.href = 'items_list.php';</script>";
		exit;
		
    } else {
        $_SESSION['error'] = "Error updating item: " . $conn->error;
    }
}
	
if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
	

    $sql_select = "SELECT * FROM items WHERE itemId = '$itemId'";
    $result = $conn->query($sql_select);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $itemName = $row['itemName'];
        $itemDescription = $row['itemDescription'];
        $itemPrice = $row['itemPrice'];
        $startTime = $row['startTime'];
        $endTime = $row['endTime'];
    } else {
        echo "Items not found.";
        exit;
    }
} 
else {
    echo "Item ID parameter is missing.";
    exit;
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Item</h2>
        <form method="POST">
		
		
            <input type="hidden" name="itemId" value="<?php echo $itemId; ?>" required><br><br>
		
			<label for="itemName">Item Name:</label><br>
            <input type="text" name="itemName" value="<?php echo $itemName; ?>" required><br><br>
			
            <label for="itemDescription">Item Description:</label><br>
            <input type="text" id="itemDescription" name="itemDescription" value="<?php echo $itemDescription; ?>" required><br><br>
			
			<label for="itemPrice">Item Price:</label><br>
            <input type="text" id="itemPrice" name="itemPrice" value="<?php echo $itemPrice; ?>" required><br><br>
			
			<label for="startTime">Start Time:</label><br>
            <input type="datetime-local" id="startTime" name="startTime" value="<?php echo $startTime; ?>" required><br><br>
			
			<label for="endTime">End Time:</label><br>
            <input type="datetime-local" id="endTime" name="endTime" value="<?php echo $endTime; ?>" required><br><br>
			
            <input type="submit" value="Edit Item">
			
        </form>
        <p><a href="items_list.php">Cancel</a></p>
    </div>
</body>
</html>

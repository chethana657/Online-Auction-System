<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemPrice = $_POST['itemPrice'];
    $itemCategory = $_POST['itemCategory'];
    $uploadedBy = "Admin";
	$startTimestamp = $_POST['startTimestamp'];
	$endTimestamp = $_POST['endTimestamp'];

    // Upload photo
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["itemPhoto"]["name"]);
    move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $targetFile);

    $sql = "INSERT INTO items (itemName, itemDescription, itemPhoto, itemPrice, itemCategory, uploadedBy, startTime, endTime)
            VALUES ('$itemName', '$itemDescription', '$targetFile', '$itemPrice', '$itemCategory', '$uploadedBy', '$startTimestamp', '$endTimestamp')";
			
    if ($conn->query($sql) === TRUE) {
		$approvalStatus = 'waiting';
		$itemId = $conn->insert_id;
		$sql_approval = "UPDATE items SET approval='$approvalStatus' WHERE itemId='$itemId'";
		$conn->query($sql_approval);
		
        echo "<script>alert('Item added successfully.'); window.location.href = 'items_list.php';</script>";
		exit;
		
    } else {
        $_SESSION['error'] = "Error listing item: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Add Item</h2>
        <form method="POST">
			<label for="itemName">Item Name:</label><br>
            <input type="text" name="itemName" required><br><br>
			
			<label for="itemCategory">Category:</label><br>
				<input type="radio" id="Jewelries" name="itemCategory" value="Jewelries" required>
				<label for="Jewelries">Jewelries</label><br>

				<input type="radio" id="Watches" name="itemCategory" value="Watches">
				<label for="Watches">Watches</label><br>

				<input type="radio" id="Handbags" name="itemCategory" value="Handbags">
				<label for="Handbags">Handbags</label><br>
			
				<input type="radio" id="Arts" name="itemCategory" value="Arts">
				<label for="Arts">Arts</label><br>
					
				<input type="radio" id="Wines" name="itemCategory" value="Wines">
				<label for="Wines">Wines</label><br>
				
            <label for="itemDescription">Item Description:</label><br>
            <input type="text" id="itemDescription" name="itemDescription" required><br><br>
			
			<label for="itemPhoto">Item Image:</label><br>
            <input type="file" id="itemPhoto" name="itemPhoto" required><br><br>
			
			<label for="itemPrice">Item Price:</label><br>
            <input type="text" id="itemPrice" name="itemPrice" required><br><br>
			
			<label for="startTime">Start Time:</label><br>
            <input type="datetime-local" id="startTime" name="startTime" required><br><br>
			
			<label for="endTime">End Time:</label><br>
            <input type="datetime-local" id="endTime" name="endTime" required><br><br>
			
            <input type="submit" value="Add Item">
			
        </form>
        <p><a href="items_list.php">Cancel</a></p>
    </div>
</body>
</html>

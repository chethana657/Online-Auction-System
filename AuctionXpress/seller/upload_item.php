<!-- upload_item.php -->
<?php
session_start();
include '..\config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemPrice = $_POST['itemPrice'];
    $itemCategory = $_POST['itemCategory']; // Retrieve category from form
    $uploadedBy = $_SESSION['username'];
	$startTimestamp = $_POST['startTimestamp'];
	$endTimestamp = $_POST['endTimestamp'];

    // Upload photo
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["itemPhoto"]["name"]);
    move_uploaded_file($_FILES["itemPhoto"]["tmp_name"], $targetFile);

    // Insert item details into database
    $sql = "INSERT INTO items (itemName, itemDescription, itemPhoto, itemPrice, itemCategory, uploadedBy, startTime, endTime)
            VALUES ('$itemName', '$itemDescription', '$targetFile', '$itemPrice', '$itemCategory', '$uploadedBy', '$startTimestamp', '$endTimestamp')";
    if ($conn->query($sql) === TRUE) {
		$approvalStatus = 'waiting';
		$itemId = $conn->insert_id;
		$sql_approval = "UPDATE items SET approval='$approvalStatus' WHERE itemId='$itemId'";
		$conn->query($sql_approval);
		
        echo "<script>alert('Item updated successfully.'); window.history.back();</script>";
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
    <title>Upload Item</title>
</head>
<body>
	<?php
        include "seller_header.php";
    ?>
    <h2>Upload Item</h2>
    <?php
    if(isset($_SESSION['error'])) {
        echo "<p>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        Item Name: <input type="text" name="itemName" required><br>
		
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
				
        Description: <textarea name="itemDescription" required></textarea><br>
        Price: <input type="text" name="itemPrice" required><br>
        Image: <input type="file" name="itemPhoto" required><br>
		Start Date & Time: <input type="datetime-local" name="startTimestamp" required><br>
		End Date & Time: <input type="datetime-local" name="endTimestamp" required><br>
        <input type="submit" value="Upload Item">
    </form>
    <p><a href="seller_home.php">Go back to home page</a></p>
	
	<?php
        include "seller_footer.php";
    ?>
</body>
</html>



<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'Admin') {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Home</title>
	<link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <?php
			include "nav.php";
		
		?>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Admin Home</h2>
            <!-- Filter form -->
            <form action="" method="GET">
                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="">All</option>
                    <option value="Jewelries">Jewelries</option>
                    <option value="Watches">Watches</option>
                    <option value="Handbags">Handbags</option>
                    <option value="Arts">Arts</option>
                    <option value="Wines">Wines</option>
                </select>
                <label for="approval">Approval Status:</label>
                <select name="approval" id="approval">
                    <option value="">All</option>
                    <option value="waiting">Waiting</option>
                    <option value="approved">Approved</option>
                    <option value="not-approved">Not Approved</option>
                </select>
                <input type="submit" value="Filter">
            </form>

            <?php
            include '../config.php';

        // Construct the base SQL query
        $sql = "SELECT * FROM items";

        // Add filters if provided in the URL
        if (isset($_GET['category']) && $_GET['category'] != '') {
            $category = $_GET['category'];
            $sql .= " WHERE itemCategory = '$category'";
        }
        if (isset($_GET['approval']) && $_GET['approval'] != '') {
            $approval = $_GET['approval'];
            $sql .= " WHERE approval = '$approval'";
        }

        // Order by item ID in descending order
        $sql .= " ORDER BY itemId DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Display items
                echo "<div class='item " . strtolower($row['approval']) . "'>";
                echo "<h3>" . $row["itemName"] . "</h3>";
                echo "<p>Description: " . $row["itemDescription"] . "</p>";
                echo "<p>Price: $" . $row["itemPrice"] . "</p>";
                echo "<p>Uploaded By: " . $row["uploadedBy"] . "</p>";
                echo "<form action='update_approval.php' method='post'>";
                echo "<input type='hidden' name='itemId' value='" . $row["itemId"] . "'>";
                echo "<select name='approvalStatus'>";
                echo "<option value='waiting' " . ($row['approval'] == 'waiting' ? 'selected' : '') . ">Waiting</option>";
                echo "<option value='approved' " . ($row['approval'] == 'approved' ? 'selected' : '') . ">Approved</option>";
                echo "<option value='not-approved' " . ($row['approval'] == 'not-approved' ? 'selected' : '') . ">Not Approved</option>";
                echo "</select>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No items found.";
        }
        $conn->close();
            ?>
        </div>
    </div>
</body>
</html>

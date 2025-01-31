<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'Buyer') {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../images/logo.png">
    <title>All Products</title>
    <link rel="stylesheet" href="styles/all_items.css">
</head>
<body>
	<div>
        <?php
        include "buyer_header.php";
        ?>
    </div>
    <div class="container">
        <h2 class="topic-sentence">All Products</h2>

        <!-- Filter form -->
        <div class="filter">
            <h3>Filter</h3>
            <form action="" method="GET">
                <label for="category">Category:</label> <br>
					<input type="radio" name="category" value="" checked="checked">All <br>
					<input type="radio" name="category" value="Jewelries">Jewelries <br>
					<input type="radio" name="category" value="Handbags">Handbags <br>
					<input type="radio" name="category" value="Watches">Watch <br>
					<input type="radio" name="category" value="Arts">Arts <br>
					<input type="radio" name="category" value="Wines">Wines <br>
                <br>
                <label for="seller">Seller:</label><br>
					<input type="radio" name="seller" value="" checked="checked">All <br>
                    <!-- Retrieve and populate seller options from the database -->
                    <?php
                    include '../config.php';
                    $sql = "SELECT DISTINCT uploadedBy FROM items";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<input type='radio' name='seller' value='" . $row['uploadedBy'] . "'>" . $row['uploadedBy'] . "<br>";
                        }
                    }
                    ?>
                <br>
                <input type="submit" value="Filter">
            </form>
        </div>

        <!-- Display items -->
        <div class="items-grid">
            <?php
            // Retrieve and display items with pictures
			$sql = "SELECT * FROM items WHERE approval = 'approved'";
            if(isset($_GET['category']) && $_GET['category'] != '') {
                $category = $_GET['category'];
                $sql .= " AND itemCategory = '$category'";
            }
            if(isset($_GET['seller']) && $_GET['seller'] != '') {
                $seller = $_GET['seller'];
                if(strpos($sql, 'WHERE') !== false) {
                    $sql .= " AND uploadedBy = '$seller'";
                } else {
                    $sql .= " WHERE uploadedBy = '$seller'";
                }
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
					// Generate unique IDs for bidding status and bid button
					$biddingStatusId = 'biddingStatus_' . $row['itemId'];
					$viewDetailsId = 'viewDetails_' . $row['itemId'];
					$statusId = 'status_' . $row['itemId']; // Unique status ID for each item

					echo "<div class='item'>
							<img src='" . $row["itemPhoto"] . "' alt='" . $row["itemName"] . "' />
							<h3>" . $row["itemName"] . "</h3>
							<p id='" . $biddingStatusId . "'></p>
							<p>Price: $" . $row["itemPrice"] . "</p>
							<p id='" . $statusId . "'></p>
							<button onclick=\"window.location.href='item_details.php?itemId=" . $row["itemId"] . "'\">View Details</button>
						</div>";

					// $startTime = strtotime($row['startTime']); 
					// $endTime = strtotime($row['endTime']); 
					
					$startTime = $row['startTime'];
                    $endTime = $row['endTime'];
					

					echo "<script>
							function updateCurrentTime() {
								var currentTime = new Date().getTime();
								var startTime = new Date('" . $startTime . "').getTime();
								var endTime = new Date('" . $endTime . "').getTime();
								
								var statusId = '" . $statusId . "'; 
								var statusElement = document.getElementById(statusId);

								if (currentTime < startTime) {
									statusElement.innerHTML = 'Bidding Starts at: ' + new Date(startTime);
								} else if (currentTime >= startTime && currentTime <= endTime) {
									statusElement.innerHTML = 'Bidding in Progress';
								} else {
									statusElement.innerHTML = 'Bidding Ended';
								}
							}
							
							setInterval(updateCurrentTime, 1000);
						  </script>";
				}

            } else {
                echo "No items found.";
            }
            $conn->close();
            ?>
        </div>
    </div>
	</div>
	
	<div>
        <?php
        include "buyer_footer.php";
        ?>
    </div>

</body>
</html>






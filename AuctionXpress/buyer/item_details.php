<!-- item_details.php -->

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
    <title>Product Details</title>
	<link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="styles/item_details.css">
</head>
<body>
	<div>
        <?php
        include "buyer_header.php";
        ?>
    </div>

	<button onclick="redirectToPage()" style="background:none;border:none;color:black;text-decoration:underline;cursor:pointer;font-size:18px;padding-top:20px;padding-left:20px;">&lt; Go Back</button>

	<script>
	function redirectToPage() {
    window.location.href = 'all_products.php';
	}
	</script>
	
    <div class="container">
        
        <?php
        include '../config.php';
		$itemId = $_GET['itemId'];
		echo "<h2>Product ".$itemId." Details</h2>";
		
        $loggedInUser = $_SESSION['username'] ?? ''; // Get logged-in user

        if(isset($_GET['itemId'])) {
            $itemId = $_GET['itemId'];
			
			$tableName = "bids_" . $itemId;
			$sql_create_table = "CREATE TABLE IF NOT EXISTS $tableName (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				bidedBy VARCHAR(30) NOT NULL,
				bidedAmount DECIMAL(10,2) NOT NULL
			)";
			if ($conn->query($sql_create_table) === FALSE) {
				echo "Error creating table: " . $conn->error;
				exit();
			}

            // Retrieve item details from the database
            $sql = "SELECT * FROM items WHERE itemId = $itemId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
					<div class='details-container'>
					<div class='item-details'>
                    <h3>".$row['itemName']." </h3>
                    <p>Description: ". $row['itemDescription'] ." </p>
                    <p>Price: $". $row['itemPrice'] ." </p></div></div>
					<div class='image-container'><div class='item-image'><img src='".$row['itemPhoto']."' alt=" . $row["itemName"] . "></div></div>";
                    
                    $startTime = $row['startTime'];
                    $endTime = $row['endTime'];
                    
                    echo "<p id='biddingStatus'>Bidding Status:</p>"; // Placeholder for bidding status
					
					
					
					// Display highest bid
					$tableName = "bids_" . $itemId;
                    $sql_bid = "SELECT MAX(bidedAmount) AS highestBid FROM $tableName";
                    $result_bid = $conn->query($sql_bid);
                    $row_bid = $result_bid->fetch_assoc();
                    $highestBid = ($row_bid['highestBid']) ? $row_bid['highestBid'] : "No bids yet";
                    echo "<p>Highest Bid: $" . $highestBid . "</p>";
					
					echo "<p id='currentResult'><p>";
					
					
					// Check if logged-in user has the highest bid
					$sql_user_bid = "SELECT MAX(bidedAmount) AS userBid FROM $tableName WHERE bidedBy = '$loggedInUser'";
                    $result_user_bid = $conn->query($sql_user_bid);
                    $row_user_bid = $result_user_bid->fetch_assoc();
                    $userBid = $row_user_bid["userBid"];
					
					
					echo "<script>
							function bidUpdate() {
								var currentTime = new Date().getTime();
								var startTime = new Date('" . $startTime . "').getTime();
								var endTime = new Date('" . $endTime . "').getTime();
								
								if (currentTime < startTime) {
									document.getElementById('biddingStatus').innerHTML = 'Bidding Status: Bidding Starts at: " . $startTime . "';
									document.getElementById('bidButton').disabled = true;
									document.getElementById('bidButton+').disabled = true;
									document.getElementById('bidButton-').disabled = true;
									document.getElementById('payButton').disabled = true;
								} 
								
								else if (currentTime >= startTime && currentTime <= endTime){
									if ($userBid === $highestBid) {
										document.getElementById('biddingStatus').innerHTML = 'Bidding Status: Bidding in progress. Bidding will ends at " . $endTime . "';
										document.getElementById('currentResult').innerHTML = '<p>You have the current highest bid</p>';
										document.getElementById('bidButton').disabled = true;
										document.getElementById('bidButton+').disabled = true;
										document.getElementById('bidButton-').disabled = true;
										document.getElementById('payButton').disabled = true;
										} 
									
									
									else{
										document.getElementById('bidButton').disabled = false;
										document.getElementById('bidButton+').disabled = false;
										document.getElementById('bidButton-').disabled = false;
										document.getElementById('payButton').disabled = true;
									}									
								}
									
								else {
									document.getElementById('biddingStatus').innerHTML = 'Bidding Status: Bidding Ended at " . $endTime . "';
									document.getElementById('bidButton').disabled = true;
									document.getElementById('bidButton+').disabled = true;
									document.getElementById('bidButton-').disabled = true;

									if ($userBid === $highestBid) {
										document.getElementById('currentResult').innerHTML = '<p>You have won the bid with a bid of Rs." . $highestBid . "</p>';
										document.getElementById('payButton').disabled = false;
									} 
									else {
										document.getElementById('currentResult').innerHTML = '<p>You have lost the bid.</p>';
										document.getElementById('payButton').disabled = true;
									}
								}
							}

							setInterval(bidUpdate, 1000);
						</script>";
					
					
                    echo "
						<form action='place_bid.php' method='POST'>
						<input type='hidden' name='itemId' value='$itemId'>
						<label for='bidAmount'>Your Bid:</label>
						<input type='number' id='bidAmount' name='bidAmount' min='$highestBid' value='$highestBid' readonly required>
						<button type='button' id='bidButton-' onclick='decrementBid()'>-</button>
						<button type='button' id='bidButton+' onclick='incrementBid()'>+</button>
						<button type='submit' id='bidButton' name='action' value='bid'>Bid</button>
						</form>
						<button type='submit' id='payButton' value='pay' onclick='redirectToPage()'>Pay</button>

						<script>
						function incrementBid() {
							var bidAmount = document.getElementById('bidAmount');
							bidAmount.stepUp(100);
						}

						function decrementBid() {
							var bidAmount = document.getElementById('bidAmount');
							bidAmount.stepDown(100);
						}
						
						function redirectToPage() {
							window.location.href = 'payment_methods.php';
						}
						</script>";
                    
                    echo "</div>";
                }
            } else {
                echo "Item not found.";
            }
        } else {
            echo "Item ID not provided.";
        }
        $conn->close();
        ?>
    </div>
	<?php
        include "buyer_footer.php";
    ?>
	
</body>
</html>

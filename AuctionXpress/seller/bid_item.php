<?php
include '../config.php';

session_start();

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}


if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];

	$tableName = "bids_" . $itemId;
	
	$sql = "SHOW TABLES LIKE '$tableName'";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 1) {
		$sql_select = "SELECT * FROM $tableName";
		$result = $conn->query($sql_select);
	
		if ($result->num_rows > 1) {
			$row = $result->fetch_assoc();
			$timestamp = $row['timestamp'];
			$bidedBy = $row['bidedBy'];
			$bidedAmount = $row['bidedAmount'];
		} 
		else {
			echo "<script>alert('No biddings happend yet.'); window.history.back();</script>";
			exit;
		}
	}
	else {
		echo "<script>alert('No biddings happend yet.'); window.history.back();</script>";
		exit;
	}
} 
else {
    echo "<script>alert('Username parameter is missing'); window.history.back();</script>";
	exit;
}
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Biding Status</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-group {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <div class="container">
		<?php
			include "seller_header.php";
		?>
        <h2>Item ID:<?php echo $itemId ?> Bidding Status</h2>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Bided By</th>
                    <th>Bided Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                $sql = "SELECT * FROM $tableName";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['timestamp'] . "</td>";
                        echo "<td>" . $row['bidedBy'] . "</td>";
                        echo "<td>" . $row['bidedAmount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No buyers found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <p><a href="javascript:history.go(-1)">Back</a></p>
    </div>
</body>
</html>







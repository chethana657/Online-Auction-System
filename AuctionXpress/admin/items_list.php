<!DOCTYPE html>
<html>
<head>
    <title>Items List</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/nav.css">
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
			include "nav.php";
		
		?>
        <h2>Items List</h2>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Description</th>
                    <th>Item Price</th>
                    <th>Item Category</th>
                    <th>Uploaded By</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                // Retrieve all sellers' details except passwords from the users table
                $sql = "SELECT * FROM items";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['itemId'] . "</td>";
                        echo "<td>" . $row['itemName'] . "</td>";
                        echo "<td>" . $row['itemDescription'] . "</td>";
                        echo "<td>" . $row['itemPrice'] . "</td>";
                        echo "<td>" . $row['itemCategory'] . "</td>";
                        echo "<td>" . $row['uploadedBy'] . "</td>";
                        echo "<td>" . $row['startTime'] . "</td>";
                        echo "<td>" . $row['endTime'] . "</td>";
						
                        echo "<td class='btn-group'>";
                        echo "<a href='edit_item.php?itemId=" . $row['itemId'] . "'><button>Edit</button></a>";
                        echo "<a href='remove_item.php?itemId=" . $row['itemId'] . "'><button>Remove</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No items found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <p><a href="add_item.php">Add Item</a></p>
    </div>
</body>
</html>

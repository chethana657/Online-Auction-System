<!DOCTYPE html>
<html>
<head>
    <title>Sellers List</title>
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
        <h2>Sellers List</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>E-Mail</th>
                    <th>Contact No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                // Retrieve all sellers' details except passwords from the users table
                $sql = "SELECT * FROM sellers";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['firstName'] . "</td>";
                        echo "<td>" . $row['lastName'] . "</td>";
                        echo "<td>" . $row['contactNo'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td class='btn-group'>";
                        echo "<a href='seller_items.php?username=" . $row['username'] . "'><button>View Items</button></a>";
                        echo "<a href='edit_seller.php?username=" . $row['username'] . "'><button>Edit</button></a>";
                        echo "<a href='remove_seller.php?username=" . $row['username'] . "'><button>Remove</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No sellers found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <p><a href="add_seller.php">Add Seller</a></p>
    </div>
</body>
</html>

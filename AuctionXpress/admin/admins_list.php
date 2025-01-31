<!DOCTYPE html>
<html>
<head>
    <title>Admins List</title>
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
        <h2>Admins List</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                $sql = "SELECT * FROM users where userType='Admin'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td class='btn-group'>";
                        echo "<a href='edit_admin.php?username=" . $row['username'] . "'><button>Edit</button></a>";
                        echo "<a href='remove_admin.php?username=" . $row['username'] . "'><button>Remove</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No Admins found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <p><a href="add_admin.php">Add Admin</a></p>
    </div>
</body>
</html>

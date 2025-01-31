<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'Buyer') {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}
?>

<!DOCTYPE html>

<head>
    <title>Sellers Data</title>
    <link rel="stylesheet" href="styles/all_sellers.css">
</head>
<body>
	<?php
        include "buyer_header.php";
    ?>
    <h2>Sellers Data</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact No</th>
        </tr>
       
	    <?php
        
        include_once '../config.php';

   
        $sql = "SELECT username, firstName, lastName, email, contactNo FROM sellers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["username"]."</td>";
                echo "<td>".$row["firstName"]."</td>";
                echo "<td>".$row["lastName"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["contactNo"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        ?>
    </table>
	
	<?php
        include "buyer_footer.php";
		$conn->close();
    ?>
</body>
</html>


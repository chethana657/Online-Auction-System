<!DOCTYPE html>
<html>

<head>
	<link rel = "stylesheet" href = "../styles/styles.css">
</head>

<body>
	<header>
		<a href="seller_home.php"><img src = "../images/logo.png" alt = "Logo" width = "150" height = "150" class = "logo"></a>
		<a href="seller_home.php" style="text-decoration:none;"><h1 class = "topic">Auction Xpress</h1></a>
		<div class="login">
			<a href="user_details.php"><img src = "../images/noDp.png" alt = "Rrofile Picture" width = "100" height = "100" class = "profilePicture"></a>
			<span class = "profileName" ><a href="user_details.php">
			<?php
				echo "<h2>{$_SESSION['username']}</h2>";
			?></a></span>
		</div>
	</header>

<ul class = "nav">
<li class = "list1 list1_1"><a href = "seller_home.php">Home</a></li>
<li class = "list1 list1_2"><a href = "user_details.php">Profile</a></li>
<li class = "list1 list1_3"><a href = "upload_item.php">Add Item</a></li>
<li class = "list1 list1_4"><a href = "aboutUs.php">About Us</a></li>
<li class = "list1 list1_6"><a href = "contact_us.php">Contact Us</a></li>
<li class = "list1 list1_5"><a href = "../logout.php">Logout</a></li>
<input type = "text" name = "search" placeholder = "Search..">
</ul>

</body>
</html>






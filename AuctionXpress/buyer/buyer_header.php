<!DOCTYPE html>
<html>

<head>
	<link rel = "stylesheet" href = "../styles/styles.css">
</head>

<body>

	<header>
		<a href="#"><img src = "../images/logo.png" alt = "Logo" width = "150" height = "150" class = "logo"></a>
		<a href="#" style="text-decoration:none;"><h1 class = "topic">Auction Xpress</h1></a>
		<div class="login">
			<a href="user_details.php"><img src = "../images/noDp.png" alt = "Profile Picture" width = "100" height = "100" class = "profilePicture"></a>
			<span class = "profileName"><a href = "user_details.php">
			<?php
				echo "<h2>{$_SESSION['username']}</h2>";
			?></a></span></a></span>
		</div>
	</header>

<ul class = "nav">
<li class = "list1 list1_1"><a href = "buyer_home.php">Home</a></li>
<li class = "list1 list1_2"><a href = "aboutUs.php">About Us</a></li>
<li class = "list1 list1_3"><a href = "all_products.php">All Products</a></li>
<li class = "list1 list1_4"><a href = "all_sellers.php">Sellers</a></li>
<li class = "list1 list1_5"><a href = "contact_us.php">Contact Us</a></li>
<li class = "list1 list1_6"><a href = "../logout.php">Logout</a></li>
<input type = "text" name = "search" placeholder = "Search..">
</ul>



</body>
</html>







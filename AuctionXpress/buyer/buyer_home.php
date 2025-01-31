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
	<title>Home</title>
	<link rel="icon" href="../images/logo.png">
	<link rel = "stylesheet" href = "../styles/styles.css">
	<link rel = "stylesheet" href = "styles/home.css">
	<script src = "js/myScript.js"></script>
</head

<body>
	<div>
        <?php
        include "buyer_header.php";
        ?>
    </div>

<div class = "slideshow">
    <img src = "images/Watch.png" alt = "Image 1" class = "slide">
	<img src = "images/Bag.png" alt = "Image 2" class = "slide">
	<img src = "images/Wine.png" alt = "Image 3" class = "slide">
	<img src = "images/Jewellery.png" alt = "Image 4" class = "slide">
	<img src = "images/Art.png" alt = "Image 5" class = "slide">
	<script>
	    showSlides();
	</script>
</div>

<h2>Upcoming Auctions</h2>
<div class = "upcoming_auctions">
	<div class = "upcoming_item">
	<img src = "images/Handbag_1.png" alt = "Item_1" class = "upcoming_item item">
	<h4>Handbags</h4>
	<time datetime = "06-05-2024 10:00">04-10 May 2024 | 10:00 AM</time><br>
	<button class = "bttn1">BID</button>
	</div>
	<div class = "upcoming_item">
	<img src = "images/Jewellery_1.png" alt = "Item_2" class = "upcoming_item item">
	<h4>Jewelleries</h4>
	<time datetime = "06-05-2024 10:00">04-10 May 2024 | 10:00 AM</time><br>
	<button class = "bttn1">BID</button>
	</div>
	<div class = "upcoming_item">
	<img src = "images/Wine_1.png" alt = "Item_2" class = "upcoming_item item">
	<h4>Wines</h4>
	<time datetime = "06-05-2024 10:00">04-10 May 2024 | 10:00 AM</time><br>
	<button class = "bttn1">BID</button>
	</div>
	<div class = "upcoming_item">
	<img src = "images/Watch_1.png" alt = "Item_2" class = "upcoming_item item">
	<h4>Watches</h4>
	<time datetime = "06-05-2024 10:00">04-10 May 2024 | 10:00 AM</time><br>
	<button class = "bttn1">BID</button>
	</div>
</div>

<h2>Categories</h2>
<div class="categories">
    <div class="category_item">
        <a href="all_products.php?category=Watches">
            <img src="images/Watch_2.png" alt="Item_1" class="category_item item">
            <h4>Watches</h4>
        </a>
    </div>
    <div class="category_item">
        <a href="all_products.php?category=Handbags">
            <img src="images/Handbag_2.png" alt="Item_2" class="category_item_item">
            <h4>Handbags</h4>
        </a>
    </div>
    <div class="category_item">
        <a href="all_products.php?category=Jewelleries">
            <img src="images/Jewellery_2.png" alt="Item_3" class="category_item_item">
            <h4>Jewelleries</h4>
        </a>
    </div>
    <div class="category_item">
        <a href="all_products.php?category=Wines">
            <img src="images/Wine_2.png" alt="Item_4" class="category_item_item">
            <h4>Wines</h4>
        </a>
    </div>
    <div class="category_item">
        <a href="all_products.php?category=Art">
            <img src="images/Art_2.png" alt="Item_5" class="category_item_item">
            <h4>Arts</h4>
        </a>
    </div>
</div>

	
	<div>
        <?php
        include "buyer_footer.php";
        ?>
    </div>

</body>
</html>
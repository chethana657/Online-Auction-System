<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'Seller') {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login.html");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="../styles/aboutUs.css">
</head>
<body>
<div>
    <?php
    include "seller_header.php";
    ?>
</div>
<div class="container">
    <div class="grid-container">
        <div class="left-content">
            <h1> About Us </h1>
            <p>
                Welcome to our online auction platform, where enthusiasts, collectors, and sellers come together to explore
                a world of treasure and unique finds. At our online auction system, we are passionate about connecting buyers
                and sellers from all corners of the globe, creating a vibrant marketplace where every item tells a story and
                every bid is an opportunity for discovery.
            </p>
            <img src="../images/aboutUs2.jpg" alt="About Us Image">
        </div>
        <div class="right-content">
			<img src="../images/aboutUs1.jpg" alt="About Us Image">
            <h1> Our Mission </h1>
            <p>
                Our mission is to provide a seamless and secure platform for individuals to buy and sell a wide range of
                items, from rare antiques and vintage collectibles to contemporary art and designer fashion.

                with years of experience in the online auction industry, we have built a reputation for reliability,
                integrity, and customer satisfaction. We take pride in offering a user-friendly interface, robust security
                measures, and exceptional customer service to ensure a positive experience for all our users.
            </p>
      
        </div>
    </div>
</div>
<div>
    <?php
    include "seller_footer.php";
    ?>
</div>

</body>
</html>


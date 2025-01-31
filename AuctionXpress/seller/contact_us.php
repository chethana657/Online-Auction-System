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
    <title> Online Auction System contact us </title>
	<link rel = "stylesheet" href = "styles/contact_us.css">
	<link rel="icon" href="../iamges/logo.png">
</head>

<body>
	
	<?php
        include "seller_header.php";
    ?>

<center>
<h2>Contact Us</h2>
<p>If you need help with something, Send us an email to <strong>AuctionXpress@gmail.com</strong></p></center>
 
<div class = "Contact_form">
<p>We really want your feedfack!!<br><br>
You can also send us your suggestion and comments,concern by filling out this form. Our agents will reach out to you within 24 hours.</p><br>

<form action="contact_us_insert.php" method = "POST">
    
    <label for = "Your Name"><b>Your Name</b></label><br>
    <input type="text" name="name"  required><br><br><br>

    <label for="E-mail"><b>E-mail</b></label><br>
    <input type="email" name="email"  required><br><br><br>

    <label for="Subject"><b>Subject</b></label><br>
    <input type="text" name="subject"  required><br><br><br>
	
    <label for="Message"><b>Message</b></label><br>
    <input type="text" name="message"  required><br><br><br>
	
	<center><input type = "submit" name = "Submit"></center>
</form>
</div>
	<?php
        include "seller_footer.php";
    ?>
</body>
</html>
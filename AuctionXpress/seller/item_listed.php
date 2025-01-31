<!-- item_listed.php -->
<?php
session_start();
if(isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
} else {
    header("Location: seller_home.php");
    exit;
}
?>
<p><a href="seller_home.php">Go back to home page</a></p>

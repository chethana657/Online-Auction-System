<!-- profile_updated.php -->
<?php
session_start();
if(isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
} else {
    header("Location: home.php");
    exit;
}
?>
<p><a href="home.php">Go back to home page</a></p>

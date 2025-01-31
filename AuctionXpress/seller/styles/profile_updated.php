
<!-- profile_updated.php -->
<?php
session_start();
if(isset($_SESSION['message'])) {
    // Display a JavaScript alert with the session message
    echo "<script>alert('{$_SESSION['message']}');</script>";
    // Unset the session message
    unset($_SESSION['message']);
    // Redirect to another page after the user clicks OK on the alert box
    echo "<script>window.location.href = 'user_details.php';</script>";
    exit;
} else {
    // If there is no session message, redirect to seller_home.php
    header("Location: user_details.php");
    exit;
}
?>


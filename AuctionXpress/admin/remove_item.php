<?php
include '../config.php';

if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];

    $sql = "DELETE FROM items WHERE itemId = '$itemId'";
    $conn->query($sql);

    echo "<script>alert('Item deleted successfully.'); window.location.href = 'items_list.php';</script>";
}
else {
    echo "ItemID parameter is missing.";
    exit;
}
$conn->close();
?>



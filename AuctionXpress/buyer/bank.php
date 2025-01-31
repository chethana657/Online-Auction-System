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
    <title>Bank Transfers</title>
    <link rel="icon" href="../logo.png">
    <link rel="stylesheet" href="styles/bank.css">
</head>

<body>
    <div>
        <?php
        include "buyer_header.php";
        ?>
    </div>

    <br><br>
    <div class="container">
        <fieldset>
            <legend>Bank Transfers</legend>
            <div class="paybox">
                <form action="">
                    <div class="inputBox">
                        <span>Beneficiary Bank</span>
                        <input type="text" class="card-holder-input">
                    </div>
                    <div class="inputBox">
                        <span>Account Number</span>
                        <input type="text" maxlength="16" class="card-number-input"><br><br>
                    </div>
                    <div class="inputBox">
                        <span>Account holder</span>
                        <input type="text" class="card-holder-input">
                    </div>
                    <div class="inputBox">
                        <span>Amount</span>
                        <input type="text" class="card-holder-input">
                    </div>
                    <div class="inputBox">
                        <span>Remarks</span>
                        <textarea class="remarks-input"></textarea>
                    </div>
                    <input type="submit" value="Submit" class="submit-btn" onclick="myFunction()">
                    <script>
                        function myFunction() {
                            alert("Payment is successful!");
                            window.location.href = "buyer_home.php";
                        }
                    </script>
                </form>
            </div>
        </fieldset>
    </div>

    <div>
        <?php
        include "buyer_footer.php";
        ?>
    </div>
</body>

</html>

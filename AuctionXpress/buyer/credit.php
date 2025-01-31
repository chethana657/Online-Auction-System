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
    <title>Credit/Debit card payments</title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="styles/credit.css">
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
            <legend>Credit & Debit card payments</legend>
            <div class="paybox">
                <form action="">
                    <div class="inputBox">
                        <span>Card Number</span>
                        <input type="text" class="card-holder-input">
                    </div>
                    <div class="inputBox">
                        <span>Card Holder</span>
                        <input type="text" maxlength="16" class="card-number-input"><br><br>
                    </div>
                    <div class="inputBox1">
                        <div class="flexbox">
                            <span>Expiration Month</span><br>
                            <select name="" id="" class="month-input">
                                <option value="month" selected disabled>MM</option>
                                <option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
                            </select>

                        </div>
                    </div>
                    <div class="inputBox1">
                        <div class="flexbox">
                            <span>Expiration Year</span><br>
                            <select name="" id="" class="year-input">
                                <option value="month" selected disabled>YYYY</option>
                                <option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
								<option value="2027">2027</option>
								<option value="2028">2028</option>
								<option value="2029">2029</option>
								<option value="2030">2030</option>
								<option value="2031">2031</option>
								<option value="2032">2032</option>
								<option value="2033">2033</option>
								<option value="2034">2034</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="inputBox1">
                        <br><span>CVV</span><br>
                        <input type="text" maxlength="4" class="cvv-input">
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

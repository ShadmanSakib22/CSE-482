<?php

//mydb
require('conn.php');

session_start();

if (!isset($_SESSION['log_name'])) {
    header('Location: login.php');
}




$val_id = urlencode($_POST['val_id']);
$store_id = urlencode("artis663e7429a624a");
$store_passwd = urlencode("artis663e7429a624a@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if ($code == 200 && !(curl_errno($handle))) {

    # TO CONVERT AS ARRAY
    # $result = json_decode($result, true);
    # $status = $result['status'];

    # TO CONVERT AS OBJECT
    $result = json_decode($result);

    # TRANSACTION INFO
    $status = $result->status;
    $tran_date = $result->tran_date;
    $tran_id = $result->tran_id;
    $val_id = $result->val_id;
    $amount = $result->amount;
    $store_amount = $result->store_amount;
    $bank_tran_id = $result->bank_tran_id;
    $card_type = $result->card_type;
    $currency = $result->currency;

    # EMI INFO
    $emi_instalment = $result->emi_instalment;
    $emi_amount = $result->emi_amount;
    $emi_description = $result->emi_description;
    $emi_issuer = $result->emi_issuer;

    # ISSUER INFO
    $card_no = $result->card_no;
    $card_issuer = $result->card_issuer;
    $card_brand = $result->card_brand;
    $card_issuer_country = $result->card_issuer_country;
    $card_issuer_country_code = $result->card_issuer_country_code;

    # API AUTHENTICATION
    $APIConnect = $result->APIConnect;
    $validated_on = $result->validated_on;
    $gw_version = $result->gw_version;

    $price = $_GET['price'];
    echo "<b>Receipt: </b><br>";
    echo "Transaction Status: " . $status . "<br>";

    if ($status == 'VALID') {
        echo "Transaction Date: " . $tran_date . "<br>";
        echo "Transaction ID: " . $tran_id . "<br>";
        echo "Price: " . $price . " - ";
        echo "Currency: " . $currency . " Paid <br><br>";

        if ($price == 2500) {
            $username = $_SESSION['log_name'];

            // Update user_type to 1 (subscribed)
            $sql = "UPDATE users SET user_type = '1' WHERE username = '$username'";
            $result = $conn->query($sql);

            // Calculate subscription end date (3 months from now)
            $endDate = date("Y-m-d", strtotime("+3 months"));

            // Insert or update subscription end date in the subs table
            $sql2 = "INSERT INTO subs (username, end_date) VALUES ('$username', '$endDate') 
         ON DUPLICATE KEY UPDATE end_date = DATE_ADD(end_date, INTERVAL 3 MONTH)";
            $result2 = $conn->query($sql2);

            echo "Thank You for purchasing the 3 month Subscription. Please Sign-in Again to to avail subscriber bonuses.<br>";
            echo "<a href='login.php'>Sign-in</a>";
        } elseif ($price == 1000) {
            $username = $_SESSION['log_name'];

            // Update user_type to 1 (subscribed)
            $sql = "UPDATE users SET user_type = '1' WHERE username = '$username'";
            $result = $conn->query($sql);

            // Calculate subscription end date (1 months from now)
            $endDate = date("Y-m-d", strtotime("+1 months"));

            // Insert or update subscription end date in the subs table
            $sql2 = "INSERT INTO subs (username, end_date) VALUES ('$username', '$endDate') 
         ON DUPLICATE KEY UPDATE end_date = DATE_ADD(end_date, INTERVAL 1 MONTH)";
            $result2 = $conn->query($sql2);

            echo "Thank You for purchasing the 1 month Subscription. Please Sign-in Again to to avail subscriber bonuses.<br>";
            echo "<a href='login.php'>Sign-in</a>";
        } else {
            echo "Thank You for the Tip. Your donation of " . $price . " BDT is much appreciated. <br>";
            echo "<a href='blog.php'>Return</a>";
            $username = $_SESSION['log_name'];
            $sql = "INSERT INTO tips (username, tip) VALUES ('$username', '$price')";
            $result = $conn->query($sql);
        }
    } elseif ($status == 'VALIDATED') {
        echo "<br>";
        echo "\nTransaction already went through. Please Sign-in Again or click Return to continue. <br><br>";
        echo "<a href='login.php'>Sign-in</a><br>";
        echo "<a href='blog.php'>Return</a>";
    } else {
        echo "<br>";
        echo "\nError: Transaction Failed. Please Try Again Later.";
    }
} else {
    echo "<br>";
    echo "Failed to connect with SSLCOMMERZ";
}






//https://sandbox.sslcommerz.com/manage/
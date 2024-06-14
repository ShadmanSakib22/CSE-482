<?php
require('conn.php');

if (isset($_GET['code'])) {
    $verificationCode = $_GET['code'];

    // Update the commission record to mark it as verified
    $sql = "UPDATE commission SET verified = 1 WHERE verification_code = '$verificationCode'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Commission verified successfully.");
             window.location.href = "commission.php";</script>';
    } else {
        echo '<script>alert("Invalid verification code or already verified.");
             window.location.href = "commission.php";</script>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo '<script>alert("Invalid verification link.");
         window.location.href = "commission.php";</script>';
}

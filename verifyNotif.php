<?php

if (isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);

    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Connect to the database
        require('conn.php');

        // Update the database to mark the email as verified
        $stmt = $conn->prepare("UPDATE notifications SET verified = 1 WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the statement
        if ($stmt->execute()) {
        
            echo '<script>alert("Your email has been verified successfully!");
                 window.location.href = "commission.php";</script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "No email address provided.";
}

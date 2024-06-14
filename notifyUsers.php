<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the notification message from the form
    $notification = filter_var($_POST["notification"], FILTER_SANITIZE_STRING);
    // Connect to the Database
    require('conn.php');

    // Fetch verified users' email addresses
    $sql = "SELECT email FROM notifications WHERE verified = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mail = new PHPMailer(true);

        // PHPMailer setup
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'artisanhub30@outlook.com'; // Replace with your address
            $mail->Password = 'tester123HUB'; // Replace with your password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //sender info
            $mail->setFrom('artisanhub30@outlook.com', 'Artisan Hub');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Notification from Artisan Hub';
            $mail->Body = $notification;

            // Loop through each verified user and add their email address to the recipient list
            while ($row = $result->fetch_assoc()) {
                $mail->addBCC($row["email"]);
            }

            // Send the email
            $mail->send();
            echo "Notification sent successfully!";
        } catch (Exception $e) {
            echo "Notification could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No verified users found.";
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request method.";
}

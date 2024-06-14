<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted email address
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Connect to the database
        require('conn.php');

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO notifications (email) VALUES (?)");
        $stmt->bind_param("s", $email);

        // Execute the statement
        if ($stmt->execute()) {
            // Send verification email
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp-mail.outlook.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'artisanhub30@outlook.com'; // Replace with your address
                $mail->Password = $_ENV['Mail_Password']; //mailPassword from .env; 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //sender info
                $mail->setFrom('artisanhub30@outlook.com', 'Artisan Hub');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Verify Your Email';
                $mail->Body = 'Please click the link to verify your email: <a href="http://localhost/artisanhub/verifyNotif.php?email=' . urlencode($email) . '">Verify Email</a>';

                $mail->send();
                echo "Your email has been registered for notifications! Please check your email to verify and receive updates.";
            } catch (Exception $e) {
                echo "Notification sign-up succeeded, but verification email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
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
    echo "Invalid request method.";
}

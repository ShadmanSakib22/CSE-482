<?php

require_once('conn.php');

session_start();

require_once('cookie.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST["pass"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            if ($row['user_type'] == '0') {
                $_SESSION['log_name'] = $row['username'];
                $_SESSION['log_type'] = $row['user_type'];

                header('location: blog.php');
            } else if ($row['user_type'] == '1') {
                $_SESSION['log_name'] = $row['username'];
                $_SESSION['log_type'] = $row['user_type'];

                header('location: blog.php');
            } else if ($row['user_type'] == '2') {
                $_SESSION['log_name'] = $row['username'];
                $_SESSION['log_type'] = $row['user_type'];

                header('location: admin.php');
            }
        } else {
            $message = "Incorrect Password Entered.\\nTry again.";
            echo "<script type='text/javascript'>alert('$message'); window.location.href = 'login.php';     
        </script>";
        }
    } else {
        // User not found with the provided email
        $message = "No User found with the provided email.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message'); window.location.href = 'login.php';     
        </script>";
    }
}

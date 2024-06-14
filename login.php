<?php

require_once('conn.php');

session_start();

if (isset($_SESSION['log_name'])) {
    $logButton = '<a class="btn btn-outline-light" style="background-color: #60ce80;" href="logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a>';
} else {
    $logButton = '<a class="btn btn-outline-light" style="background-color: #60ce80;" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Sign In</a>';
}

if (isset($_SESSION['log_type'])) {
    if ($_SESSION['log_type'] == "0") {
        $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>';
    } elseif ($_SESSION['log_type'] == "1") {
        $subButton = '<a href="subExtras.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Extras</a>';
    } elseif ($_SESSION['log_type'] == "2") {
        $subButton = '<a href="admin.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Admin Panel</a>';
    } else {
        $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>'; // Handle unknown user type 
    }
} else {
    $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>'; // Handle unset log_type
}

$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($name)) {
        $nameErr = "Name is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !valid_email($email)) {
        $emailErr = "Invalid email format";
    }

    function valid_email($address): bool
    {
        if (preg_match('/^[a-zA-Z0-9_.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/', $address)) {
            return true;
        } else {
            return false;
        }
    }

    if (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters long";
    }

    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        // Check if email is already in use
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $check_email_result = $conn->query($check_email_query);
        if ($check_email_result->num_rows > 0) {
            echo
            '<script>alert("Error: Email is already in use");
             window.location.href = "login.php";</script>';
        } else {
            // Check if username is already in use
            $check_username_query = "SELECT * FROM users WHERE username = '$name'";
            $check_username_result = $conn->query($check_username_query);
            if ($check_username_result->num_rows > 0) {
                echo
                '<script>alert("Error: Username is already in use");
                window.location.href = "login.php";</script>';
            } else {
                // Insert new user
                $sql = "INSERT INTO users (username, email, password, user_type) VALUES ('$name', '$email', '$hashed_password', '0')"; // user_type 0 = normal user, 1 = subscriber, 2 = admin
                if ($conn->query($sql) === TRUE) {
                    header("login.php");
                } else {
                    echo '<script>alert("Error: ' . $sql . ' ' . $conn->error . '");
                    window.location.href = "login.php";</script>';
                }
            }
        }
    }
}

function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

?>

<!--html-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--<base href="https://www.artisanhub.com/">-->
    <title>Sign-In | Artisan Hub</title>
    <meta name="description" content="Artisan Hub, JohnDoe's Art Web Store & Blog">
    <meta name="keywords" content="Artisan Hub,JohnDoe,Art,Art Commission,JohnDoe's Art,Commission JohnDoe,JohnDoe's Blog,Art Blog">
    <meta name="author" content="JohnDoe">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Your custom CSS file -->
    <link href="styles.css" rel="stylesheet">
    <link href="style-signUp.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="body">

    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light" style="border-bottom: 7px #154360 solid;">
        <div class="container">
            <!-- Logo and Brand -->
            <a class="navbar-brand" href="index.html">
                <img src="./images/logo.png" alt="Logo" width="50" height="35">
                <b><i>Artisan Hub</i></b>
            </a>
            <!-- Toggle Button (for small screens) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Artworks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="commission.php">Commission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subscription.php">Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <!-- Login/Logout Button -->
                <div class="d-flex py-1" style="padding-left: 2px;">
                    <?php echo $logButton; ?>
                </div>
                <div class="d-flex py-1" style="padding-left: 2px;">
                    <?php echo $subButton; ?>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <br>

    <section class="col-10" style="margin: auto; height:80vh; ">
        <div class="container-4 col-lg-9 p-4">
            <input type="checkbox" id="flip">
            <div class="cover">
                <div class="front"></div>
                <div class="back"></div>
            </div>

            <div class="forms">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">Login</div>
                        <form action="loginAction.php" method="POST">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <i class="fas fa-envelope"></i>
                                    <input type="text" placeholder="Enter your email" name="email" required>

                                </div>

                                <div class="input-box">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Enter your password" name="pass" required>

                                </div>

                                <div class="text"><a href="#">Forgot password?</a></div>

                                <div class="button input-box">
                                    <input type="submit" value="Submit">
                                </div>
                                <div class="text sign-up-text">Don't have an account? <label for="flip">Sign up now</label></div>
                            </div>
                        </form>
                    </div>
                    <div class="signup-form" id="signup">
                        <div class="title">Signup</div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Enter your name" required name="name" id="name">
                            </div>

                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Enter your email" required name="email" id="email">
                            </div>

                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your Password" required name="password" id="password">
                            </div>
                            <span id="password-length-msg" class="password-length-msg"></span>

                            <i style="color: orange; font-size:small;"><?php echo $passwordErr ?></span></i>

                            <div class="button input-box">
                                <input type="submit" name="submit" value="Submit">
                            </div>

                            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
    </section>





    <script>
        // Get the password input element
        const passwordInput = document.getElementById('password');

        // Get the password length message element
        const passwordLengthMsg = document.getElementById('password-length-msg');

        // Function to update the password length message
        function updatePasswordLengthMsg() {
            const password = passwordInput.value;
            if (password.length < 8) {
                passwordLengthMsg.textContent = 'Password must be at least 8 characters long';
                passwordLengthMsg.style.color = 'orange';
            } else {
                passwordLengthMsg.textContent = '';
            }
        }

        // Event listener for input events on the password field
        passwordInput.addEventListener('input', updatePasswordLengthMsg);
    </script>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

<?php include 'footer.php'; ?>

</html>
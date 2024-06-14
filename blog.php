<?php

require('conn.php');

session_start();

if (!isset($_SESSION['log_name'])) {
    header('location:login.php');
}


if ($_SESSION['log_type'] == "0") {
    $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>';
} elseif ($_SESSION['log_type'] == "1") {
    $subButton = '<a href="subscription.php#tip" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Tip</a>';
} elseif ($_SESSION['log_type'] == "2") {
    $subButton = '<a href="admin.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Admin Panel</a>';
} else {
    $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>'; // Handle unknown user type (testing)
}

$username = $_SESSION['log_name'];

$sql = "SELECT * FROM subs WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output subscription rows
    while ($row = $result->fetch_assoc()) {
        $end_date = $row['end_date'];
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--<base href="https://www.artisanhub.com/">-->
    <title>Artworks | Artisan Hub</title>
    <meta name="description" content="Artisan Hub, JohnDoe's Art Web Store & Blog">
    <meta name="keywords" content="Artisan Hub,JohnDoe,Art,Art Commission,JohnDoe's Art,Commission JohnDoe,JohnDoe's Blog,Art Blog">
    <meta name="author" content="JohnDoe">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Your custom CSS file -->
    <link href="styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
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
                        <a class="nav-link" href="#blog">Artworks</a>
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
                    <a class="btn btn-outline-light" style="background-color: #60ce80;" href="logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a>
                </div>
                <div class="d-flex py-1" style="padding-left: 2px;">
                    <?php echo $subButton; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Welcome msg -->
    <div class="container-fluid row justify-content-center mt-4">
        <div class="col-10">
            <div class="accordion accordion-flush" id="accordionWelcome">
                <div class="accordion-item mb-4 shadow-sm">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Welcome &nbsp : &nbsp <span style='text-transform: capitalize;'><?php echo $_SESSION['log_name'] ?></span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionWelcome">
                        <div class="accordion-body">
                            <span style='text-transform: capitalize;'>
                                <?php
                                if ($_SESSION['log_type'] == 0) {
                                    echo '<li>Some Posts are locked behind a paywall.</li>';
                                    echo '<li>Please Consider Subscribing to view them and for participating in special events.</li>';
                                }
                                if ($_SESSION['log_type'] == 1) {
                                    echo '<li>Your Subsription status ends in: ' . $end_date  . '</li>'; //add remaining time php
                                    echo '<li>Keep an eye out on your notifications for subsriber only special events.</li>';
                                }
                                if ($_SESSION['log_type'] == 2) {
                                    echo '<li>Goto Admin Panel to Create Posts.  </li>';
                                    echo '<li>Checkout Extras from Admin Panel to create events</li>';
                                    echo '<li>Check Billings in Paypal</li>';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (($_SESSION['log_type'] == "1" || $_SESSION['log_type'] == "2")) {
        echo
        '<div class="container col-lg-8">
        <!-- live search -->
        <input type="text" id="searchInput" class="form-control" placeholder="Search by title">
        <a class="float-end" href="blog.php"><i class="fa-solid fa-arrows-rotate"></i> Reload</a>        
    </div>';
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Listen for input in the search field
            $('#searchInput').on('input', function() {
                var query = $(this).val();
                // Make AJAX request to fetch filtered posts
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        // Update the posts container with the filtered posts
                        $('#posts').html(response);
                        <?php require('search.php'); ?>
                    }
                });
            });
        });
    </script>

    <!-- posts -->
    <section id='posts'>
        <?php require('blogQuery.php'); ?>
        <br>
    </section>

    <br>


    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
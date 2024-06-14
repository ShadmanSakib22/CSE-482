<?php

require('conn.php');

session_start();

require('cookie.php');

if (!isset($_SESSION['log_name'])) {
    header('location:login.php');
}

if ($_SESSION['log_type'] == "0") {
    $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>';
} elseif ($_SESSION['log_type'] == "1") {
    $subButton = '<a href="subExtras.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Extras</a>';
} elseif ($_SESSION['log_type'] == "2") {
    $subButton = '<a href="admin.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Admin Panel</a>';
} else {
    $subButton = '<a href="subscription.php" class="btn btn-outline-light" style = "background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Subscribe</a>'; // Handle unknown user type (testing)
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--<base href="https://www.artisanhub.com/">-->
    <title>Subscription| Artisan Hub</title>
    <meta name="description" content="Artisan Hub, JohnDoe's Art Web Store & Blog">
    <meta name="keywords" content="Artisan Hub,JohnDoe,Art,Art Commission,JohnDoe's Art,Commission JohnDoe,JohnDoe's Blog,Art Blog">
    <meta name="author" content="JohnDoe">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Your custom CSS file -->
    <link href="styles.css" rel="stylesheet">

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
                        <a class="nav-link" href="#plans">Plans</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tip">Tip</a>
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
    <br>


    <section id='plans'>
        <div class="container mt-5 container-3">
            <h2 class="heading4 fw-bold">Choose a Subscription Plan</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">30 Days Subscription</h5>
                            <p class="card-text">Cost: 1000 BDT</p>
                            <a href="checkout.php?price=1000" class="btn btn-reg">Subscribe</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">3 Months Subscription</h5>
                            <p class="card-text">Cost: 2500 BDT</p>
                            <a href="checkout.php?price=2500" class="btn btn-reg">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <section id="tip" class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-12 col-lg-6">
                    <h2 class="heading3" style="color:#154360;">Tip Artist</h2>
                    <div class="container-1">
                        <p class="lead mb-3 ">Send a Small Tip to JohnDoe to let her know of your appreciation!</p>

                        <div class="btn-group d-flex" role="group" aria-label="Tip Options">
                            <a href="checkout.php?price=50" class="btn btn-reg m-2">50 BDT</a>
                            <a href="checkout.php?price=100" class="btn btn-reg m-2">100 BDT</a>
                            <a href="checkout.php?price=200" class="btn btn-reg m-2">200 BDT</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row justify-content-xl-end">
                        <div class="col-12 col-xl-11">
                            <div class="accordion accordion-flush" id="accordionExample">
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Why Should I Susbscribe?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Reasons are as follows:</p>
                                            <ul>
                                                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                                                <li>Alias molestiae rem totam provident.</li>
                                                <li>omnis quos porro deserunt in quibusdam ex.</li>
                                                <li>Accusantium tenetur, expedita fuga obcaecati nobis cum necessitatibus eos laborum.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Which Subscription plan is good for me?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi officia minima aperiam earum. Nemo inventore eaque est et, adipisci cum quidem iusto esse repudiandae, aspernatur consectetur ratione dolorum, tempora iste.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            What is the payment process?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore atque aut et commodi, cum libero porro itaque repellat tempore! Harum maxime debitis repellat nulla provident rerum nam quasi ea asperiores.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            How Can I Contact Customer Support?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                                        <div class="accordion-body">
                                            You can contact our customer support team by email or phone. Our email
                                            address is artisanhub.info@gmail.com and our phone number is
                                            +880-2-55668200.
                                            We are
                                            available Monday to Friday, 9am to 5pm UTC.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item shadow-sm">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            What is our refund/cancel policy?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero commodi deleniti eos sint modi laboriosam animi ea omnis suscipit sed officiis, possimus, facere earum. Pariatur quisquam corrupti harum quo deleniti!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

    </section>



    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
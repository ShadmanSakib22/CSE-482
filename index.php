<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--<base href="https://www.artisanhub.com/">-->
    <title>Home | Artisan Hub</title>
    <meta name="description" content="Artisan Hub, JohnDoe's Art Web Store & Blog">
    <meta name="keywords" content="Artisan Hub,JohnDoe,Art,Art Commission,JohnDoe's Art,Commission JohnDoe,JohnDoe's Blog,Art Blog">
    <meta name="author" content="JohnDoe">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Your custom CSS file //styles.css?v=1-->
    <link href="styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .home {
            min-height: 70vh;
            background: url('./images/intro.png') no-repeat center/cover;
            box-shadow: 20px 0px 20px rgba(0, 0, 0, 0.5) inset;
        }
    </style>

</head>

<body class="body">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light" style="border-bottom: 7px #154360 solid;">
        <div class="container">
            <!-- Logo and Brand -->
            <a class="navbar-brand" href="index.php">
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
                        <a class="nav-link" href="#about">About</a>
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
                        <a class="nav-link" href="#community">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <!-- Login/Logout Button -->
                <div class="d-flex py-1" style="padding-left: 2px;">
                    <a class="btn btn-outline-light" style="background-color: #60ce80;" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Sign In</a>
                </div>
                <div class="d-flex py-1" style="padding-left: 2px;">
                    <a class="btn btn-outline-light" style="background-color: #154360;" href="subscription.php"><i class="fa-solid fa-user-plus"></i> Subscribe</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="container-fluid">

        <div class="row home">
            <div class="col-lg-12 container-fluid trans-container">
                <h4 style="color: aqua;">Explore, Create, and Connect: </h4>
                <h5 style="color: aqua; padding-bottom: 10px;">Welcome to Artisan Hub, Home of JohnDoe's Art!</h5>
                <p>Dive into a captivating collection of artwork by JohnDoe.</p>
                <p>Bring Your Vision to Life: Commission work to JohnDoe.</p>
                <p>Support the Artist's Journey: Show your love with tips or a subscription for exclusive access.
                </p>

                <p>
                <div class="col-lg-12" style="text-align: center;">
                    <a href="#gallery" class="btn btn-dark btn-outline-warning" style="margin: 2px 0;">Gallery</a>
                    <a href="subscription.php#tip" class="btn btn-dark btn-outline-warning" style="margin: 2px 0; padding-left: 20px; padding-right: 20px;">Tip</a>
                    <a href="subscription.php" class="btn btn-dark btn-outline-warning" style="margin: 2px 0;">Subscribe</a>
                    <a href="commission.php" class="btn btn-dark btn-outline-warning" style="margin: 2px 0;">Commission</a>
                </div>
                </p>
                <br>
            </div>
        </div>

    </section>

    <section id="about" class="about">
        <br>
        <h2 class="heading2 col-lg-8">
            <b>ABOUT</b>
        </h2>
        <div class="row col-lg-8 container-1">
            <h4 style="padding-bottom: 2%;"><b>Artisan Hub: John Doe's Official Art Space</b></h4>
            <div class="col-sm-3" style="padding-bottom:2%;">
                <img src="./images/person.jpg" alt="JohnDoe - Artist" class="img-thumbnail rounded float-left" style="min-height: 15vh;" loading="lazy">
            </div>
            <div class="col-sm-8">
                <p><b>JohnDoe</b> is an accomplished artist from Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Her passion for art is evident in every brushstroke, capturing the essence
                    of
                    [artistic style or themes]. JohnDoe strives to [artistic
                    goals or inspiration].</p>
                <p>JohnDoe Received the following Art awards:
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. </li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. </li>
                </p>
            </div>
            <ul style="list-style-type: decimal; padding-top:2%">
                <li><b>Explore the Gallery:</b>
                    <p>Take a look around the "Gallery" & "Artworks Blog" to get a feel for John Doe's artistic
                        flair and inspirations.</p>
                </li>
                <li><b>Unlock Exclusive Content:</b>
                    <p>For a deeper dive into John Doe's creative process, consider subscribing to this blog.
                        <br>
                        A subscription grants you access to "Early Access Works," a collection of exclusive
                        pieces not available to the public. <br>
                        To learn more about the benefits of subscribing, visit the Subscription Page.
                    </p>
                </li>
                <li><b>Stay Up-to-Date with New Art:</b>
                    <p>John Doe consistently uploads new "Major Artworks" to this blog on a monthly basis. Stay
                        tuned to see his latest creations!</p>
                </li>
                <li><b>Commissioning John Doe's Work:</b>
                    <p>Interested in commissioning a unique piece from John Doe? Then head on over to the Commission
                        Page! <br>
                        The FAQ section on commission page explains most of the Process.
                        Commissions are typically responded to within a week, and payment is handled
                        conveniently through email after John Doe confirms your request.</p>
                </li>
            </ul>
            <i style="text-align:right"><b>We hope you enjoy exploring Artisan Hub!</b></i>
        </div>
        <br>
    </section>

    <section id="gallery" class="gallery">
        <br>
        <div id="car" class="carousel slide col-9 container-2" data-bs-ride="carousel">
            <h2 class="container bg-light text-dark col-12 p-2" style="border-radius:1em;">
                <b>Gallery:</b>
            </h2>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="cards-wrapper">
                        <div class="card-1 img-thumbnail">
                            <img src="./images/1.png" alt="..." loading="lazy">
                            <h5 class="card-title">Title 1</h5>
                        </div>
                        <div class="card-1 img-thumbnail d-none d-sm-block">
                            <img src="./images/2.png" class="card-img-top" alt="..." loading="lazy">
                            <h5 class="card-title">Title 2</h5>
                        </div>
                        <div class="card-1 img-thumbnail d-none d-md-block">
                            <img src="./images/3.png" class="card-img-top" alt="..." loading="lazy">
                            <h5 class="card-title">Title 3</h5>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card-1 img-thumbnail">
                            <img src="./images/4.png" class="card-img-top" alt="..." loading="lazy">
                            <h5 class="card-title">Title 4</h5>
                        </div>
                        <div class="card-1 img-thumbnail d-none d-sm-block">
                            <img src="./images/5.png" class="card-img-top" alt="..." loading="lazy">
                            <h5 class="card-title">Title 5</h5>
                        </div>
                        <div class="card-1 img-thumbnail d-none d-md-block">
                            <img src="./images/6.jpeg" class="card-img-top" alt="..." loading="lazy">
                            <h5 class="card-title">Title 6</h5>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#car" data-bs-slide="prev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#car" data-bs-slide="next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <br>
            <a style="font-size:small;" class="btn btn-outline-light" href="blog.php">Click here to View More..</a>
        </div>
        <br>
    </section>


    <section id="community" style="border-top: 0.25em solid #154360;">
        <br><br>
        <div class="container">
            <div class="col-lg-8 container-3">
                <h2 class="heading4">Community</h2>
                <ul style="padding-top: 0.5em;">
                    <li>Get involved with what JohnDoe is upto by following her socials.</li>
                    <li>JohnDoe is higly present on discord and hosts several events there.</li>
                    <li>Our Discord Community is growing everyday thanks to the collective presence of our patrons.</li>
                </ul>
                <ul>To join in on the fun click on the button below, it's completely free!</ul>
                <a href="#" class="btn btn-outline-light float-end" target="_blank" style="background-color: #154360; box-shadow: 0px 3px 10px 0px rgb(27, 26, 26);">Join
                    Discord</a>
            </div>
        </div>
        <br><br>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- Your custom JS file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>
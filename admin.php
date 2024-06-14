<?php

require_once('conn.php');

session_start();

if (!isset($_SESSION['log_name'])) {
    header('location:login.php');
}

if ($_SESSION['log_type'] != 2) {
    header('location:login.php');
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $access = $conn->real_escape_string($_POST['access']);

    // File upload handling
    $targetDir = "uploads/"; // Directory where uploaded images will be saved
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.')</script>";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) { // 5MB
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.')</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }

    // Insert data into database
    $sql = "INSERT INTO posts (title, description, access, image_url) VALUES ('$title', '$description', '$access', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully')</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "')</script>";
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
    <title>Admin | Artisan Hub</title>
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
                        <a class="nav-link" href="#createPost">Upload-Work</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#control">Control-Panel</a>
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
                    <a href="comRequests.php" class="btn btn-outline-light" style="background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Commissions</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="heading5 m-4">
        <b>Welcome - <span><?php echo $_SESSION['log_name'] ?></span></b>
    </div>

    <section id="createPost">
        <br>
        <div class="container-3 col-lg-10">
            <div class="card" style="border-width: 0px;">
                <div class="card-body">
                    <h2 class="card-title">Create Post</h2>
                    <form action="admin.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Title</label>
                            <input type="text" class="form-control" id="nameInput" name="title" placeholder="Enter Artwork Title">
                        </div>
                        <div class="mb-3">
                            <label for="descriptionInput" class="form-label">Description of Artwork</label>
                            <textarea class="form-control" id="descriptionInput" name="description" rows="3" placeholder="Describe your artwork"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="accessInput" class="form-label">Access</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="access" id="Exclusive" value="exclusive">
                                <label class="form-check-label" for="Exclusive">
                                    Exclusive
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="access" id="Public" value="public">
                                <label class="form-check-label" for="Public">
                                    Public
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="imageInput">Upload Image (png, jpg, jpeg, max size: 5MB)</label>
                            <input type="file" class="form-control" id="imageInput" name="image" accept="image/png, image/jpg, image/jpeg" onchange="previewImage()">
                        </div>

                        <div class="mb-3">
                            <label for="imagePreview" class="mb-2">Image Preview:</label>
                            <div id="imagePreview"></div>
                        </div>
                        <button type="submit" class="btn btn-reg">Submit</button>
                    </form>

                    <script>
                        function previewImage() {
                            var preview = document.querySelector('#imagePreview');
                            var file = document.querySelector('#imageInput').files[0];
                            var reader = new FileReader();

                            reader.onloadend = function() {
                                var img = document.createElement('img');
                                img.src = reader.result;
                                img.style.maxWidth = '100%';
                                preview.innerHTML = '';
                                preview.appendChild(img);
                            }

                            if (file) {
                                reader.readAsDataURL(file);
                            } else {
                                preview.innerHTML = 'Image preview will be shown here once you select an image.';
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
        <br>
    </section>
    <br>

    <section id="subscriptions">
        <div class="container-3 col-lg-10">
            <div class="card" style="border-width: 0px;">
                <div class="card-body">
                    <h2 class="card-title">Subscribed Users:</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">End Date</th>
                            </tr>
                        </thead>
                        <tbody id="tbodySub">
                            <!-- Subscription rows will be dynamically added here -->
                        </tbody>
                    </table>
                    <button id="loadMoreSubBtn" class="btn btn-reg">Load More</button>
                    <button id="updateSubBtn" class="btn btn-reg">Update Subs</button>
                </div>
            </div>
        </div>
        <br><br>
    </section>

    <section>
        <div class="container-3 col-lg-10">
            <div class="card" style="border-width: 0px;">
                <div class="card-body">
                    <h2 class="card-title">Tips:</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Tip</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyTip">
                            <!-- Tip rows will be dynamically added here -->
                        </tbody>
                    </table>
                    <button id="loadMoreTipBtn" class="btn btn-reg">Load More</button>
                </div>
            </div>
        </div>
        <br><br>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Define the number of rows to load per page
            var rowsPerPage = 10;
            // Initialize page number
            var currentPage = 1;

            // Function to fetch and display subscription data
            function fetchSubscriptions(currentPage) {
                $.ajax({
                    url: 'subStatus.php',
                    method: 'GET',
                    data: {
                        currentPage: currentPage,
                        rowsPerPage: rowsPerPage
                    },
                    success: function(response) {
                        // Append fetched subscription data to the table body
                        $('#tbodySub').append(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Load more button click event handler
            $('#loadMoreSubBtn').click(function() {
                currentPage++;
                fetchSubscriptions(currentPage);
            });

            // Initially fetch and display subscriptions for the first page
            fetchSubscriptions(currentPage);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#updateSubBtn').click(function() {
                $.ajax({
                    url: 'updateSubs.php',
                    method: 'POST',
                    success: function(response) {
                        alert(response);
                        window.location.href = "admin.php";

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Define the number of rows to load per page
            var rowsPerPage = 10;
            // Initialize page number
            var currentPage = 1;

            // Function to fetch and display subscription data
            function fetchTips(currentPage) {
                $.ajax({
                    url: 'tipStatus.php',
                    method: 'GET',
                    data: {
                        currentPage: currentPage,
                        rowsPerPage: rowsPerPage
                    },
                    success: function(response) {
                        // Append fetched subscription data to the table body
                        $('#tbodyTip').append(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Load more button click event handler
            $('#loadMoreTipBtn').click(function() {
                currentPage++;
                fetchTips(currentPage);
            });

            // Initially fetch and display subscriptions for the first page
            fetchTips(currentPage);
        });
    </script>



    <section id="control">
        <br>
        <div class="container-3 col-lg-10">
            <div class="card" style="border-width: 0px;">
                <div class="card-body">
                    <h2 class="card-title">Control Panel</h2>

                    <form action="deleteUser.php" method="post">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Username</label>
                            <input type="text" class="form-control" id="nameInput" name="username" placeholder="Enter Username">
                        </div>
                        <button type="submit" class="btn btn-reg">Delete User</button>
                    </form>
                    <br>
                    <form action="deletePost.php" method="post">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Post Title</label>
                            <input type="text" class="form-control" id="titleInput" name="title" placeholder="Enter Post Title">
                            <label for="nameInput" class="form-label">Upload Time</label>
                            <input type="text" class="form-control" id="timeInput" name="time" placeholder="Enter Post Upload Time">
                        </div>
                        <button type="submit" class="btn btn-reg">Delete Post</button>
                    </form>
                    <br>
                    <form action="notifyUsers.php" method="post">
                        <div class="mb-3">
                            <label for="notifInput" class="form-label">Notification</label>
                            <input type="text" class="form-control" id="notifInput" name="notification" placeholder="Enter Notification" required>
                        </div>
                        <button type="submit" class="btn btn-reg">Notify</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </section>

    <footer id="contact" style="background-color: #154360; padding-top:2em; color:white; border-top: 10px double white;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h5 class="regular">Artisan Hub</h5>
                    <p>JohnDoe's Art Web Store & Blog</p>
                    <h5 class="regular">Contact:</h5>
                    <i class="fa fa-phone"></i> +880-2-55668200<br>
                    <i class="fa fa-envelope"></i> artisanhub.info@gmail.com
                    </p>
                </div>

                <hr class="clearfix w-100 d-md-none" />

                <div class="col-md-3">
                    <div class="social-box">
                        <h5 class="regular">Follow Us:</h5>
                        <ul class="social-list">
                            <li>
                                <a href="https://www.facebook.com/artisanhub" class="btn btn-default social-icon text-white" target="_blank">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/artisanhub" class="btn btn-default social-icon text-white" target="_blank">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/118022124355407741002" class="btn btn-default social-icon text-white" target="_blank">
                                    <i class="fab fa-google-plus"></i> Google+
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/artisanhub" class="btn btn-default social-icon text-white" target="_blank">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="clearfix w-100 d-md-none" />

                <div class="col-md-4">
                    <h5 class="regular">Newsletter</h5>
                    <p>To Stay Up-to-Date. Submit Your Email</p>
                    <div class="form-group">
                        <input type="text" class="form-control m-1" placeholder="Email Address">
                        <input type="submit" class="btn btn-outline-light m-1 float-end" value="Submit">
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright -->
        <div style="text-align: center; background-color: rgba(0, 0, 0, 0.2)" class="container-fluid mt-1"> &copy 2024
            Artisan
            Hub. All rights
            reserved.</div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
<?php

require_once('conn.php');

session_start();

if (!isset($_SESSION['log_name'])) {
    header('location:login.php');
}

if ($_SESSION['log_type'] != 2) {
    header('location:login.php');
}

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST["ID"];

    if (!empty($ID)) {
        $sql = "DELETE FROM commission WHERE id = $ID";

        if ($conn->query($sql) === TRUE) {
            echo
            '<script>alert("Commission Record Deleted from DB");
             window.location.href = "comRequests.php";</script>';
        } else {
            echo
            '<script>alert("Error in Deleting Record");
             window.location.href = "comRequests.php";</script>';
        }
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
    <title>Comission Req | Artisan Hub</title>
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

<body>
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
                        <a class="nav-link" href="index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Artworks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#req">Commission-Req</a>
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
                    <a href="admin.php" class="btn btn-outline-light" style="background-color:#154360;"><i class="fa-solid fa-user-plus"></i> Admin Panel</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="heading5 m-4">
        <b>Welcome - <span><?php echo $_SESSION['log_name'] ?></span></b>
    </div>

    <section id='commission-req'>
        <div class="container-3 col-lg-10">
            <div class="card" style="border-width: 0px;">
                <div class="card-body">
                    <h2 class="card-title">Commission Requests:</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">Verified</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyCom">
                            <!-- Subscription rows will be dynamically added here -->
                        </tbody>
                    </table>
                    <button id="loadMoreComBtn" class="btn btn-reg">Load More</button>
                </div>
            </div>
        </div>
        <br><br>
    </section>

    <section id="control">
        <br>
        <div class="container-3 col-lg-10">
            <div class="card" style="border-width: 0px;">
                <div class="card-body">
                    <h2 class="card-title">Control Panel</h2>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="comID" class="form-label">ID</label>
                            <input type="text" class="form-control" id="ID" name="ID" placeholder="Enter Commission ID" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-reg" value="Delete Req">
                    </form>
                </div>
            </div>
        </div>
        <br>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Define the number of rows to load per page
            var rowsPerPage = 3;
            // Initialize page number
            var currentPage = 1;

            // Function to fetch and display subscription data
            function fetchCom(currentPage) {
                $.ajax({
                    url: 'comStatus.php',
                    method: 'GET',
                    data: {
                        currentPage: currentPage,
                        rowsPerPage: rowsPerPage
                    },
                    success: function(response) {
                        // Append fetched subscription data to the table body
                        $('#tbodyCom').append(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Load more button click event handler
            $('#loadMoreComBtn').click(function() {
                currentPage++;
                fetchCom(currentPage);
            });

            // Initially fetch and display subscriptions for the first page
            fetchCom(currentPage);
        });
    </script>


    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

<?php include 'footer.php'; ?>

</html>
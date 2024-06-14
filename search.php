<?php

require('conn.php');


if (isset($_POST['query'])) {
    $search = $_POST['query'];
    $sql = "SELECT * FROM posts WHERE title LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container col-lg-8 mt-4">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo "<h2 class='heading4'>" . 'Title: ' . htmlspecialchars($row["title"]) . "</h2>";
            echo "<p class='text-muted'>Upload Time: " . $row["upload_time"] . "</p>";
            echo "<p class='lead'>" . nl2br(htmlspecialchars($row["description"])) . "</p>";
            echo "<hr class='clearfix w-100'>";
            echo "<img src='" . htmlspecialchars($row["image_url"]) . "' class='img-thumbnail imgPost'  alt='Image'>";
            echo "<br>";
            echo "<a href='" . htmlspecialchars($row["image_url"]) . "' target='_blank' class='btn btn-outline-dark m-2'>Full Image</a>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='container' style='text-align: center; border: 2px solid white;'>";
        echo "<a> 0 results </a>";
        echo "</div>";
    }
}

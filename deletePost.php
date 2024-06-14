<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the title and time are provided
    if (isset($_POST["title"]) && isset($_POST["time"])) {
        // Get the title and time from the form
        $title = $_POST["title"];
        $time = $_POST["time"];

        // Include the database connection
        require('conn.php');

        // SQL to delete a post with the provided title and upload time
        $sql = "DELETE FROM posts WHERE title = '$title' AND upload_time = '$time'";

        // Execute the delete query
        if ($conn->query($sql) === TRUE) {
            echo "Post '$title' uploaded at '$time' deleted successfully";
            echo "<a href='admin.php'>\nReturn</a>";
        } else {
            echo "Error deleting post: " . $conn->error;
            echo "<a href='admin.php'>\nReturn</a>";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Post title or upload time is not provided";
        echo "<a href='admin.php'>\nReturn</a>";
    }
} else {
    // Redirect users if they try to access this script directly without submitting the form
    header("Location: admin.php");
    exit();
}

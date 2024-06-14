<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username is provided
    if (isset($_POST["username"])) {
        // Get the username from the form
        $username = $_POST["username"];

        // Include the database connection
        require('conn.php');

        // SQL to delete a user with the provided username
        $sql = "DELETE FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        $sql2 = "SELECT * FROM users WHERE username = '$username'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            echo "Error deleting user: " . $conn->error;
            echo "<br>";
            echo "<a href='admin.php'>Return</a>";
        }

        if ($result2->num_rows == 0) {
            echo "Action Completed <br>";
            echo "<a href='admin.php'>Return</a>";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Username is not provided";
        echo "<a href='admin.php'>\nReturn</a>";
    }
} else {
    // Redirect users if they try to access this script directly without submitting the form
    header("Location: admin.php");
    exit();
}

<?php
// Include the database connection
require_once('conn.php');

session_start();

// Check if the user is logged in and has the correct user type
if (!isset($_SESSION['log_name']) || $_SESSION['log_type'] != 2) {
    header('location:login.php');
    exit;
}

// Get the current date
$currentDate = date('Y-m-d');

// SQL to select all subscriptions where end_date is less than the current date
$sql = "SELECT username FROM subs WHERE end_date < '$currentDate'";
$result = $conn->query($sql);

// Check if there are any expired subscriptions
if ($result->num_rows > 0) {
    // Process each expired subscription
    while ($row = $result->fetch_assoc()) {
        $username = $row['username'];

        // Update user_type to 0 in users table
        $updateUserTypeSql = "UPDATE users SET user_type = 0 WHERE username = '$username'";
        if ($conn->query($updateUserTypeSql) !== TRUE) {
            echo "Error updating user_type for $username: " . $conn->error . "";
        }

        // Remove the entry from subs table
        $deleteSubSql = "DELETE FROM subs WHERE username = '$username'";
        if ($conn->query($deleteSubSql) !== TRUE) {
            echo "Error deleting subscription for $username: " . $conn->error . "";
        }
    }
    echo "Subscription updates completed successfully";
} else {
    echo "No subscriptions to update";
}

// Close the database connection
$conn->close();

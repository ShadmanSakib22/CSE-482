<?php
require('conn.php');

// Get page number and rows per page from the AJAX request
$page = $_GET['currentPage'];
$rowsPerPage = $_GET['rowsPerPage'];
$offset = ($page - 1) * $rowsPerPage;

// SQL query to select subscriptions for the current page
$sql = "SELECT * FROM subs LIMIT $offset, $rowsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output subscription rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['end_date'] . "</td>";
        echo "</tr>";
    }
} else {
    // No more subscription data
    echo "<tr><td colspan='2'>No more subscriptions found.</td></tr>";
}

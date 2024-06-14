<?php
require('conn.php');

// Get page number and rows per page from the AJAX request
$page = $_GET['currentPage'];
$rowsPerPage = $_GET['rowsPerPage'];
$offset = ($page - 1) * $rowsPerPage;

// SQL query to select subscriptions for the current page
$sql = "SELECT * FROM commission LIMIT $offset, $rowsPerPage"; //where verified='1'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output subscription rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['submission_date'] . "</td>";
        echo "<td>" . $row['verified'] . "</td>";
        echo "</tr>";
    }
} else {
    // No more data
    echo "<tr><td colspan='5'>No more commissions found.</td></tr>";
}

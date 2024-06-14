<?php
require('conn.php');

// Get page number and rows per page from the AJAX request
$page = $_GET['currentPage'];
$rowsPerPage = $_GET['rowsPerPage'];
$offset = ($page - 1) * $rowsPerPage;

// SQL query to select tips for the current page
$sql = "SELECT * FROM tips LIMIT $offset, $rowsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output tip rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['tip'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
} else {
    // No more tip data
    echo "<tr><td colspan='3'>No more tips found.</td></tr>";
}

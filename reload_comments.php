<?php
// Include the script to establish a database connection
require('conn.php');

// Check if post_id parameter is set in the GET request
if (isset($_GET['post_id'])) {
    // Retrieve the post ID from the GET request
    $postId = $_GET['post_id'];

    // Query the database to fetch comments for the specified post ID
    $sql_comments = "SELECT * FROM comments WHERE post_id = $postId ORDER BY id DESC LIMIT 6";

    $result_comments = $conn->query($sql_comments);

    // Check if there are comments
    if ($result_comments->num_rows >= 0) {
        // Start generating HTML markup for comments
        $commentsHTML = "<h3>Comments:</h3> 
        <button class='mb-2' onclick='reloadComments($postId)'> <i class='fa-solid fa-arrows-rotate'></i> </button>
        <button class='mb-2' onclick='loadMoreComments($postId)'> Load More </button>";
        while ($comment_row = $result_comments->fetch_assoc()) {
            // Extract comment details
            $comment_username = htmlspecialchars($comment_row["username"]);
            $comment_text = htmlspecialchars($comment_row["comment"]);
            $comment_time = htmlspecialchars($comment_row["created_at"]);
            // Append comment HTML to the variable
            $commentsHTML .= "<p style='background-color: #f0f0f0; padding:2px;'><i>$comment_time</i> <br><b>$comment_username: </b> $comment_text</p>";
        }
        // Output the generated HTML
        echo $commentsHTML;
    } else {
        // Output a message if there are no comments
        echo "<p>No comments yet.</p>";
    }
} else {
    // Output an error message if post_id parameter is not set
    echo "Error: post_id parameter not specified.";
}

// Close the database connection
$conn->close();

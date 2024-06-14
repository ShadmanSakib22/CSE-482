<?php
// submit_comment.php

require('conn.php');

// Check if the comment form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the comment text and post ID from the form
    $comment = $_POST['comment'];
    $postId = $_POST['post_id'];
    $username = $_POST['username'];

    // Check if the comment already exists for this post and username
    $sql_check = "SELECT * FROM comments WHERE post_id = $postId AND username = '$username' AND comment = '$comment'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows == 0) {
        // Insert comment into the database
        $sql_comments = "INSERT INTO comments (post_id, username, comment) VALUES ('$postId', '$username', '$comment')";
        $result_comments = $conn->query($sql_comments);

        // Retrieve and display comments for the specific post
        $sql_get_comments = "SELECT * FROM comments WHERE post_id = $postId ORDER BY id DESC LIMIT 6";

        $result_get_comments = $conn->query($sql_get_comments);

        if ($result_get_comments->num_rows >= 0) {
            echo "<h3>Comments:</h3>" .
                "<button onclick='reloadComments($postId)' class='mb-2'> <i class='fa-solid fa-arrows-rotate'></i> </button>" .  //reload comment
                "<button class='mb-2' onclick='loadMoreComments($postId)'> Load More </button>"; //load more

            // Output data of each comment
            while ($comment_row = $result_get_comments->fetch_assoc()) {
                $comment_username = htmlspecialchars($comment_row["username"]);
                $comment_text = htmlspecialchars($comment_row["comment"]);
                $comment_time = htmlspecialchars($comment_row["created_at"]);
                echo "<p style='background-color: #f0f0f0; padding:2px;'><i>$comment_time</i> <br>
                        <b>$comment_username: </b> $comment_text</p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }
    }
}

// Close connection
$conn->close();

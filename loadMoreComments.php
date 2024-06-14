<?php
require('conn.php');

if (isset($_GET['post_id']) && isset($_GET['offset'])) {
    $postId = intval($_GET['post_id']);
    $offset = intval($_GET['offset']);

    $sql_comments = "SELECT * FROM comments WHERE post_id = $postId ORDER BY id DESC LIMIT 6 OFFSET $offset";
    $result_comments = $conn->query($sql_comments);

    if ($result_comments->num_rows > 0) {
        while ($comment_row = $result_comments->fetch_assoc()) {
            $comment_username = htmlspecialchars($comment_row["username"]);
            $comment_text = htmlspecialchars($comment_row["comment"]);
            $comment_time = htmlspecialchars($comment_row["created_at"]);
            echo "<p style='background-color: #f0f0f0; padding:2px;'><i>$comment_time</i> <br>
                <b>$comment_username: </b> $comment_text</p>";
        }
    }
}

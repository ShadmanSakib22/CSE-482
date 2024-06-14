<?php
// php for Displaying post

require('conn.php');

// Fetch posts data from the database
if ($_SESSION['log_type'] == "0") {
    $sql = "SELECT * FROM posts WHERE access = 'public' ORDER BY id DESC";
} elseif ($_SESSION['log_type'] == "1" || $_SESSION['log_type'] == "2") {
    $sql = "SELECT * FROM posts ORDER BY id DESC";
}

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
        // Button to toggle comments (passing the post id as a data attribute)
        echo "<button class='btn btn-outline-dark m-2 toggle-comments' data-post-id='" . $row["id"] . "'>Show Comments</button>";

        // Comment section (hidden by default)
        echo "<div class='comments mt-4' style='display: none;' id='comments-" . $row["id"] . "'>";

        $postId = $row['id'];

        $sql_comments = "SELECT * FROM comments WHERE post_id = $postId ORDER BY id DESC LIMIT 6";

        $result_comments = $conn->query($sql_comments);

        // Display comments
        if ($result_comments->num_rows >= 0) {
            echo "<h3>Comments:</h3>" .
                "<button onclick='reloadComments($postId)' class='mb-2'> <i class='fa-solid fa-arrows-rotate'></i> </button>" .  //reload comment
                "<button class='mb-2' onclick='loadMoreComments($postId)' id='loadMoreComments'> Load More </button>"; //load more
            while ($comment_row = $result_comments->fetch_assoc()) {
                $comment_username = htmlspecialchars($comment_row["username"]);
                $comment_text = htmlspecialchars($comment_row["comment"]);
                $comment_time = htmlspecialchars($comment_row["created_at"]);
                echo "<p style='background-color: #f0f0f0; padding:2px;'><i>$comment_time</i> <br>
                        <b>$comment_username: </b> $comment_text</p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }

        echo "</div>"; // Close comments Display


        // Comment form
        echo "<div class='comment-form mt-4' style='display: none;'>";
        echo "<form class='comment-form-ajax' data-post-id='" . $row["id"] . "'>"; // Unique data attribute for each form
        echo "<input type='hidden' name='post_id' value='" . $row["id"] . "'>"; // Hidden input field to pass post ID
        echo "<input type='hidden' name='username' value='" . $_SESSION['log_name'] . "'>"; // Hidden input field username
        echo "<div class='form-group'>";
        echo "<label for='comment'>Comment:</label>";
        echo "<textarea class='form-control' id='comment' name='comment' rows='1'></textarea>";
        echo "<button type='submit' class='btn btn-outline-dark mt-2'>Submit</button>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

?>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- comments -->
<script>
    $(document).ready(function() {
        $(".toggle-comments").click(function() {
            // Get the post id associated with the clicked button
            var postId = $(this).data("post-id");

            // Toggle the comments section for the specific post
            $("#comments-" + postId).toggle();

            // Toggle the button text based on current visibility state
            if ($("#comments-" + postId).is(":visible")) {
                $(this).html("Hide Comments");
            } else {
                $(this).html("Show Comments");
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Listen for form submissions
        $('.comment-form-ajax').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();

            // Get post ID from data attribute
            var postId = $(this).data('post-id');



            // Send AJAX request to submit the comment
            $.ajax({
                type: 'POST',
                url: 'submit_comment.php',
                data: formData,
                success: function(response) {
                    // Update the comments section for the corresponding post
                    $('#comments-' + postId).html(response);
                    $('#comment').val(''); // clear form textarea --not working
                }
            });
        });
    });
</script>

<script>
    function reloadComments(postId) {
        // Send AJAX request to reload comments
        $.ajax({
            type: 'GET',
            url: 'reload_comments.php', // generate the file
            data: {
                post_id: postId
            },
            success: function(response) {
                // Update the comments section for the corresponding post
                $('#comments-' + postId).html(response);
            }
        });
    }
</script>

<script>
    var offset = 6; // New variable to track offset

    function loadMoreComments(postId) {
        $.ajax({
            type: 'GET',
            url: 'loadMoreComments.php',
            data: {
                post_id: postId,
                offset: offset,
            },
            success: function(response) {
                if (response) {
                    $('#comments-' + postId).append(response);
                    offset += 6; // Update offset after successful load
                } else {
                    $('#loadMoreComments').remove(); // Remove button if no more comments
                }
            }
        });
    }
</script>
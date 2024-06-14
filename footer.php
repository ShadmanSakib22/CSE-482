<!-- footer.php -->
<footer id="contact" style="background-color: #154360; padding-top:2em; color:white; border-top: 10px double white;">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h5 class="regular">Artisan Hub</h5>
                <p>JohnDoe's Art Web Store & Blog</p>
                <h5 class="regular">Contact:</h5>
                <i class="fa fa-phone"></i> +880-2-55668200<br>
                <i class="fa fa-envelope"></i> artisanhub.info@gmail.com
                </p>
            </div>

            <hr class="clearfix w-100 d-md-none" />

            <div class="col-md-3">
                <div class="social-box">
                    <h5 class="regular">Follow Us:</h5>
                    <ul class="social-list">
                        <li>
                            <a href="https://www.facebook.com/artisanhub" class="btn btn-default social-icon text-white" target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/artisanhub" class="btn btn-default social-icon text-white" target="_blank">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/118022124355407741002" class="btn btn-default social-icon text-white" target="_blank">
                                <i class="fab fa-google-plus"></i> Google+
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/artisanhub" class="btn btn-default social-icon text-white" target="_blank">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="clearfix w-100 d-md-none" />

            <div class="col-md-4">
                <h5 class="regular">Newsletter</h5>
                <p>To Stay Up-to-Date. Submit Your Email</p>
                <form id="notifyForm" method="POST" action="notify.php">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control m-1" placeholder="Email Address" required>
                        <input type="submit" class="btn btn-outline-light m-1 float-end" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- copyright -->
    <div style="text-align: center; background-color: rgba(0, 0, 0, 0.2)" class="container-fluid mt-1"> &copy 2024
        Artisan Hub. All rights reserved.
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#notifyForm").submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                type: "POST",
                url: "notify.php",
                data: formData,
                success: function(response) {
                    // Handle success response
                    alert("Notification successful: " + response);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert("Notification failed: " + xhr.responseText);
                }
            });
        });
    });
</script>
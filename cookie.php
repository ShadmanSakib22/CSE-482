<?php

setcookie(
  $value = "session_id()",
  "expires=" . (time() + 86400 * 2) . "; path=/; secure; httponly; samesite=None"
);

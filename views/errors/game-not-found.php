<?php

$error_title = "Game Not Found";

$error_message = "The requested game does not exist or may have been removed.";

$error_icon = "bi-controller";

$error_code = "404";

$retry_url = $_SERVER['REQUEST_URI'];

include 'error-layout.php';
?>
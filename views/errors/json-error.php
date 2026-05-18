<?php

$error_title = "Corrupted Game Data";

$error_message = "Game data could not be processed.";

$error_icon = "bi-database-x";

$error_code = "422";

$retry_url = $_SERVER['REQUEST_URI'];

include 'error-layout.php';
?>
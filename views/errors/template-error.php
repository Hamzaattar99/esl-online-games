<?php

$error_title = "Template Missing";

$error_message = "The game template could not be loaded.";

$error_icon = "bi-file-earmark-x";

$error_code = "500";

$retry_url = $_SERVER['REQUEST_URI'];

include 'error-layout.php';
?>
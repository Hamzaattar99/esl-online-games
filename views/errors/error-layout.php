<?php
if (!isset($error_title)) {
    $error_title = "System Error";
}

if (!isset($error_message)) {
    $error_message = "Something went wrong.";
}

if (!isset($error_icon)) {
    $error_icon = "bi-exclamation-octagon";
}

if (!isset($error_code)) {
    $error_code = "500";
}

if (!isset($retry_url)) {
    $retry_url = "javascript:history.back()";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $error_title ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">

    <!-- Error Style -->
    <link rel="stylesheet" href="assets/css/error.css?v=<?= time() ?>">

</head>

<body>

<!-- Animated Background -->
<div class="bg-animation">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<div class="error-wrapper">

    <div class="error-card fade-error">

        <!-- Error Code -->
        <div class="error-code">
            <?= $error_code ?>
        </div>

        <!-- Icon -->
        <div class="error-icon">
            <i class="bi <?= $error_icon ?>"></i>
        </div>

        <!-- Title -->
        <h1 class="error-title">
            <?= $error_title ?>
        </h1>

        <!-- Message -->
        <p class="error-message">
            <?= $error_message ?>
        </p>

        <!-- Buttons -->
        <div class="error-actions">

            <a href="<?= $retry_url ?>" class="btn btn-primary retry-btn">
                <i class="bi bi-arrow-clockwise"></i>
                Retry
            </a>

            <a href="index.php" class="btn btn-outline-light home-btn">
                <i class="bi bi-house-door"></i>
                Home
            </a>

        </div>

    </div>

</div>

<script src="assets/js/error.js?v=<?= time() ?>"></script>

</body>
</html>
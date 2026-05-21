<?php

include 'config/db.php';

$result = json_decode($_POST['result'], true);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Game Result</title>

<link rel="stylesheet"
href="assets/css/style.css?v=<?= time() ?>">

<link rel="stylesheet"
href="assets/css/result.css?v=<?= time() ?>">

</head>

<body>

<div class="result-wrapper">

    <div class="result-card fade-in">

        <div class="score-circle">

            <?= $result['score'] ?>

        </div>

        <h1>Game Complete</h1>

        <div class="result-stats">

            <div class="stat-item">
                <h3><?= $result['correct'] ?></h3>
                <p>Correct</p>
            </div>

            <div class="stat-item">
                <h3><?= $result['wrong'] ?></h3>
                <p>Wrong</p>
            </div>

            <div class="stat-item">
                <h3><?= $result['time_taken'] ?>s</h3>
                <p>Time</p>
            </div>

        </div>

        <a href="index.php"
        class="back-home-btn">

            Back Home

        </a>

    </div>

</div>

</body>
</html>
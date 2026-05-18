<?php
$result = json_decode($_POST['result'], true);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="result-box">

    <h2>Game Result</h2>

    <p>Score: <?= $result['score'] ?></p>
    <p>Correct: <?= $result['correct'] ?></p>
    <p>Wrong: <?= $result['wrong'] ?></p>

    <a href="index.php">Back</a>

</div>

</body>
</html>
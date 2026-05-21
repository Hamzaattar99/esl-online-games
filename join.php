<?php

include 'config/db.php';
include 'includes/helpers.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $code = trim($_POST['game_code']);

    $stmt = $conn->prepare("
    SELECT content_id
    FROM content
    WHERE game_code=?
    AND is_published=1
    LIMIT 1
    ");

    $stmt->bind_param("s", $code);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows){

        $game = $result->fetch_assoc();

        header("Location: play.php?id=".$game['content_id']);
        exit;

    }else{

        $error = "Invalid game code";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Join Game</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet"
href="assets/css/style.css?v=<?= time() ?>">

<link rel="stylesheet"
href="assets/css/home.css?v=<?= time() ?>">

</head>

<body>

<div class="join-wrapper">

    <form method="POST"
    class="join-card fade-in">

        <div class="join-icon">

            <i class="bi bi-controller"></i>

        </div>

        <h1>Join Game</h1>

        <p>
            Enter your game code to start playing
        </p>

        <?php if($error): ?>

        <div class="alert alert-danger">

            <?= $error ?>

        </div>

        <?php endif; ?>

        <input
        type="text"
        name="game_code"
        class="form-control join-input"
        placeholder="Enter Game Code"
        required>

        <button class="join-btn">

            <i class="bi bi-play-fill"></i>
            Start Game

        </button>

    </form>

</div>

</body>
</html>
<?php

include 'config/db.php';
include 'includes/helpers.php';

$siteName = getSetting('site_name', 'ESL Games');
$primaryColor = getSetting('primary_color', '#3b82f6');

$error = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $input = trim($_POST['game_code']);

    if(empty($input)){

        $error = "Please enter a game code or link.";

    }else{

        /*
        |--------------------------------------------------------------------------
        | Detect URL
        |--------------------------------------------------------------------------
        */

        if(filter_var($input, FILTER_VALIDATE_URL)){

            $parts = parse_url($input);

            if(isset($parts['query'])){

                parse_str($parts['query'], $query);

                if(isset($query['id']) && is_numeric($query['id'])){

                    header("Location: play.php?id=".$query['id']);
                    exit;

                }

            }

            $error = "Invalid game link.";

        }else{

            /*
            |--------------------------------------------------------------------------
            | Search By Game Code
            |--------------------------------------------------------------------------
            */

            $stmt = $conn->prepare("
            SELECT content_id
            FROM content
            WHERE game_code=?
            AND is_published=1
            LIMIT 1
            ");

            $stmt->bind_param("s", $input);

            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows){

                $game = $result->fetch_assoc();

                header("Location: play.php?id=".$game['content_id']);
                exit;

            }else{

                $error = "Game code not found.";

            }

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Join Game - <?= $siteName ?></title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="assets/css/style.css?v=<?= time() ?>">

<link rel="stylesheet"
href="assets/css/join.css?v=<?= time() ?>">

<style>

:root{
    --primary: <?= $primaryColor ?>;
}

</style>

</head>

<body>

<div class="join-bg">

    <span></span>
    <span></span>
    <span></span>

</div>

<div class="join-page">

    <div class="container">

        <div class="join-layout">

            <!-- LEFT -->

            <div class="join-content fade-in">

                <div class="join-badge">

                    <i class="bi bi-controller"></i>

                    Interactive ESL Platform

                </div>

                <h1>

                    Join Your
                    <span>Game Session</span>

                </h1>

                <p>

                    Enter the game code or paste the game link
                    to instantly start playing quizzes, flashcards,
                    memory games and ESL activities.

                </p>

                <div class="join-features">

                    <div class="feature-box">

                        <i class="bi bi-lightning-charge-fill"></i>

                        <div>
                            <h5>Fast Access</h5>
                            <p>Join instantly with one code</p>
                        </div>

                    </div>

                    <div class="feature-box">

                        <i class="bi bi-trophy-fill"></i>

                        <div>
                            <h5>Leaderboard</h5>
                            <p>Compete with top players</p>
                        </div>

                    </div>

                    <div class="feature-box">

                        <i class="bi bi-emoji-smile-fill"></i>

                        <div>
                            <h5>Fun Experience</h5>
                            <p>Interactive learning activities</p>
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="join-card fade-in">

                <div class="join-card-glow"></div>

                <div class="join-icon">

                    <i class="bi bi-play-circle-fill"></i>

                </div>

                <h2>Join Game</h2>

                <p class="join-text">

                    Enter your code or game URL

                </p>

                <?php if($error): ?>

                <div class="custom-alert error-alert">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <span>
                        <?= $error ?>
                    </span>

                </div>

                <?php endif; ?>

                <form method="POST"
                id="joinForm">

                    <div class="input-wrapper">

                        <i class="bi bi-key-fill"></i>

                        <input
                        type="text"
                        name="game_code"
                        id="gameInput"
                        class="form-control join-input"
                        placeholder="Example: ESL2026 or game link"
                        autocomplete="off"
                        required>

                    </div>

                    <div class="quick-actions">

                        <button
                        type="button"
                        class="quick-btn"
                        onclick="pasteClipboard()">

                            <i class="bi bi-clipboard"></i>

                            Paste

                        </button>

                        <button
                        type="button"
                        class="quick-btn"
                        onclick="clearInput()">

                            <i class="bi bi-x-circle"></i>

                            Clear

                        </button>

                    </div>

                    <button
                    type="submit"
                    class="join-btn">

                        <span class="btn-layer"></span>

                        <i class="bi bi-play-fill"></i>

                        Start Playing

                    </button>

                </form>

                <a href="index.php"
                class="back-home">

                    <i class="bi bi-arrow-left"></i>

                    Back Home

                </a>

            </div>

        </div>

    </div>

</div>

<div class="toast-box"
id="toastBox"></div>

<script src="assets/js/join.js?v=<?= time() ?>"></script>

</body>
</html>
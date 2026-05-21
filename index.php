<?php

include 'config/db.php';
include 'includes/helpers.php';

$siteName = getSetting('site_name', 'ESL Games');
$primaryColor = getSetting('primary_color', '#3b82f6');

$games = $conn->query("
SELECT *
FROM content
WHERE is_published = 1
ORDER BY created_at DESC
LIMIT 6
");

$totalGames = $conn->query("
SELECT COUNT(*) total
FROM content
WHERE content_type IN ('game','quiz')
")->fetch_assoc()['total'];

$totalResults = $conn->query("
SELECT COUNT(*) total
FROM results
")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?= $siteName ?></title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet"
href="assets/css/style.css?v=<?= time() ?>">

<link rel="stylesheet"
href="assets/css/home.css?v=<?= time() ?>">

<style>
:root{
    --primary: <?= $primaryColor ?>;
}
</style>

</head>

<body>

<div class="hero-bg"></div>

<section class="hero-section">

    <div class="container">

        <div class="hero-content fade-in">

            <div class="hero-badge">
                <i class="bi bi-controller"></i>
                Interactive ESL Platform
            </div>

            <h1>
                Learn English Through
                <span>Interactive Games</span>
            </h1>

            <p>
                Modern educational games, quizzes,
                flashcards and memory activities
                designed for ESL students.
            </p>

            <div class="hero-actions">

                <a href="join.php"
                class="hero-btn primary-btn">

                    <i class="bi bi-play-circle-fill"></i>
                    Join Game

                </a>

                <a href="#games"
                class="hero-btn secondary-btn">

                    <i class="bi bi-grid"></i>
                    Browse Games

                </a>

            </div>

        </div>

    </div>

</section>

<section class="stats-section">

    <div class="container">

        <div class="stats-grid">

            <div class="stat-card">
                <i class="bi bi-controller"></i>
                <h2><?= $totalGames ?></h2>
                <p>Games & Quizzes</p>
            </div>

            <div class="stat-card">
                <i class="bi bi-trophy"></i>
                <h2><?= $totalResults ?></h2>
                <p>Game Results</p>
            </div>

            <div class="stat-card">
                <i class="bi bi-lightning"></i>
                <h2>Fast</h2>
                <p>Interactive Experience</p>
            </div>

        </div>

    </div>

</section>

<section class="games-section"
id="games">

    <div class="container">

        <div class="section-title">

            <h2>Featured Games</h2>

            <p>
                Play modern ESL activities and quizzes
            </p>

        </div>

        <div class="games-grid">

            <?php while($game = $games->fetch_assoc()): ?>

            <div class="game-card fade-in">

                <div class="game-thumb">

                    <?php if(!empty($game['thumbnail'])): ?>

                        <img src="<?= $game['thumbnail'] ?>">

                    <?php else: ?>

                        <div class="thumb-placeholder">

                            <i class="bi bi-controller"></i>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="game-body">

                    <span class="game-type">
                        <?= strtoupper($game['content_type']) ?>
                    </span>

                    <h3>
                        <?= htmlspecialchars($game['content_title']) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($game['description']) ?>
                    </p>

                    <a href="play.php?id=<?= $game['content_id'] ?>"
                    class="play-btn">

                        <i class="bi bi-play-fill"></i>
                        Play Now

                    </a>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

    </div>

</section>

<script src="assets/js/frontend.js?v=<?= time() ?>"></script>

</body>
</html>
<?php

include 'config/db.php';
include 'includes/helpers.php';

/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
*/

$siteName = getSetting('site_name', 'ESL Games');
$primaryColor = getSetting('primary_color', '#3b82f6');
$footerText = getSetting(
    'footer_text',
    'Interactive ESL Learning Platform'
);

/*
|--------------------------------------------------------------------------
| Featured Games
|--------------------------------------------------------------------------
*/

$games = $conn->query("
SELECT *
FROM content
WHERE is_published = 1
ORDER BY created_at DESC
LIMIT 8
");

/*
|--------------------------------------------------------------------------
| Statistics
|--------------------------------------------------------------------------
*/

$totalGames = $conn->query("
SELECT COUNT(*) total
FROM content
WHERE content_type IN ('game','quiz')
")->fetch_assoc()['total'];

$totalLessons = $conn->query("
SELECT COUNT(*) total
FROM content
WHERE content_type='lesson'
")->fetch_assoc()['total'];

$totalResults = $conn->query("
SELECT COUNT(*) total
FROM results
")->fetch_assoc()['total'];

$leaderboard = $conn->query("
SELECT
results.player_name,
results.score,
content.content_title
FROM results
LEFT JOIN content
ON results.content_id = content.content_id
ORDER BY results.score DESC
LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($siteName) ?></title>

<!-- Bootstrap -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Google Font -->
<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap"
rel="stylesheet">

<!-- Main Style -->
<link rel="stylesheet"
href="assets/css/style.css?v=<?= time() ?>">

<!-- Home Style -->
<link rel="stylesheet"
href="assets/css/home.css?v=<?= time() ?>">

<style>

:root{

    --primary:
    <?= $primaryColor ?>;

}

</style>

</head>

<body>

<!-- ========================= -->
<!-- BACKGROUND -->
<!-- ========================= -->

<div class="hero-background">

    <span class="bg-circle one"></span>
    <span class="bg-circle two"></span>
    <span class="bg-circle three"></span>

</div>

<!-- ========================= -->
<!-- HERO -->
<!-- ========================= -->

<section class="hero-section">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="hero-content fade-in">

                    <div class="hero-badge">

                        <i class="bi bi-controller"></i>

                        Interactive ESL Platform

                    </div>

                    <h1>

                        Learn English Through

                        <span>
                            Interactive Games
                        </span>

                    </h1>

                    <p>

                        Modern quizzes, flashcards,
                        memory games and ESL
                        learning experiences built
                        for students and teachers.

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

                            Explore Games

                        </a>

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="hero-visual">

                    <div class="floating-card card-1">

                        <i class="bi bi-patch-check-fill"></i>

                        <span>Live Quiz</span>

                    </div>

                    <div class="floating-card card-2">

                        <i class="bi bi-lightning-charge-fill"></i>

                        <span>Fast Learning</span>

                    </div>

                    <div class="floating-card card-3">

                        <i class="bi bi-trophy-fill"></i>

                        <span>Leaderboard</span>

                    </div>

                    <div class="hero-circle"></div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ========================= -->
<!-- STATS -->
<!-- ========================= -->

<section class="stats-section">

    <div class="container">

        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-controller"></i>

                </div>

                <h2 class="counter"
                data-target="<?= $totalGames ?>">

                    0

                </h2>

                <p>Games & Quizzes</p>

            </div>

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-journal-richtext"></i>

                </div>

                <h2 class="counter"
                data-target="<?= $totalLessons ?>">

                    0

                </h2>

                <p>Interactive Lessons</p>

            </div>

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-trophy"></i>

                </div>

                <h2 class="counter"
                data-target="<?= $totalResults ?>">

                    0

                </h2>

                <p>Game Results</p>

            </div>

        </div>

    </div>

</section>

<!-- ========================= -->
<!-- FEATURED GAMES -->
<!-- ========================= -->

<section class="games-section"
id="games">

    <div class="container">

        <div class="section-title">

            <span>
                Featured Games
            </span>

            <h2>

                Explore Interactive Activities

            </h2>

            <p>

                Modern ESL activities with
                engaging gameplay and
                educational interaction.

            </p>

        </div>

        <div class="games-grid">

            <?php while($game = $games->fetch_assoc()): ?>

            <div class="game-card fade-in">

                <div class="game-thumb">

                    <?php if(!empty($game['thumbnail'])): ?>

                        <img
                        src="<?= htmlspecialchars($game['thumbnail']) ?>"
                        alt="Game Thumbnail">

                    <?php else: ?>

                        <div class="thumb-placeholder">

                            <i class="bi bi-controller"></i>

                        </div>

                    <?php endif; ?>

                    <div class="thumb-overlay"></div>

                </div>

                <div class="game-body">

                    <div class="game-top">

                        <span class="game-type">

                            <?= strtoupper(
                                htmlspecialchars(
                                    $game['content_type']
                                )
                            ) ?>

                        </span>

                    </div>

                    <h3>

                        <?= htmlspecialchars(
                            $game['content_title']
                        ) ?>

                    </h3>

                    <p>

                        <?= htmlspecialchars(
                            $game['description']
                        ) ?>

                    </p>

                    <div class="game-footer">

                        <a href="play.php?id=<?= $game['content_id'] ?>"
                        class="play-btn">

                            <i class="bi bi-play-fill"></i>

                            Play Now

                        </a>

                    </div>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

    </div>

</section>

<!-- ========================= -->
<!-- LEADERBOARD -->
<!-- ========================= -->

<section class="leaderboard-section">

    <div class="container">

        <div class="section-title">

            <span>Top Players</span>

            <h2>Leaderboard</h2>

            <p>
                Highest scores from recent games
            </p>

        </div>

        <div class="leaderboard-card">

            <?php
            $rank = 1;
            while($row = $leaderboard->fetch_assoc()):
            ?>

            <div class="leaderboard-item">

                <div class="leaderboard-left">

                    <div class="leader-rank">

                        #<?= $rank ?>

                    </div>

                    <div>

                        <h4>

                            <?= htmlspecialchars(
                                $row['player_name']
                            ) ?>

                        </h4>

                        <small>

                            <?= htmlspecialchars(
                                $row['content_title']
                            ) ?>

                        </small>

                    </div>

                </div>

                <div class="leader-score">

                    <?= $row['score'] ?>

                    pts

                </div>

            </div>

            <?php
            $rank++;
            endwhile;
            ?>

        </div>

    </div>

</section>

<!-- ========================= -->
<!-- JOIN CTA -->
<!-- ========================= -->

<section class="join-section">

    <div class="container">

        <div class="join-card">

            <div class="join-icon">

                <i class="bi bi-rocket-takeoff-fill"></i>

            </div>

            <h2>

                Ready To Start?

            </h2>

            <p>

                Enter a game code and
                join instantly.

            </p>

            <a href="join.php"
            class="join-main-btn">

                <i class="bi bi-play-circle-fill"></i>

                Join Game

            </a>

        </div>

    </div>

</section>

<!-- ========================= -->
<!-- FOOTER -->
<!-- ========================= -->

<footer class="footer">

    <div class="container">

        <p>

            <?= htmlspecialchars($footerText) ?>

        </p>

    </div>

</footer>

<!-- Scripts -->
<script src="assets/js/frontend.js?v=<?= time() ?>"></script>

</body>
</html>
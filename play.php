<?php

include 'config/db.php';
include 'includes/helpers.php';

/* =========================
   Validate Request
========================= */

if (
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
) {

    include 'views/errors/invalid-request.php';
    exit;
}

$contentId = intval($_GET['id']);

/* =========================
   Load Content
========================= */

$stmt = $conn->prepare("
SELECT
    c.*,
    t.render_file
FROM content c
JOIN templates t
ON c.template_id = t.template_id
WHERE c.content_id = ?
AND c.is_published = 1
LIMIT 1
");

if(!$stmt){

    include 'views/errors/system-error.php';
    exit;
}

$stmt->bind_param("i", $contentId);

if(!$stmt->execute()){

    include 'views/errors/system-error.php';
    exit;
}

$result = $stmt->get_result();

if(!$result->num_rows){

    include 'views/errors/game-not-found.php';
    exit;
}

$content = $result->fetch_assoc();

/* =========================
   Template Check
========================= */

$templateFile =
__DIR__ . '/templates/' .
$content['render_file'];

if(!file_exists($templateFile)){

    include 'views/errors/template-error.php';
    exit;
}

/* =========================
   Decode JSON
========================= */

$data = [];
$settings = [];

if(!empty($content['data_json'])){

    $data =
    json_decode(
        $content['data_json'],
        true
    );

    if(json_last_error() !== JSON_ERROR_NONE){

        include 'views/errors/json-error.php';
        exit;
    }
}

if(!empty($content['settings_json'])){

    $settings =
    json_decode(
        $content['settings_json'],
        true
    );

    if(json_last_error() !== JSON_ERROR_NONE){

        include 'views/errors/json-error.php';
        exit;
    }
}

$siteName =
getSetting(
    'site_name',
    'ESL Games'
);

$primaryColor =
getSetting(
    'primary_color',
    '#3b82f6'
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?= htmlspecialchars($content['content_title']) ?>
- <?= $siteName ?>
</title>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet"
href="assets/css/style.css?v=<?= time() ?>">

<link rel="stylesheet"
href="assets/css/play.css?v=<?= time() ?>">

<style>

:root{
    --primary:
    <?= $primaryColor ?>;
}

</style>

</head>

<body>

<div class="play-page">

    <!-- Floating Background -->

    <div class="play-floating-bg">

        <span></span>
        <span></span>
        <span></span>

    </div>

    <!-- Topbar -->

    <div class="play-topbar">

        <div class="topbar-left">

            <button
            class="back-btn"
            id="leaveGameBtn">

                <i class="bi bi-arrow-left"></i>

            </button>

            <div>

                <div class="game-type-badge">

                    <i class="bi bi-controller"></i>

                    <?= strtoupper($content['content_type']) ?>

                </div>

                <h1 class="game-title">

                    <?= htmlspecialchars(
                        $content['content_title']
                    ) ?>

                </h1>

                <p class="game-description">

                    <?= htmlspecialchars(
                        $content['description']
                    ) ?>

                </p>

            </div>

        </div>

        <div class="topbar-right">

            <div class="top-info-card">

                <i class="bi bi-stopwatch"></i>

                <span id="liveTimer">

                    00:00

                </span>

            </div>

            <div class="top-info-card">

                <i class="bi bi-bar-chart"></i>

                <span id="progressText">

                    0%

                </span>

            </div>

        </div>

    </div>

    <!-- Game Wrapper -->

    <div class="game-wrapper fade-in">

        <?php include $templateFile; ?>

    </div>

</div>

<!-- Leave Modal -->

<div class="leave-modal"
id="leaveModal">

    <div class="leave-card">

        <div class="leave-icon">

            <i class="bi bi-box-arrow-left"></i>

        </div>

        <h2>Leave Game?</h2>

        <p>
            Your progress may not be saved.
        </p>

        <div class="leave-actions">

            <button
            class="btn btn-outline-light"
            id="continueBtn">

                Continue

            </button>

            <button
            class="btn btn-danger"
            id="confirmLeaveBtn">

                Leave

            </button>

        </div>

    </div>

</div>

<!-- Toast -->

<div class="copy-toast"
id="copyToast">

    <i class="bi bi-check-circle-fill"></i>

    Link copied successfully

</div>

<script>

window.gameContent = {

    id:
    <?= $content['content_id'] ?>,

    title:
    <?= json_encode(
        $content['content_title']
    ) ?>,

    data:
    <?= json_encode($data) ?>,

    settings:
    <?= json_encode($settings) ?>

};

</script>

<script src="assets/js/game-engine.js?v=<?= time() ?>"></script>

<script src="assets/js/play.js?v=<?= time() ?>"></script>

</body>
</html>
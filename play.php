<?php
include 'config/db.php';

/* =========================
   Validate ID
========================= */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    include 'views/errors/invalid-request.php';
    exit;
}

$id = intval($_GET['id']);

/* =========================
   Database Query
========================= */

$stmt = $conn->prepare("
    SELECT c.*, t.render_file
    FROM content c
    JOIN templates t
    ON c.template_id = t.template_id
    WHERE c.content_id = ?
");

if (!$stmt) {

    include 'views/errors/system-error.php';
    exit;
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {

    include 'views/errors/system-error.php';
    exit;
}

$result = $stmt->get_result();

/* =========================
   Game Not Found
========================= */

if ($result->num_rows === 0) {

    include 'views/errors/game-not-found.php';
    exit;
}

$content = $result->fetch_assoc();

/* =========================
   Template Check
========================= */

$templateFile = __DIR__ . "/templates/" . $content['render_file'];

if (!file_exists($templateFile)) {

    include 'views/errors/template-error.php';
    exit;
}

/* =========================
   JSON Validation
========================= */

$data = [];
$settings = [];

if (!empty($content['data_json'])) {

    $data = json_decode($content['data_json'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {

        include 'views/errors/json-error.php';
        exit;
    }
}

if (!empty($content['settings_json'])) {

    $settings = json_decode($content['settings_json'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {

        include 'views/errors/json-error.php';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($content['content_title']) ?>
    </title>

    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">

    <script src="assets/js/game-engine.js"></script>

</head>

<body>

<?php include $templateFile; ?>

</body>
</html>
<?php

include 'auth_check.php';
include '../config/db.php';

// =========================
// BASIC DATA
// =========================

$title = trim($_POST['content_title']);
$content_type = trim($_POST['content_type']);
$template_id = intval($_POST['template_id']);
$description = trim($_POST['description']);

$is_published = isset($_POST['is_published']) ? 1 : 0;

// =========================
// SLUG
// =========================

$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

// =========================
// GAME CODE
// =========================

$game_code = strtoupper(substr(md5(time()), 0, 6));

// =========================
// THUMBNAIL
// =========================

$thumbnail = null;

if (!empty($_FILES['thumbnail']['name'])) {

    $fileName = time() . "_" . $_FILES['thumbnail']['name'];

    $target = "../uploads/" . $fileName;

    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target);

    $thumbnail = $fileName;
}

// =========================
// QUESTIONS JSON
// =========================

$questions = [];

if (isset($_POST['question'])) {

    foreach ($_POST['question'] as $index => $question) {

        $questions[] = [

            "question" => $question,

            "correct_answer" => $_POST['correct_answer'][$index],

            "option1" => $_POST['option1'][$index],

            "option2" => $_POST['option2'][$index],

            "option3" => $_POST['option3'][$index]

        ];
    }
}

$data_json = json_encode($questions);

// =========================
// SETTINGS JSON
// =========================

$settings = [
    "shuffle_questions" => true,
    "timer" => 30
];

$settings_json = json_encode($settings);

// =========================
// INSERT
// =========================

$stmt = $conn->prepare("
INSERT INTO content
(
content_title,
slug,
content_type,
template_id,
description,
thumbnail,
game_code,
settings_json,
data_json,
is_published
)

VALUES

(?,?,?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "sssisssssi",
    $title,
    $slug,
    $content_type,
    $template_id,
    $description,
    $thumbnail,
    $game_code,
    $settings_json,
    $data_json,
    $is_published
);

if ($stmt->execute()) {

    header("Location: content.php");
    exit;

} else {

    echo "Database Error";

}
?>
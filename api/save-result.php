<?php

include '../config/db.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if(!$data){

    echo json_encode([
        "status" => "error"
    ]);

    exit;
}

$stmt = $conn->prepare("
INSERT INTO results(
content_id,
player_name,
score,
correct_answers,
wrong_answers,
time_taken,
answers_json
)
VALUES(?,?,?,?,?,?,?)
");

$answers = json_encode($data['answers']);

$stmt->bind_param(
"isiiiis",
$data['content_id'],
$data['player_name'],
$data['score'],
$data['correct'],
$data['wrong'],
$data['time_taken'],
$answers
);

$stmt->execute();

echo json_encode([
    "status" => "success",
    "result_id" => $conn->insert_id
]);
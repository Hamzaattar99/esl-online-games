<?php

include '../config/db.php';

header("Content-Type: application/json");

if(empty($_GET['id'])){

    echo json_encode([
        "status" => "error"
    ]);

    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
SELECT *
FROM content
WHERE content_id=?
LIMIT 1
");

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

if(!$result->num_rows){

    echo json_encode([
        "status" => "error"
    ]);

    exit;
}

$content = $result->fetch_assoc();

echo json_encode([
    "status" => "success",
    "data" => $content
]);
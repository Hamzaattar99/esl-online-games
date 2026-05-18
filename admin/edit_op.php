<?php

include 'auth_check.php';
include '../config/db.php';

$id = intval($_POST['content_id']);

$title = trim($_POST['content_title']);
$type = $_POST['content_type'];
$description = $_POST['description'] ?? "";

/*
|--------------------------------------------------------------------------
| Validation
|--------------------------------------------------------------------------
*/

if(empty($title)){
    echo "title_error";
    exit;
}

if(!in_array($type, ['game','quiz','lesson'])){
    echo "type_error";
    exit;
}

/*
|--------------------------------------------------------------------------
| Build Questions JSON
|--------------------------------------------------------------------------
*/

$questions = [];

if(isset($_POST['question'])){

    foreach($_POST['question'] as $i => $q){

        if(empty($q)) continue;

        $questions[] = [
            "question" => $q,
            "correct_answer" => $_POST['correct'][$i] ?? "",
            "option1" => $_POST['opt1'][$i] ?? "",
            "option2" => $_POST['opt2'][$i] ?? "",
            "option3" => $_POST['opt3'][$i] ?? "",
        ];
    }
}

$data_json = json_encode($questions, JSON_UNESCAPED_UNICODE);

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
UPDATE content
SET 
    content_title=?,
    content_type=?,
    description=?,
    data_json=?,
    updated_at=CURRENT_TIMESTAMP
WHERE content_id=?
");

$stmt->bind_param("ssssi",
    $title,
    $type,
    $description,
    $data_json,
    $id
);

if($stmt->execute()){
    echo "success";
}else{
    echo "error";
}
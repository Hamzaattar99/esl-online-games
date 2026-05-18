<?php

include 'auth_check.php';
include '../config/db.php';

if(!isset($_POST['id'])){

    echo "error";
    exit;
}

$id = intval($_POST['id']);

$stmt = $conn->prepare("
DELETE FROM content
WHERE content_id = ?
");

$stmt->bind_param("i", $id);

if($stmt->execute()){

    echo "success";

}else{

    echo "error";
}
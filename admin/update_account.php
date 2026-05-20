<?php

include 'auth_check.php';
include '../config/db.php';
include '../includes/helpers.php';

$userId = $_SESSION['user_id'];

$currentUsername = trim($_POST['current_username']);
$newUsername = trim($_POST['new_username']);

$currentPassword = trim($_POST['current_password']);
$newPassword = trim($_POST['new_password']);

$stmt = $conn->prepare("
SELECT *
FROM users
WHERE user_id=?
");

$stmt->bind_param("i", $userId);

$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if($currentUsername !== $user['username']){

    jsonResponse("error", "Current username incorrect");

}

if(!password_verify($currentPassword, $user['password'])){

    jsonResponse("error", "Current password incorrect");

}

$newHash = password_hash($newPassword, PASSWORD_DEFAULT);

$update = $conn->prepare("
UPDATE users
SET username=?,
password=?
WHERE user_id=?
");

$update->bind_param(
    "ssi",
    $newUsername,
    $newHash,
    $userId
);

$update->execute();

jsonResponse(
    "success",
    "Account updated successfully"
);
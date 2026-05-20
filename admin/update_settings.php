<?php

include 'auth_check.php';
include '../config/db.php';
include '../includes/helpers.php';

if(empty($_POST['site_name'])){

    jsonResponse("error", "Site name required");

}

foreach($_POST as $key => $value){

    $stmt = $conn->prepare("
        UPDATE settings
        SET setting_value=?
        WHERE setting_key=?
    ");

    $stmt->bind_param("ss", $value, $key);

    $stmt->execute();

}

jsonResponse("success", "Settings updated successfully");
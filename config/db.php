<?php

$host = "localhost";
$dbname = "esl_games";
$user = "root";
$pass = "";

// Connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

?>
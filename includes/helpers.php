<?php

if (!function_exists('getSetting')) {

    function getSetting($key, $default = null)
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT setting_value
            FROM settings
            WHERE setting_key = ?
            LIMIT 1
        ");

        $stmt->bind_param("s", $key);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            return $row['setting_value'];
        }

        return $default;
    }

}

/*
|--------------------------------------------------------------------------
| Message Box Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('jsonResponse')) {

    function jsonResponse($status, $message)
    {
        echo json_encode([
            "status" => $status,
            "message" => $message
        ]);

        exit;
    }

}
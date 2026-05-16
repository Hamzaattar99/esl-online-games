<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
    $_SESSION['lock_time'] = 0;
}

// إذا مقفول
if ($_SESSION['lock_time'] > time()) {
    echo "locked";
    exit;
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// تحقق بسيط
if (empty($username) || empty($password)) {
    echo "empty";
    exit;
}

// جلب المستخدم
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    // تحقق من password hash
    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // جلسة 5 دقائق
        $_SESSION['expire'] = time() + 300;

        $_SESSION['attempts'] = 0;

        echo "success";
        exit;

    } else {
        $_SESSION['attempts']++;
    }

} else {
    $_SESSION['attempts']++;
}

// قفل بعد 3 محاولات
if ($_SESSION['attempts'] >= 3) {
    $_SESSION['lock_time'] = time() + 60; // دقيقة
    $_SESSION['attempts'] = 0;
    echo "locked";
    exit;
}

echo "error";
?>
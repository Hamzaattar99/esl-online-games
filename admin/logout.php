<?php
session_start();

// مسح جميع بيانات الجلسة
$_SESSION = [];

// حذف كعكة الجلسة (session cookie)
/*if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
} */

// إنهاء الجلسة فعلياً
session_destroy();

// تحويل إلى صفحة تسجيل الدخول
header("Location: login.php");
exit;
?>
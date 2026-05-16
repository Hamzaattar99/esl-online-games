<?php
session_start();

// إذا المستخدم غير مسجل دخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// تحقق من انتهاء الجلسة (5 دقائق حسب كودك)
if (isset($_SESSION['expire']) && time() > $_SESSION['expire']) {
    session_unset();
    session_destroy();

    header("Location: login.php");
    exit;
}

// تحديث وقت الانتهاء مع كل طلب (اختياري لتمديد الجلسة)
$_SESSION['expire'] = time() + 300;
?>
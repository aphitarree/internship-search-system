<?php

session_start();
include 'config.php';
// 1. ลบ Cookie remember_token
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    // ตั้งเวลาให้หมดอายุย้อนหลัง → Cookie ถูกลบ
}


if (isset($_SESSION['id'])) {
    $stmt = $conn->prepare("UPDATE user SET remember_token = NULL WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->close();
}



unset($_SESSION['checklogin']);
unset($_SESSION['email']);
unset($_SESSION['id']);
unset($_SESSION['username']);


if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}


session_destroy();

header("Location: {$base_url}/login.php");

exit;
?>
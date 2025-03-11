<?php
session_start();

$url = $_SERVER['REQUEST_URI'];
$_SESSION['redirect_url'] = $url;
$lock_timeout = 10 * 60;
$logout_timeout = 20 * 60;

if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    if ($inactive_time > $lock_timeout) {
        $_SESSION['lock'] = "true";
    }
    if ($inactive_time > $logout_timeout) {
        unset($_SESSION['ad_id']);
    }
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['ad_id'])) {
    header("Location: signin.php");
    exit;
}
if(isset($_SESSION['lock'])) {
    header("Location: lock-screen.php");
    exit;
}
?>


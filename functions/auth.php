<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_COOKIE['samj_loggedin'])) {
    header('Location: login.php');
}
?>

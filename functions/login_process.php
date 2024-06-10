<?php
$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'admin' && $password === 'password') {
    setcookie('samj_loggedin', 'true', time() + 3600, '/'); // Expires in 1 hour
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../login.php');
    exit();
}
?>

<?php 

session_start();

$identity = null;
if (isset($_SESSION['identity'])) {
    $identity = $_SESSION['identity'];
    header("Location: /index/features.php");
} else {
    header("Location: /login/login.php");
}
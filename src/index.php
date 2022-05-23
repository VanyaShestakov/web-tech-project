<?php 

// index.php
session_start();

// If user is logged in, retrieve identity from session.
// echo 'aaaaaa';
$identity = null;
if (isset($_SESSION['identity'])) {
    header("Location: index/features.php");
    $identity = $_SESSION['identity'];
} else {
    header("Location: login/login.html");
}
?>
<?php
require_once '../database/database.php';

function get_user($link, $username) {
    $sql = 'SELECT * FROM auth_info WHERE username = \''.$username.'\';';
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1); 
    return $data;
}

session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];

    $user = get_user($link, $login);
    $password = $_POST['password'];
    if ($password == $user[0]['password']) {
        $_SESSION['identity'] = $login;
        header("Location: /index/features.php");
    } else {
        header("Location: /login/login.html");
    }
} else {
    header("Location: /login/login.html");
}

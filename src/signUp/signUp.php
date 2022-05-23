<?php
require_once '../database/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$select_query = 'SELECT * FROM auth_info WHERE username = \''.$username.'\';';
$result = mysqli_query($link, $select_query);
$data = mysqli_fetch_all($result, 1); 

if (count($data) != 0) {
    header("Location: /signUp/logic.php");
}

$insert_query = 'INSERT INTO auth_info(username, password) VALUES (\''.$username.'\', \''.$password.'\');';
mysqli_query($link, $insert_query);
header("Location: /login/login.html");
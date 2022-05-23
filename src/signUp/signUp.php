<?php
require_once '../database/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

echo $username;

$sql = 'INSERT INTO auth_info(username, password) VALUES (\''.$username.'\', \''.$password.'\');';
mysqli_query($link, $sql);
<?php
require_once '../database/database.php';

function get_team($link) {
    $sql = "SELECT * FROM employee LEFT JOIN department ON employee.department_id = department.id;";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1); 
    return $data;
}

session_start();
if (isset($_SESSION['identity'])) {
    $identity = $_SESSION['identity'];
} else {
    header("Location: ../login/login.php");
}

$team = get_team($link);

$works_template = file_get_contents("../templates/works.html");
$team_template = file_get_contents("../templates/team.html");
for ($i = 0; $i < count($team); $i++)
{
    $team_template = str_replace('{name_'.$i.'}', $team[$i]['first_name'], $team_template);
    $team_template = str_replace('{prof_'.$i.'}', $team[$i]['position'], $team_template);
     $team_template = str_replace('{text_'.$i.'}', '"'.$team[$i]['name'].'"', $team_template);
}

$main_template = file_get_contents("index.html");
$main_template = str_replace('{team}', $team_template, $main_template);
$main_template = str_replace('{header}', file_get_contents("../templates/header.html"), $main_template);
$main_template = str_replace('{works}', $works_template, $main_template);
$main_template = str_replace('{footer}', file_get_contents("../templates/footer.html"), $main_template);
echo $main_template;
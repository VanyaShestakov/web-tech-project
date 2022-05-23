<?php
require_once '../database/database.php';

function get_departments($link) {
    $sql = "SELECT * FROM `department`;";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1); 
    return $data;
}

if (isset($_SESSION['identity'])) {
    header("Location: index/features.php");
    $identity = $_SESSION['identity'];
} else {
    header("Location: ../login/login.html");
}

$departments = get_departments($link);

$works_template = file_get_contents("../templates/works.html");
$team_template = file_get_contents("../templates/team.html");
for ($i = 0; $i < count($departments); $i++)
{
    $team_template = str_replace('{name_'.$i.'}', $departments[$i]['name'], $team_template);
    $team_template = str_replace('{prof_'.$i.'}', $departments[$i]['description'], $team_template);
    $team_template = str_replace('{text_'.$i.'}', '', $team_template);
}

$main_template = file_get_contents("departments.html");
$main_template = str_replace('{team}', $team_template, $main_template);
$main_template = str_replace('{header}', file_get_contents("../templates/header.html"), $main_template);
$main_template = str_replace('{works}', $works_template, $main_template);
$main_template = str_replace('{footer}', file_get_contents("../templates/footer.html"), $main_template);
echo $main_template;
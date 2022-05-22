<?php

require_once '../database/database.php';

// function get_links($link) {
//     $sql = "SELECT * FROM `works_images`;";
//     $result = mysqli_query($link, $sql);
//     $data = mysqli_fetch_all($result, 1); 
//     return $data;
// }

function get_team($link) {
    $sql = "SELECT * FROM `project`;";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1); 
    return $data;
}

$team = get_team($link);
// $links = get_links($link);

$works_template = file_get_contents("../templates/works.html");
// for ($i = 0; $i < count($links); $i++)
// {
//     $works_template = str_replace('{link_'.$i.'}', '"'.$links[$i]['link'].'"', $works_template);
//     $works_template = str_replace('{works__title_'.$i.'}', $links[$i]['works_title'], $works_template);
//     $works_template = str_replace('{works__text_'.$i.'}', $links[$i]['works_text'], $works_template);
// }
$team_template = file_get_contents("../templates/team.html");
for ($i = 0; $i < count($team); $i++)
{
    // $team_template = str_replace('{link_'.$i.'}', '"'.$team[$i]['link'].'"', $team_template);
    $team_template = str_replace('{name_'.$i.'}', $team[$i]['name'], $team_template);
    $team_template = str_replace('{prof_'.$i.'}', $team[$i]['begin_date'], $team_template);
     $team_template = str_replace('{text_'.$i.'}', $team[$i]['end_date'], $team_template);

    // $team_template = str_replace('{facebook_'.$i.'}', '"'.$team[$i]['link_facebook'].'"', $team_template);
    // $team_template = str_replace('{inst_'.$i.'}', '"'.$team[$i]['link_inst'].'"', $team_template);
    // $team_template = str_replace('{linkedIn_'.$i.'}', '"'.$team[$i]['link_linkedIn'].'"', $team_template);
}

$main_template = file_get_contents("projects.html");
$main_template = str_replace('{header}', file_get_contents("../templates/header.html"), $main_template);
$main_template = str_replace('{footer}', file_get_contents("../templates/footer.html"), $main_template);
$main_template = str_replace('{team}', $team_template, $main_template);
echo $main_template;